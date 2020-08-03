<!DOCTYPE html>
<html>
<head>
	<title>upload product</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body>
	<div class="row">
		<div class="container">

			<h2 class="text-center my-5">create product</h2>
			<div class="col-lg-8 mx-auto my-5">	

				@if(count($errors) > 0)
				<div class="alert alert-danger">
					@foreach ($errors->all() as $error)
					{{ $error }} <br/>
					@endforeach
				</div>
				@endif

				<form action="/product/proses" method="POST" enctype="multipart/form-data">
					{{ csrf_field() }}

					<div class="form-group">
						<b>File product</b>
						<input type="file" name="file">
					</div>

					<div class="form-group">
						<b>Nama Product</b>
						<textarea class="form-control" name="name"></textarea>
					</div>

					<div class="form-group">
						<b>deskripsi produk</b>
						<textarea class="form-control" name="desc"></textarea>
					</div>

					<div class="form-group">
						<b>Harga</b>
						<textarea class="form-control" name="price"></textarea>
					</div>

					<div class="form-group">
						<b>kategori</b>
						<textarea class="form-control" name="tag"></textarea>
					</div>

					<input type="submit" value="product" class="btn btn-primary">
				</form>


            <h4 class="my-5">list product</h4>
            <table class="table table-borde d table-striped">
                <thead>
                    <tr>
                        <th width="1%">File</th>
                        <th>deskripsi</th>
                        <th>Harga</th>
                        <th>kategori</th>
                        <th width="1%">OPSI</th>
                     </tr>
                </thead>
                <tbody>
                    @foreach($product as $p)
                    <tr>
                        <td><img width="150px" src="{{ url('/data_file/'.$p->file) }}"></td>
                         <td>{{$p->desc}}</td>
                        <td>{{$p->price}}</td>
                        <td>{{$p->tag}}</td>
                        <td><a class="btn btn-danger" href="/product/hapus/{{ $p->id }}">HAPUS</a></td>
                    </tr>
                    @endforeach
                </tbody>
             </table>

			</div>
		</div>
	</div>
</body>
</html>