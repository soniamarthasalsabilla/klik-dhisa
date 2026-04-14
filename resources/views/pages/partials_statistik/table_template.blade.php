@php
    $grandTotal = array_sum(array_column($data, 1));
    $grandL     = array_sum(array_column($data, 2));
    $grandP     = array_sum(array_column($data, 3));
@endphp
<h6 class="fw-bold mt-4 mb-3" style="color:var(--color-7);">{{ $title }}</h6>
<div class="table-responsive">
    <table class="table table-bordered align-middle text-center small">
        <thead style="background:var(--color-1);">
            <tr>
                <th rowspan="2" class="align-middle">No</th>
                <th rowspan="2" class="align-middle text-start">Kategori</th>
                <th colspan="2" style="background:var(--color-2);color:var(--color-7);">Jumlah</th>
                <th colspan="2">Laki-laki</th>
                <th colspan="2">Perempuan</th>
            </tr>
            <tr>
                <th>n</th><th>%</th><th>n</th><th>%</th><th>n</th><th>%</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $index => $row)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td class="text-start px-3">{{ $row[0] }}</td>
                <td class="fw-bold" style="color:var(--color-6);">{{ number_format($row[1]) }}</td>
                <td>{{ $grandTotal > 0 ? round(($row[1]/$grandTotal)*100, 1) : 0 }}%</td>
                <td>{{ number_format($row[2]) }}</td>
                <td>{{ $grandTotal > 0 ? round(($row[2]/$grandTotal)*100, 1) : 0 }}%</td>
                <td>{{ number_format($row[3]) }}</td>
                <td>{{ $grandTotal > 0 ? round(($row[3]/$grandTotal)*100, 1) : 0 }}%</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot style="background:var(--color-1);font-weight:700;">
            <tr>
                <td colspan="2" class="text-start px-3">TOTAL</td>
                <td style="color:var(--color-6);">{{ number_format($grandTotal) }}</td>
                <td>100%</td>
                <td>{{ number_format($grandL) }}</td>
                <td>{{ $grandTotal > 0 ? round(($grandL/$grandTotal)*100, 1) : 0 }}%</td>
                <td>{{ number_format($grandP) }}</td>
                <td>{{ $grandTotal > 0 ? round(($grandP/$grandTotal)*100, 1) : 0 }}%</td>
            </tr>
        </tfoot>
    </table>
</div>
