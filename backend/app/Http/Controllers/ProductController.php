<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\product;
use File;

class ProductController extends Controller
{
	public function upload(){
		$product = product::get();
		return view('product.product',['product' => $product]);
	}

	public function index($slug)
    {
        $product = product::where('slug_name', $slug)->firstOrFail();
        return view('product.product_view')->with([
            'product' => $product,
        ]);
    }

	public function proses_upload(Request $request){
		$this->validate($request, [
			'name' => 'required',
			'price' => 'required',
			'desc' => 'required',
			'tag' => 'required',
			'file' => 'required|file|image|mimes:jpeg,png,jpg|max:2048'
		]);

		// menyimpan data file yang diupload ke variabel $file
		$file = $request->file('file');

		$product_image = time()."_".$file->getClientOriginalName();

      	        // isi dengan nama folder tempat kemana file diupload
		$tujuan_upload = 'data_file';
		$file->move($tujuan_upload,$product_image);

		product::create([
			'name' => $request->name,
			'slug_name' => $request->slug = Str::slug($request->get('name')),
			'price' => $request->price,
			'desc' => $request->desc,
			'tag' => $request->tag,
			'file' => $product_image
		]);

		return redirect()->back();
	}

	public function hapus($id){
	// hapus file
	$product = product::where('id',$id)->first();
	File::delete('data_file/'.$product->file);

	// hapus data
	product::where('id',$id)->delete();

	return redirect()->back();
}
}