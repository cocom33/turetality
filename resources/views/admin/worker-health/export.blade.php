<table>
    <thead>
        <tr>
            <th width="40px" style="font-weight: bold">No</th>
            <th width="160px" style="font-weight: bold">Name</th>
            <th width="140px" style="font-weight: bold">Keluhan</th>
            <th width="140px" style="font-weight: bold">Tanggal Keluhan</th>
            <th style="font-weight: bold">Photo</th>
            <th width="200px" style="font-weight: bold">Rekomendasi</th>
            <th width="200px" style="font-weight: bold">Catatan</th>
            <th width="160px" style="font-weight: bold">Tanggal Laporan Dibuat</th>
        </tr>
    </thead>
    <tbody>
        @foreach($result as $key => $data)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $data->user->name }}</td>
                <td>{{ $data->keluhan }}</td>
                <td>{{ \Carbon\Carbon::create($data->hasil_pemeriksaan)->format('d-m-Y H:i:s') }}</td>
                <td>{{ $data->photo ? 'ada' : 'tidak' }}</td>
                <td>{{ $data->recomendation ?? '-' }}</td>
                <td>{{ $data->catatan }}</td>
                <td>{{ $data->created_at->format('d-m-Y') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
