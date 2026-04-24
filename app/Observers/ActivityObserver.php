<?php

namespace App\Observers;

use App\Models\ActivityLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ActivityObserver
{
    private array $excludedFields = [
        'updated_at', 'created_at', 'password', 'remember_token',
        'latitude', 'longitude', // coordinate updates logged via map controller
    ];

    public function created(Model $model): void
    {
        if (!Auth::check()) return;

        $values = array_diff_key($model->getAttributes(), array_flip($this->excludedFields));

        ActivityLog::record(
            'created',
            'Menambahkan ' . $this->modelName($model),
            $model,
            null,
            $this->sanitize($values)
        );
    }

    public function updated(Model $model): void
    {
        if (!Auth::check()) return;

        $changes  = array_diff_key($model->getChanges(), array_flip($this->excludedFields));
        if (empty($changes)) return;

        $original = array_intersect_key($model->getOriginal(), $changes);

        ActivityLog::record(
            'updated',
            'Mengubah ' . $this->modelName($model),
            $model,
            $this->sanitize($original),
            $this->sanitize($changes)
        );
    }

    public function deleted(Model $model): void
    {
        if (!Auth::check()) return;

        $values = array_diff_key($model->getAttributes(), array_flip($this->excludedFields));

        ActivityLog::record(
            'deleted',
            'Menghapus ' . $this->modelName($model),
            $model,
            $this->sanitize($values),
            null
        );
    }

    private function modelName(Model $model): string
    {
        $names = [
            'Umkm'       => 'UMKM',
            'Statistic'  => 'Statistik',
            'PageContent'=> 'Konten',
            'DesaSetting'=> 'Pengaturan Desa',
            'Pamong'     => 'Pamong',
            'Galeri'     => 'Galeri',
            'Artikel'    => 'Artikel',
            'Apbdes'     => 'APBDes',
            'Pengaduan'  => 'Pengaduan',
            'Agenda'     => 'Agenda',
            'AsetDesa'   => 'Aset Desa',
            'BatasDusun' => 'Batas Dusun',
        ];

        return $names[class_basename($model)] ?? class_basename($model);
    }

    private function sanitize(array $values): array
    {
        return array_map(function ($v) {
            // Array/object (e.g. koordinat cast) → JSON string
            if (is_array($v) || is_object($v)) {
                $json = json_encode($v, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                return mb_strlen($json) > 200 ? mb_substr($json, 0, 200) . '…' : $json;
            }
            // Truncate very long strings (e.g. base64 images, long text)
            if (is_string($v) && mb_strlen($v) > 300) {
                return mb_substr($v, 0, 300) . '…';
            }
            return $v;
        }, $values);
    }
}
