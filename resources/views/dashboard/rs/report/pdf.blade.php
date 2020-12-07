<!DOCTYPE html>
<html>
<head>
	<title>Laporan</title>
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
		<h5>Laporan {{ $month }}</h4>		
	</center>

	<table class='table table-bordered'>
		<thead>
            <tr>
                <th width="10">No</th>
                <th>Nama Pasien</th>
                <th>Diagnosa</th>
                <th>Nama Dokter</th>
                <th>Tanggal</th>
            </tr>
		</thead>
		<tbody>
            @foreach ($datas as $data)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $data->nama_pasien }}</td>
                <td>{{ $data->diagnosa }}</td>
                <td>{{ $data->nama_dokter }}</td>
                <td>{{ $data->tanggal }}</td>
            </tr>
            @endforeach
		</tbody>
	</table>

</body>
</html>