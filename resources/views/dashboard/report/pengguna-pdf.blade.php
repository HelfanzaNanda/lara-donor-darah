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
                <th>Goldar</th>
                <th>Rhesus</th>
                <th>Status Donor</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $data)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $data->nama }}</td>
                <td>{{ $data->gol_dar }}</td>
                <td>{{ $data->rhesus }}</td>
                <td>{{ $data->status_donor }}</td>
                <td>{{ \Carbon\Carbon::parse($data->created_at)->format('d m Y') }}</td>
            </tr>
            @endforeach
        </tbody>
	</table>

</body>
</html>