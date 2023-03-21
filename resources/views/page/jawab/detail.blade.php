<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Quis</th>
            <th>Kunci Jawaban</th>
            <th>Jawaban Siswa</th>
            <th>Value</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $no => $row)
        <tr>
            <td>{{ $no+1 }}</td>
            <td>{{ $row->soal }}</td>
            <td>{{ $row->kunci }}</td>
            <td>{{ $row->jawaban }}</td>
            <td>{{ $row->value }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
