<table>
    <thead>
        <tr>
            <th width="40px" style="font-weight: bold">No</th>
            {{-- <th width="150px" style="font-weight: bold">Pelapor</th> --}}
            <th width="280px" style="font-weight: bold">Deskripsi</th>
            <th width="140px" style="font-weight: bold">Tanggal Laporan</th>
            <th style="font-weight: bold">Photo</th>
            <th width="100px" style="font-weight: bold">Unit Kerja</th>
            <th width="250px" style="font-weight: bold">Catatan</th>
            <th width="100px" style="font-weight: bold">Status</th>
            <th width="160px" style="font-weight: bold">Tanggal Laporan Dibuat</th>
        </tr>
    </thead>
    <tbody>
        @foreach($result as $key => $data)
            <tr>
                <td>{{ $key + 1 }}</td>
                {{-- <td>{{ $data->user_id ? $data->user->name : "Admin" }}</td> --}}
                <td>{{ $data->description }}</td>
                <td>{{ \Carbon\Carbon::create($data->date)->format('d-m-Y H:i:s') }}</td>
                <td>{{ $data->photo ? 'ada' : 'tidak' }}</td>
                <td>{{ $data->unit_kerja }}</td>
                <td>{{ $data->catatan }}</td>
                <td>{{ $data->status ? 'selesai' : 'belum selesai' }}</td>
                <td>{{ $data->created_at->format('d-m-Y') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
