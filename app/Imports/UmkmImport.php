<?php

namespace App\Imports;

use App\Models\Umkm;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;

class UmkmImport extends DefaultValueBinder implements
    ToModel,
    WithHeadingRow,
    WithValidation,
    SkipsOnFailure,
    WithBatchInserts,
    WithChunkReading,
    WithCustomValueBinder
{
    use SkipsFailures;

    // Paksa semua nilai CSV dibaca sebagai string agar desimal tidak hilang
    public function bindValue(Cell $cell, $value): bool
    {
        $cell->setValueExplicit((string) $value, DataType::TYPE_STRING);
        return true;
    }

    public function model(array $row): ?Umkm
    {
        $lat = isset($row['latitude']) && trim($row['latitude']) !== ''
            ? (float) str_replace(',', '.', $row['latitude'])
            : null;

        $lng = isset($row['longitude']) && trim($row['longitude']) !== ''
            ? (float) str_replace(',', '.', $row['longitude'])
            : null;

        return new Umkm([
            'nama_usaha' => $row['nama_usaha'],
            'pemilik'    => $row['pemilik'],
            'kategori'   => $row['kategori'],
            'no_hp'      => isset($row['no_hp'])    && trim($row['no_hp'])    !== '' ? $row['no_hp']    : null,
            'alamat'     => isset($row['alamat'])   && trim($row['alamat'])   !== '' ? $row['alamat']   : null,
            'dusun'      => isset($row['dusun'])    && trim($row['dusun'])    !== '' ? $row['dusun']    : null,
            'latitude'   => $lat,
            'longitude'  => $lng,
            'foto'       => null,
        ]);
    }

    public function rules(): array
    {
        return [
            'nama_usaha' => 'required|string|max:255',
            'pemilik'    => 'required|string|max:255',
            'kategori'   => 'required|string|max:100',
        ];
    }

    public function batchSize(): int
    {
        return 100;
    }

    public function chunkSize(): int
    {
        return 100;
    }
}
