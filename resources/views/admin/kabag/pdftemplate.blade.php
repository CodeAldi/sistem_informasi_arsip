<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak PDF</title>
    <style>
    #customers {
    font-family: Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
    }

    #customers td, #customers th {
    border: 1px solid #ddd;
    padding: 8px;
    }

    #customers tr:nth-child(even){background-color: #f2f2f2;}

    #customers tr:hover {background-color: #ddd;}

    #customers th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #04AA6D;
    color: white;
    }
    </style>
</head>
<body>

    <h1>Laporan : </h1>

    <table id="customers">
        <tr>
            <th>NO</th>
            <th>NPM Mahasiswa</th>
            <th>Nama Mahasiswa</th>
            <th>Nama Kegiatan</th>
            <th>Tanggal Kegiatan</th>
            <th>Tingkat</th>
            <th>Organisasi atau lingkup</th>
            <th>Posisi / Sebagai</th>
            <th>Poin</th>
            <th>Status</th>
        </tr>
        @foreach ($sertifikat as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->user->username }}</td>
            <td>{{ $item->user->name }}</td>
            <td>{{ $item->nama_kegiatan }}</td>
            <td>{{ $item->tanggal_kegiatan }}</td>
            <td>{{ $item->tingkat }}</td>
            <td>{{ $item->jenis }}</td>
            <td>{{ $item->sebagai }}</td>
            <td>{{ $item->kredit_poin }}</td>
            @if ($item->status_verifikasi == 1)
                <td><div class="btn btn-primary">Menunggu Verifikasi</div></td>
            @elseif($item->status_verifikasi == 2)
                <td><div class="btn btn-warning">Data Kurang / tidak valid</div></td>
            @elseif($item->status_verifikasi == 3)
                <td><div class="btn btn-success">Disetujui</div></td>
            @else
                <td><div class="btn btn-danger">Ditolak</div></td>
            @endif
        </tr>
        @endforeach
    </table>

    
</body>
</html>