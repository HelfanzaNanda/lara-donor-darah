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
		<h5>Rumah Sakit : {{ $user->nama_rs }}</h4>		
	</center>

	<table class='table table-bordered'>
		<thead>
            <tr>
                <th width="10">No</th>
                <th>Nama Tempat</th>
                <th>Hari</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Jam Mulai</th>
                <th>Jam Selesai</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($user->schedulles as $schedulle)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $schedulle->nama_tempat }}</td>
                <td>{{ $schedulle->hari }}</td>
                <td>{{ $schedulle->tanggal }}</td>
                <td>{{ $schedulle->status }}</td>
                <td>{{ $schedulle->jam_mulai }}</td>
                <td>{{ $schedulle->jam_selesai }}</td>
            </tr>
            @endforeach
        </tbody>
	</table>

</body>
</html>