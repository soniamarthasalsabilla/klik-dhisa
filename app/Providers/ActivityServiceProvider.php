<?php

namespace App\Providers;

use App\Observers\ActivityObserver;
use Illuminate\Support\ServiceProvider;

class ActivityServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $models = [
            \App\Models\Umkm::class,
            \App\Models\Statistic::class,
            \App\Models\PageContent::class,
            \App\Models\DesaSetting::class,
            \App\Models\Pamong::class,
            \App\Models\Galeri::class,
            \App\Models\Artikel::class,
            \App\Models\Apbdes::class,
            \App\Models\Pengaduan::class,
            \App\Models\Agenda::class,
            \App\Models\AsetDesa::class,
            \App\Models\BatasDusun::class,
        ];

        foreach ($models as $model) {
            $model::observe(ActivityObserver::class);
        }
    }
}
