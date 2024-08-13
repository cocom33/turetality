<table>
    <thead>
        <tr>
            <th width="40px" style="font-weight: bold">No</th>
            <th width="150px" style="font-weight: bold">Pelapor</th>
            <th width="150px" style="font-weight: bold">Menu</th>
            <th width="120px" style="font-weight: bold">Asal</th>
            <th width="170px" style="font-weight: bold">Waktu Makanan Datang</th>
            <th style="font-weight: bold">Photo</th>
            <th width="250px" style="font-weight: bold">Catatan</th>
            <th width="160px" style="font-weight: bold">Tanggal Laporan Dibuat</th>
        </tr>
    </thead>
    <tbody>
        @foreach($result as $key => $data)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $data->user_id ? $data->user->name : "Admin" }}</td>
                <td>{{ $data->menu }}</td>
                <td>{{ $data->asal }}</td>
                <td>{{ $data->date }}</td>
                <td>{{ $data->photo ? 'ada' : 'tidak' }}</td>
                <td>{{ $data->catatan }}</td>
                <td>{{ $data->created_at->format('d-m-Y') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
