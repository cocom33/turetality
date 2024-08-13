<table>
    <thead>
        <tr>
            <th width="40px" style="font-weight: bold">No</th>
            <th width="150px" style="font-weight: bold">Pelapor</th>
            <th width="280px" style="font-weight: bold">Checklist</th>
            <th style="font-weight: bold">Photo</th>
            <th width="120px" style="font-weight: bold">Lokasi</th>
            <th width="250px" style="font-weight: bold">Catatan</th>
            <th width="160px" style="font-weight: bold">Tanggal Laporan Dibuat</th>
        </tr>
    </thead>
    <tbody>
        @foreach($result as $key => $data)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $data->user_id ? $data->user->name : "Admin" }}</td>
                <td>{{ $checklist[$data->number] }} : {{ $data->check ? 'iya' : 'tidak' }}</td>
                <td>{{ $data->photo ? 'ada' : 'tidak' }}</td>
                <td>{{ $data->place }}</td>
                <td>{{ $data->catatan }}</td>
                <td>{{ $data->created_at->format('d-m-Y') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
