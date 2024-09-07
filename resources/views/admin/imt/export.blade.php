<table>
    <thead>
        <tr>
            <th width="40px" style="font-weight: bold">No</th>
            <th width="150px" style="font-weight: bold">Nama</th>
            <th style="font-weight: bold">Umur</th>
            <th width="95px" style="font-weight: bold">Berat Badan</th>
            <th width="95px" style="font-weight: bold">Tinggi Badan</th>
            <th width="200px" style="font-weight: bold">Skor</th>
            <th width="210px" style="font-weight: bold">Tanggal Pemeriksaan Dibuat</th>
        </tr>
    </thead>
    <tbody>
        @foreach($result as $key => $data)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $data->name }}</td>
                <td>{{ $data->umur }}</td>
                <td>{{ $data->berat_badan }} KG</td>
                <td>{{ $data->tinggi_badan }} CM</td>
                <td> {{ $data->hasil }} :
                    @if ($data->hasil <= 18.5)
                        Berat Badan Kurang
                    @elseif ($data->hasil <= 22.9)
                        Berat Badan Normal
                    @elseif ($data->hasil <= 29.9)
                        Berat Badan Berlebihan
                    @else
                        Obesitas
                    @endif
                </td>
                <td>{{ $data->created_at->format('d-m-Y') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
