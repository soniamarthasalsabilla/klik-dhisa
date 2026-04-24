<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ActivityLog extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id', 'type', 'subject_type', 'subject_id', 'subject_label',
        'description', 'old_values', 'new_values', 'ip_address', 'created_at',
    ];

    protected $casts = [
        'old_values' => 'array',
        'new_values' => 'array',
        'created_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function record(string $type, string $description, $subject = null, ?array $oldValues = null, ?array $newValues = null): void
    {
        static::create([
            'user_id'       => Auth::id(),
            'type'          => $type,
            'subject_type'  => $subject ? class_basename($subject) : null,
            'subject_id'    => $subject?->getKey(),
            'subject_label' => $subject ? static::resolveLabel($subject) : null,
            'description'   => $description,
            'old_values'    => $oldValues,
            'new_values'    => $newValues,
            'ip_address'    => request()->ip(),
            'created_at'    => now(),
        ]);
    }

    private static function resolveLabel($model): string
    {
        foreach (['nama_usaha', 'judul', 'nama', 'title', 'label', 'nama_aset', 'nama_kegiatan', 'key'] as $field) {
            if (!empty($model->$field)) {
                return $model->$field;
            }
        }

        return class_basename($model) . ' #' . $model->getKey();
    }

    public static function typeLabel(string $type): string
    {
        return [
            'login'    => 'Login',
            'logout'   => 'Logout',
            'created'  => 'Tambah Data',
            'updated'  => 'Ubah Data',
            'deleted'  => 'Hapus Data',
            'imported' => 'Import',
            'exported' => 'Export',
            'viewed'   => 'Lihat',
        ][$type] ?? ucfirst($type);
    }

    public static function typeBadgeColor(string $type): string
    {
        return [
            'login'    => 'success',
            'logout'   => 'secondary',
            'created'  => 'primary',
            'updated'  => 'warning',
            'deleted'  => 'danger',
            'imported' => 'info',
            'exported' => 'info',
            'viewed'   => 'light',
        ][$type] ?? 'secondary';
    }
}
