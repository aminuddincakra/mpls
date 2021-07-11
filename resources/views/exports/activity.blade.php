<table>
    <tbody>
        <tr>
            <td colspan="7">
                Daftar Aktivitas Siswa
            </td>
        </tr>        
        <tr>
            <td colspan="7">
                Generated on {{ \Carbon\Carbon::now()->format('D, d M Y H:i') }}
            </td>
        </tr>        
    </tbody>
</table>
<table>
    <thead>
        <tr>
            <th rowspan="2">No.</th>
            <th rowspan="2">Nama</th>
            <th rowspan="2">Kelas</th>
            <th colspan="{{ count($column) }}">Aktivitas</th>
        </tr>        
        <tr>
            @foreach($column as $key => $dt)
                <th>{{ $key }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($data as $kk => $dt)            
            <tr>
                <td>{{ $kk + 1 }}</td>
                <td>{{ $dt['name'] }}</td>
                <td>{{ $dt['kelas'] }}</td>
                @foreach($column as $d)
                    <td>{{ (array_key_exists($d, $dt['activity'])) ? \Carbon\Carbon::parse($dt['activity'][$d])->format('H:i:s') : '-' }}</td>
                @endforeach
            </tr>            
        @endforeach
    </tbody>
</table>
