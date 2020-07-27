<html>
<head>
	<title>Laporan Darah Keluar</title>
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
		<h5>Laporan Darah Keluar</h4>
	</center>
 
	<table class='table table-bordered'>
        <thead>
            <tr>
            <th width="10">No</th>
            <th>Golongan Darah</th>
            <th>Jenis Tranfusi</th>
            <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach($lapkeluar as $lk)
            <tr>
            <th width="10">{{$loop->iteration}}</th>
            <th>{{$lk->darah->gol_dar}} ({{$lk->darah->rhesus}})</th>
            <th>{{$lk->darah->jenis_tranfusi}}</th>
            <th>{{$lk->goldar}}</th>
            </tr>
            @endforeach
        </tbody>
	</table>
</body>
</html>