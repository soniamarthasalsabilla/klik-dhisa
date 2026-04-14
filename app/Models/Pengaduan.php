<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    protected $fillable = ['nama', 'email', 'no_hp', 'kategori', 'judul', 'isi', 'status', 'catatan_admin'];

    public static array $statusLabels = [
        'menunggu' => ['label' => 'Menunggu',  'color' => 'warning'],
        'diproses' => ['label' => 'Diproses',  'color' => 'info'],
        'selesai'  => ['label' => 'Selesai',   'color' => 'success'],
        'ditolak'  => ['label' => 'Ditolak',   'color' => 'danger'],
    ];

    public function getStatusBadgeAttribute(): string
    {
        $info = self::$statusLabels[$this->status] ?? ['label' => $this->status, 'color' => 'secondary'];
        return '<span class="badge bg-' . $info['color'] . '">' . $info['label'] . '</span>';
    }
}
