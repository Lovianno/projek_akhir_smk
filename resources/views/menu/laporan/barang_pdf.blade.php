<!DOCTYPE html>
<html>
<head>
	<title>Laporan Data Barang</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
	<center>
		<h5>Laporan Data Barang</h5>
		
	</center>
 
	<table class='table table-bordered'>
		<thead>
			<tr>
				<th class=""scope="col">No</th>
                <th scope="col">Nama Barang</th>
                <th scope="col">Kategori</th>
                <th scope="col">Harga</th>
                <th scope="col">Stok</th>
			</tr>
		</thead>
		<tbody>
			
      @foreach ($barang as $i => $b)
			<tr>
        <td>{{ ++$i }}</td>
        <td>{{ $b->nama }}</td>
        <td>{{ $b->kategori->kategori }}</td>
        <td>{{ $b->harga }}</td>
         <td>{{ $b->stok }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
 
</body>
</html>