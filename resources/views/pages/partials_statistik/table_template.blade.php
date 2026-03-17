<h6 class="fw-bold mt-4 mb-3">{{ $title }}</h6>
<div class="table-responsive">
    <table class="table table-bordered align-middle text-center small">
        <thead class="table-light">
            <tr>
                <th rowspan="2" class="align-middle">No</th>
                <th rowspan="2" class="align-middle">Kategori</th>
                <th colspan="2" class="bg-soft-primary">Jumlah</th>
                <th colspan="2">Laki-laki</th>
                <th colspan="2">Perempuan</th>
            </tr>
            <tr>
                <th>n</th><th>%</th><th>n</th><th>%</th><th>n</th><th>%</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $index => $row)
            @php $total = 2450; @endphp <tr>
                <td>{{ $index + 1 }}</td>
                <td class="text-start px-3">{{ $row[0] }}</td>
                <td class="fw-bold">{{ $row[1] }}</td>
                <td>{{ round(($row[1]/$total)*100, 1) }}%</td>
                <td>{{ $row[2] }}</td>
                <td>{{ round(($row[2]/$total)*100, 1) }}%</td>
                <td>{{ $row[3] }}</td>
                <td>{{ round(($row[3]/$total)*100, 1) }}%</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>