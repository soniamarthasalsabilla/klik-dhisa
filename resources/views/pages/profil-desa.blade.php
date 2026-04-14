@extends('layouts.app')

@push('styles')
<style>
    .stat-card {
        border-radius: 14px;
        background: white;
        border: 1px solid var(--color-2);
        padding: 20px 16px;
        text-align: center;
        transition: .2s;
    }
    .stat-card:hover { border-color: var(--color-4); box-shadow: 0 6px 20px rgba(58,154,140,.12); }
    .stat-card .icon-wrap {
        width: 50px; height: 50px; border-radius: 12px;
        background: var(--color-1);
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 10px;
        font-size: 1.2rem; color: var(--color-5);
    }
    .stat-card .val { font-size: 1.5rem; font-weight: 800; color: var(--color-7); line-height: 1; }
    .stat-card .sat { font-size: .75rem; font-weight: 400; }
    .stat-card .lbl { font-size: .75rem; color: #6c757d; margin-top: 4px; }

    .section-card {
        background: white;
        border-radius: 16px;
        border: 1px solid var(--color-2);
        padding: 28px;
        box-shadow: 0 2px 12px rgba(0,0,0,.05);
    }
    .section-title {
        font-size: 1rem; font-weight: 700; color: var(--color-7);
        display: flex; align-items: center; gap: 10px; margin-bottom: 18px;
    }
    .section-title .title-icon {
        width: 36px; height: 36px; border-radius: 9px;
        background: var(--color-1);
        display: flex; align-items: center; justify-content: center;
        font-size: .9rem; color: var(--color-5); flex-shrink: 0;
    }

    .misi-item { display: flex; gap: 10px; margin-bottom: 10px; }
    .misi-item .check { color: var(--color-5); margin-top: 3px; flex-shrink: 0; }

    .batas-item {
        display: flex; align-items: center; gap: 12px;
        padding: 12px 14px; border-radius: 10px;
        background: var(--color-1); border: 1px solid var(--color-2);
    }
    .batas-label {
        min-width: 72px; font-weight: 700; font-size: .78rem;
        color: var(--color-6); text-transform: uppercase; letter-spacing: .5px;
    }
</style>
@endpush

@section('content')

{{-- Hero --}}
<section class="py-3" style="background: white; border-bottom: 3px solid var(--color-5);">
    <div class="container text-center py-4">
        <h2 class="fw-bold mb-2" style="color: var(--color-7); font-size: 2rem;">
            <i class="fas fa-landmark me-2" style="color:var(--color-5);"></i>Profil Desa Tajungan
        </h2>
        <p class="mb-0" style="color: var(--color-6); font-size: 1rem;">Kecamatan Kamal, Kabupaten Bangkalan, Jawa Timur</p>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container">

        @if(empty($settings['visi']) && empty($settings['sejarah']))
        <div class="text-center py-5" style="color:#adb5bd;">
            <i class="fas fa-landmark fa-4x mb-3 opacity-25 d-block"></i>
            <p class="mb-0 fw-semibold">Profil desa belum diisi.</p>
            <small>Admin dapat mengisi melalui panel admin.</small>
        </div>
        @else

        {{-- Statistik Singkat --}}
        <div class="row g-3 mb-4">
            @php $cards = [
                ['icon'=>'fa-ruler-combined','val'=>($settings['luas_wilayah'] ?? '145'),'sat'=>'Ha','label'=>'Luas Wilayah'],
                ['icon'=>'fa-users','val'=>number_format($settings['jumlah_penduduk'] ?? 2450, 0, ',', '.'),'sat'=>'Jiwa','label'=>'Total Penduduk'],
                ['icon'=>'fa-home','val'=>number_format($settings['jumlah_kk'] ?? 650, 0, ',', '.'),'sat'=>'KK','label'=>'Kepala Keluarga'],
                ['icon'=>'fa-map-signs','val'=>($settings['jumlah_rt'] ?? '12').' / '.($settings['jumlah_rw'] ?? '4'),'sat'=>'','label'=>'RT / RW'],
                ['icon'=>'fa-calendar-check','val'=>($settings['tahun_berdiri'] ?? '1945'),'sat'=>'','label'=>'Tahun Berdiri'],
            ]; @endphp
            @foreach($cards as $c)
            <div class="col-6 col-md-4 col-lg">
                <div class="stat-card h-100">
                    <div class="icon-wrap"><i class="fas {{ $c['icon'] }}"></i></div>
                    <div class="val">{{ $c['val'] }} <span class="sat">{{ $c['sat'] }}</span></div>
                    <div class="lbl">{{ $c['label'] }}</div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Visi & Misi --}}
        @if(!empty($settings['visi']) || !empty($settings['misi']))
        <div class="row g-3 mb-4">
            @if(!empty($settings['visi']))
            <div class="col-md-5">
                <div class="section-card h-100" style="border-left: 5px solid var(--color-5);">
                    <div class="section-title">
                        <div class="title-icon"><i class="fas fa-eye"></i></div>
                        <span>Visi Desa</span>
                    </div>
                    <p class="fst-italic lh-lg mb-0" style="color:var(--color-7);font-size:.95rem;">
                        "{{ $settings['visi'] }}"
                    </p>
                </div>
            </div>
            @endif
            @if(!empty($settings['misi']))
            <div class="col-md-7">
                <div class="section-card h-100">
                    <div class="section-title">
                        <div class="title-icon"><i class="fas fa-bullseye"></i></div>
                        <span>Misi Desa</span>
                    </div>
                    @foreach(array_filter(array_map('trim', explode("\n", $settings['misi']))) as $misi)
                    <div class="misi-item">
                        <i class="fas fa-check-circle check"></i>
                        <span style="font-size:.88rem;color:#444;line-height:1.6;">{{ $misi }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
        @endif

        {{-- Batas Wilayah --}}
        @php $hasBatas = !empty($settings['batas_utara']) || !empty($settings['batas_selatan']) || !empty($settings['batas_timur']) || !empty($settings['batas_barat']); @endphp
        @if($hasBatas)
        <div class="section-card mb-4">
            <div class="section-title">
                <div class="title-icon"><i class="fas fa-map-marked-alt"></i></div>
                <span>Batas Wilayah</span>
            </div>
            <div class="row g-3">
                @foreach(['utara'=>['Utara','fa-arrow-up'],'selatan'=>['Selatan','fa-arrow-down'],'timur'=>['Timur','fa-arrow-right'],'barat'=>['Barat','fa-arrow-left']] as $key=>[$label,$ic])
                    @if(!empty($settings['batas_'.$key]))
                    <div class="col-md-6">
                        <div class="batas-item">
                            <i class="fas {{ $ic }}" style="color:var(--color-5);"></i>
                            <div class="batas-label">{{ $label }}</div>
                            <div style="font-size:.88rem;color:#444;">{{ $settings['batas_'.$key] }}</div>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
        @endif

        {{-- Sejarah --}}
        @if(!empty($settings['sejarah']))
        <div class="section-card">
            <div class="section-title">
                <div class="title-icon"><i class="fas fa-book-open"></i></div>
                <span>Sejarah Desa</span>
            </div>
            <div style="white-space:pre-line;line-height:1.9;color:#444;font-size:.9rem;">{{ $settings['sejarah'] }}</div>
        </div>
        @endif

        @endif
    </div>
</section>

@endsection
