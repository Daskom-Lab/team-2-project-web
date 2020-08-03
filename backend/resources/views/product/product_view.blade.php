<html>
    <head>
        <title>@yield($product->name)</title>
    </head>
    <body>
    <div class="container">
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
    </body>
</html>