<!DOCTYPE html>
<html>
<head>
	<title>Laporan Data Barang</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
	
	<center>
		<h5 class="border-top border-bottom border-dark p-2">Laporan Transaksi Penjualan</h5>
	</center>
 
	<table class='table table-bordered'>
		<thead class="table-primary">
			<tr>
				<th class=""scope="col">No</th>
                <th scope="col">Kode Pembelian</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Harga Total</th>
			</tr>
		</thead>
		<tbody>
			
      @foreach ($transaksi as $i => $b)
			<tr>
        <td>{{ ++$i }}</td>
        <td>{{ $b->kode_pembelian }}</td>
        <td>{{ $b->date }}</td>
        <td>{{ $b->hargatotal }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>
</html>