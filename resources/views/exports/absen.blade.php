<table>
    <tbody>
        <tr>
            <td colspan="7">
                Daftar Siswa
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
            <th>No.</th>
            <th>NIS</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Asal Sekolah</th>
        </tr>        
    </thead>
    <tbody>
        @foreach($data as $kk => $dt)            
            <tr>
                <td>{{ $kk + 1 }}</td>
                <td>{{ $dt->email }}</td>
                <td>{{ $dt->name }}</td>
                <td>{{ $dt->kelas }}</td>
                <td>{{ $dt->asal_sekolah }}</td>
            </tr>            
        @endforeach
    </tbody>
</table>
