<!DOCTYPE html>
<html>
<head>
	<title>Cetak Kwitansi</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

</head>
<body>
	{{-- <style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style> --}}
	
	<table class="table text-center" style="font-size: 13px">
		<tr>
			<td class="col-md-2">Kode Pembelian: <br>{{ $transaksi->kode_pembelian }}</td>
			<td class="col-md-2">Tanggal: <br>{{ $transaksi->date }}</td>
			<td class="col-md-2">Kasir: {{ $transaksi->pegawai->name }} </td>
		</tr>
		<tr>
			<td colspan="3"></td>
		</tr>
	</table>
	<table class="table table-bordered " style="margin-top: -40px; font-size:10px" >
		<thead class="font-weight-bold">
			<td>#</td>
			<td>Nama Barang</td>
			<td>Jumlah</td>
			<td>Harga Satuan</td>
			<td>Subtotal</td>
		</thead>
		<tbody>
		  @foreach ($details as $detail)
			  
			<tr>
			<td>{{ $loop->iteration }}</td>
			<td>{{ $detail->barang->nama }}</td>
			<td>{{ $detail->quantity }}</td>
			<td>Rp. {{ number_format($detail->barang->harga) }}</td>
			<td>
			  Rp. {{ number_format($detail->subtotal) }}
			</td>
		</tr>
		@endforeach

		<tr class="font-weight-bold">
			<td colspan="4" class="text-right">Grand Total</td>
			<td>Rp. {{ number_format($transaksi->hargatotal )}}</td>
		</tr>
		<tr class="font-weight-bold">
			<td colspan="4"class="text-right">Uang Bayar</td>
			<td>Rp. {{ number_format($transaksi->paytotal) }}</td>
		</tr>
		<tr class="font-weight-bold">
			<td colspan="4"class="text-right">Kembalian</td>
			<td>Rp. {{ number_format($transaksi->kembalian) }}</td>
		</tr>
		</tbody>
	</table>
	{{-- <div class="">
	<p class=" mb-1 text-gray-800 text-right">Rp. {{ number_format($transaksi->hargatotal )}}</p>
	<p class=" mb-1 text-gray-800 text-right">Rp. {{ number_format($transaksi->paytotal) }}</p>
	<p class=" mb-1 text-gray-800 text-right">Rp. {{ number_format($transaksi->kembalian) }}</p>
	</div> --}}
	
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>
</html>