<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KLIK Dhisâ — Kabupaten {{ $kabupaten }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --c1:#E8F5F0; --c2:#B8E6D9; --c3:#8FD4C2;
            --c4:#5BBFAB; --c5:#3A9A8C; --c6:#2C7A6F; --c7:#1E5A52;
            --gold:#f9d923;
        }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body { font-family: 'Poppins', sans-serif; background: #f4f6f9; color: #1e293b; overflow-x: hidden; }

        /* ══════════════════════════════
           HERO
        ══════════════════════════════ */
        .hero {
            min-height: 100vh;
            background:
                linear-gradient(160deg, rgba(30,90,82,.82) 0%, rgba(58,154,140,.65) 60%, rgba(30,90,82,.55) 100%),
                url('https://images.unsplash.com/photo-1500382017468-9049fed747ef?auto=format&fit=crop&w=1800&q=80')
                center/cover no-repeat fixed;
            display: flex; flex-direction: column;
            position: relative; overflow: hidden;
        }
        .hero::after {
            content: '';
            position: absolute; bottom: 0; left: 0; right: 0;
            height: 120px;
            background: linear-gradient(to top, #f4f6f9 0%, transparent 100%);
            pointer-events: none;
        }

        /* Top bar */
        .hero-topbar {
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            align-items: center;
            padding: 20px 40px;
            position: relative; z-index: 2;
        }
        .hero-topbar-right { justify-self: end; }
        .hero-brand { display: flex; align-items: center; gap: 12px; text-decoration: none; }
        .hero-brand-icon {
            width: 44px; height: 44px; border-radius: 10px;
            background: rgba(255,255,255,.15); border: 1px solid rgba(255,255,255,.25);
            display: flex; align-items: center; justify-content: center;
            font-size: 1.2rem; color: var(--gold);
        }
        .hero-brand-text strong { display: block; color: white; font-size: 1rem; font-weight: 800; line-height: 1.2; letter-spacing: .3px; }
        .hero-brand-text strong em { color: var(--gold); font-style: normal; }
        .hero-brand-text small  { display: block; color: rgba(255,255,255,.6); font-size: .66rem; }
        .hero-topbar-right { color: rgba(255,255,255,.6); font-size: .75rem; text-align: right; }

        /* Center content */
        .hero-center {
            flex: 1; display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            text-align: center; padding: 40px 20px 80px;
            position: relative; z-index: 2;
        }
        .hero-eyebrow {
            display: inline-flex; align-items: center; gap: 8px;
            background: rgba(255,255,255,.15); backdrop-filter: blur(8px);
            border: 1px solid rgba(255,255,255,.25);
            border-radius: 50px; padding: 6px 20px;
            color: rgba(255,255,255,.9); font-size: .78rem; font-weight: 600;
            letter-spacing: .5px; text-transform: uppercase;
            margin-bottom: 22px;
        }
        .hero-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2.2rem, 6vw, 4.2rem);
            color: white; line-height: 1.15;
            text-shadow: 0 2px 24px rgba(0,0,0,.25);
            margin-bottom: 16px;
        }
        .hero-title span { color: var(--gold); }
        .hero-subtitle {
            font-size: clamp(.88rem, 2vw, 1.05rem);
            color: rgba(255,255,255,.82); max-width: 520px;
            line-height: 1.75; margin-bottom: 48px;
        }

        /* Pertanyaan */
        .hero-question {
            font-size: clamp(1.1rem, 3vw, 1.6rem);
            font-weight: 800; color: white;
            margin-bottom: 8px;
            text-shadow: 0 2px 12px rgba(0,0,0,.2);
        }
        .hero-question-sub {
            font-size: .83rem; color: rgba(255,255,255,.65); margin-bottom: 32px;
        }

        /* Scroll down */
        .scroll-hint {
            position: absolute; bottom: 130px; left: 50%; transform: translateX(-50%);
            color: rgba(255,255,255,.5); font-size: .72rem; text-align: center;
            animation: bounce 2s infinite; z-index: 2; cursor: pointer;
        }
        .scroll-hint i { display: block; font-size: 1.2rem; margin-top: 4px; }
        @keyframes bounce {
            0%,100% { transform: translateX(-50%) translateY(0); }
            50%      { transform: translateX(-50%) translateY(6px); }
        }

        /* ══════════════════════════════
           SECTION KECAMATAN
        ══════════════════════════════ */
        #section-kec { padding: 80px 0 80px; background: #f4f6f9; }
        .section-label {
            font-size: .72rem; font-weight: 700; letter-spacing: 2px;
            text-transform: uppercase; color: var(--c5); margin-bottom: 8px;
        }
        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(1.6rem, 4vw, 2.2rem); color: var(--c7);
            margin-bottom: 6px;
        }
        .section-sub { color: #64748b; font-size: .88rem; margin-bottom: 36px; }

        .kec-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(155px, 1fr));
            gap: 14px;
        }
        .kec-card {
            background: white; border-radius: 16px;
            border: 2px solid transparent;
            padding: 24px 16px; text-align: center;
            cursor: pointer; transition: .22s;
            box-shadow: 0 2px 10px rgba(0,0,0,.05);
        }
        .kec-card:hover {
            border-color: var(--c5); transform: translateY(-4px);
            box-shadow: 0 10px 28px rgba(58,154,140,.18);
        }
        .kec-card.active-kec { border-color: var(--c6); background: var(--c7); }
        .kec-card.active-kec .kec-icon { background: rgba(255,255,255,.15); color: var(--gold); }
        .kec-card.active-kec .kec-name { color: white; }
        .kec-card.active-kec .kec-count { color: rgba(255,255,255,.6); }
        .kec-icon {
            width: 52px; height: 52px; border-radius: 14px;
            background: var(--c1); color: var(--c6);
            display: flex; align-items: center; justify-content: center;
            font-size: 1.25rem; margin: 0 auto 14px; transition: .2s;
        }
        .kec-name  { font-size: .83rem; font-weight: 700; color: var(--c7); line-height: 1.3; }
        .kec-count { font-size: .71rem; color: #94a3b8; margin-top: 4px; }

        /* ══════════════════════════════
           SECTION DESA
        ══════════════════════════════ */
        #section-desa {
            padding: 60px 0 80px;
            background: white;
            display: none;
        }
        #section-desa.show { display: block; animation: fadeUp .35s ease; }

        .search-wrap { position: relative; max-width: 380px; margin-bottom: 20px; }
        .search-wrap input {
            width: 100%; padding: 10px 16px 10px 42px;
            border: 1.5px solid var(--c2); border-radius: 10px;
            font-family: 'Poppins', sans-serif; font-size: .87rem;
            outline: none; transition: border-color .2s; background: #fafafa;
        }
        .search-wrap input:focus { border-color: var(--c5); background: white; }
        .search-wrap i { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: var(--c4); }

        .legend { display: flex; gap: 18px; margin-bottom: 20px; font-size: .78rem; color: #64748b; }
        .ldot { width: 9px; height: 9px; border-radius: 50%; display: inline-block; margin-right: 5px; vertical-align: middle; }

        .desa-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(210px, 1fr));
            gap: 12px;
        }
        .desa-card {
            background: #fafafa; border-radius: 12px;
            border: 1.5px solid #e8edf3;
            padding: 15px 18px; cursor: pointer; transition: .18s;
            display: flex; align-items: center; gap: 13px;
        }
        .desa-card:hover { border-color: var(--c5); background: white; box-shadow: 0 4px 16px rgba(58,154,140,.1); }
        .ddot { width: 10px; height: 10px; border-radius: 50%; background: #d1d5db; flex-shrink: 0; }
        .desa-card.has-web .ddot { background: var(--c5); }
        .dname { font-weight: 700; font-size: .87rem; color: var(--c7); }
        .dstatus { font-size: .7rem; color: #94a3b8; margin-top: 2px; }
        .desa-card.has-web .dstatus { color: var(--c5); }

        /* ══════════════════════════════
           MODAL LAYANAN
        ══════════════════════════════ */
        .lay-overlay {
            position: fixed; inset: 0;
            background: rgba(15,30,25,.65); backdrop-filter: blur(4px);
            z-index: 9000; display: none;
            align-items: center; justify-content: center; padding: 20px;
        }
        .lay-overlay.show { display: flex; animation: fadeIn .22s ease; }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }

        .lay-modal {
            background: white; border-radius: 22px;
            width: 100%; max-width: 540px;
            box-shadow: 0 32px 80px rgba(0,0,0,.25);
            overflow: hidden; animation: slideUp .28s ease;
        }
        @keyframes slideUp {
            from { transform: translateY(30px); opacity: 0; }
            to   { transform: translateY(0);    opacity: 1; }
        }

        .lay-modal-head {
            background: linear-gradient(135deg, var(--c7) 0%, var(--c5) 100%);
            padding: 28px 32px;
            display: flex; align-items: center; justify-content: space-between;
        }
        .lay-modal-head .dest-label { font-size: .7rem; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; color: rgba(255,255,255,.65); margin-bottom: 4px; }
        .lay-modal-head .dest-name  { font-family: 'Playfair Display', serif; font-size: 1.5rem; color: white; line-height: 1.2; }
        .lay-modal-head .dest-kec   { font-size: .8rem; color: rgba(255,255,255,.65); margin-top: 3px; }
        .lay-close {
            width: 36px; height: 36px; border-radius: 50%;
            background: rgba(255,255,255,.15); border: none; cursor: pointer;
            color: white; font-size: 1rem; display: flex; align-items: center; justify-content: center;
            transition: .2s; flex-shrink: 0;
        }
        .lay-close:hover { background: rgba(255,255,255,.25); }

        .lay-modal-body { padding: 28px 32px 32px; }
        .lay-q { font-weight: 700; color: var(--c7); font-size: .95rem; margin-bottom: 18px; }

        .lay-cards { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
        @media(max-width:460px) { .lay-cards { grid-template-columns: 1fr; } }

        .lay-card {
            border-radius: 14px; padding: 24px 18px; text-align: center;
            text-decoration: none; display: block; transition: .22s;
            box-shadow: 0 3px 14px rgba(0,0,0,.08);
        }
        .lay-card:hover { transform: translateY(-3px); box-shadow: 0 10px 28px rgba(0,0,0,.15); }
        .lay-card.lc-web      { background: linear-gradient(135deg, var(--c7), var(--c5)); color: white; }
        .lay-card.lc-data     { background: linear-gradient(135deg, #92400e, #d97706); color: white; }
        .lay-card.lc-disabled { background: #f1f5f9; color: #94a3b8; cursor: not-allowed; pointer-events: none; box-shadow: none; }
        .lay-card .lci {
            width: 60px; height: 60px; border-radius: 50%;
            background: rgba(255,255,255,.18);
            display: flex; align-items: center; justify-content: center;
            font-size: 1.5rem; margin: 0 auto 14px;
        }
        .lay-card.lc-disabled .lci { background: #e2e8f0; color: #cbd5e1; }
        .lay-card .lt { font-size: .95rem; font-weight: 800; margin-bottom: 6px; }
        .lay-card .ld { font-size: .75rem; opacity: .85; line-height: 1.5; }
        .lay-card .lb {
            display: inline-block; margin-top: 14px;
            padding: 4px 14px; border-radius: 50px;
            background: rgba(255,255,255,.2); font-size: .73rem; font-weight: 700;
        }
        .lay-card.lc-disabled .lt, .lay-card.lc-disabled .ld { color: #94a3b8; }
        .lay-card.lc-disabled .lb { background: #e2e8f0; color: #94a3b8; }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(14px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ══════════════════════════════
           STAT BRIDGE (jembatan hero → kecamatan)
        ══════════════════════════════ */
        .stat-bridge-wrap { background: #f4f6f9; }
        .hero-stat-strip {
            background: white;
            border-radius: 20px;
            box-shadow: 0 12px 40px rgba(0,0,0,.1);
            padding: 28px 10px;
            margin-top: -50px;
            position: relative;
            z-index: 10;
        }
        .hss-item { text-align: center; padding: 0 12px; }
        .hss-icon {
            width: 46px; height: 46px; border-radius: 12px;
            background: var(--c1); color: var(--c5);
            display: flex; align-items: center; justify-content: center;
            font-size: 1.1rem; margin: 0 auto 8px;
        }
        .hss-val {
            font-size: 1.6rem; font-weight: 800;
            color: var(--c7); line-height: 1;
        }
        .hss-val .sat {
            font-size: .65rem; font-weight: 400; color: #888;
        }
        .hss-lbl { font-size: .72rem; color: #6c757d; margin-top: 4px; }
        .hss-divider { width: 1px; background: var(--c2); }

        .portal-footer {
            background: var(--c7); color: rgba(255,255,255,.55);
            text-align: center; padding: 22px 20px; font-size: .75rem;
        }
        .portal-footer strong { color: rgba(255,255,255,.85); }

        /* ══════════════════════════════
           LOGO STRIP
        ══════════════════════════════ */
        .logo-strip {
            display: inline-flex; align-items: center; justify-content: center;
            gap: 0;
            background: rgba(255,255,255,.15);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,.28);
            border-radius: 10px;
            padding: 6px 12px;
        }
        .logo-item {
            display: flex; flex-direction: column; align-items: center;
            padding: 0 10px;
        }
        .logo-item img {
            height: 24px; width: auto;
            object-fit: contain;
            filter: drop-shadow(0 1px 3px rgba(0,0,0,.2));
        }
        .logo-item .logo-fb {
            display: none; width: 24px; height: 24px;
            align-items: center; justify-content: center;
        }
        .logo-item .logo-label {
            font-size: .5rem; font-weight: 700; text-transform: uppercase;
            letter-spacing: .3px; color: rgba(255,255,255,.7);
            text-align: center; margin-top: 3px; line-height: 1.3;
        }
        .logo-sep {
            width: 1px; height: 22px;
            background: rgba(255,255,255,.3);
            flex-shrink: 0;
        }
    </style>
</head>
<body>

<section class="hero">
    <div class="hero-topbar">
        <a href="{{ route('portal') }}" class="hero-brand" onclick="resetPortal(); return false;">
            <div class="hero-brand-icon"><i class="fas fa-landmark"></i></div>
            <div class="hero-brand-text">
                <strong>KLIK <em>Dhisâ</em></strong>
                <small>Kab. {{ $kabupaten }} &mdash; Kanal Layanan Informasi &amp; Statistik</small>
            </div>
        </a>

        {{-- Logo Strip: Pemda · BPS · Desa Cantik --}}
        <div class="logo-strip">
            <div class="logo-item">
                <img src="/img/logo pemda.png" alt="Logo Pemda Bangkalan"
                     onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">
                <div class="logo-fb"><i class="fas fa-landmark" style="font-size:1.4rem;color:rgba(255,255,255,.85);"></i></div>
                <div class="logo-label">Pemda<br>Bangkalan</div>
            </div>
            <div class="logo-sep"></div>
            <div class="logo-item">
                <img src="/img/logo bps.png" alt="Logo BPS"
                     onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">
                <div class="logo-fb"><i class="fas fa-chart-bar" style="font-size:1.4rem;color:rgba(255,255,255,.85);"></i></div>
                <div class="logo-label">Badan Pusat<br>Statistik</div>
            </div>
            <div class="logo-sep"></div>
            <div class="logo-item">
                <img src="/img/desa cantik.png" alt="Desa Cantik"
                     onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">
                <div class="logo-fb"><i class="fas fa-star" style="font-size:1.4rem;color:rgba(255,255,255,.85);"></i></div>
                <div class="logo-label">Desa<br>Cantik</div>
            </div>
        </div>

        <div class="hero-topbar-right d-none d-md-block">
            <i class="fas fa-map-marker-alt me-1"></i>Kabupaten {{ $kabupaten }}, {{ $provinsi }}
        </div>
    </div>

    <div class="hero-center">
        <div class="hero-eyebrow">
            <i class="fas fa-map-marked-alt"></i>
            Kabupaten {{ $kabupaten }} &mdash; {{ $provinsi }}
        </div>

        <h1 class="hero-title">
            Selamat Datang di<br>
            <span>KLIK Dhisâ</span>
        </h1>

        <p style="font-size:.82rem;color:rgba(255,255,255,.6);letter-spacing:.5px;text-transform:uppercase;font-weight:600;margin-bottom:6px;">
            Kanal Layanan Informasi dan Statistik Dhisâ
        </p>

        <p class="hero-subtitle" style="margin-top:14px;">
            Satu portal untuk mengakses website dan data seluruh desa
            di Kabupaten {{ $kabupaten }}.
        </p>

        <div class="hero-question">Ingin berkunjung ke mana?</div>
        <p class="hero-question-sub">Pilih kecamatan tujuan Anda di bawah ini</p>

        <a href="#section-kec" class="btn" style="background:white;color:var(--c7);border-radius:50px;padding:12px 30px;font-weight:700;font-size:.9rem;box-shadow:0 4px 18px rgba(0,0,0,.15);text-decoration:none;display:inline-flex;align-items:center;gap:8px;">
            <i class="fas fa-compass"></i> Jelajahi Kecamatan
        </a>

    </div>

    <div class="scroll-hint" onclick="document.getElementById('section-kec').scrollIntoView({behavior:'smooth'})">
        Scroll ke bawah
        <i class="fas fa-chevron-down"></i>
    </div>
</section>

@php
    $totalKec  = count($kecamatan);
    $totalDesa = array_sum(array_map('count', $kecamatan));
    $desaWeb   = 0;
    foreach ($kecamatan as $_dl) {
        foreach ($_dl as $_d) { if (!empty($_d['website'])) $desaWeb++; }
    }
    $pctWeb = $totalDesa > 0 ? round($desaWeb / $totalDesa * 100, 1) : 0;
@endphp
<div class="stat-bridge-wrap">
    <div class="container" style="max-width:900px;">
        <div class="hero-stat-strip">
            <div class="row g-0 align-items-center">
                @php
                    $bridgeStats = [
                        ['fa-map-marked-alt', $totalKec,  '',   'Kecamatan'],
                        ['fa-home',           $totalDesa, '',   'Total Desa'],
                        ['fa-globe',          $desaWeb,   '',   'Terhubung Web'],
                        ['fa-chart-pie',      $pctWeb,    '%',  'Persentase'],
                    ];
                @endphp
                @foreach($bridgeStats as $i => [$ic, $val, $sat, $lbl])
                <div class="col">
                    <div class="hss-item">
                        <div class="hss-icon"><i class="fas {{ $ic }}"></i></div>
                        <div class="hss-val">{{ $val }}<span class="sat"> {{ $sat }}</span></div>
                        <div class="hss-lbl">{{ $lbl }}</div>
                    </div>
                </div>
                @if($i < count($bridgeStats) - 1)
                <div class="col-auto d-none d-md-block" style="padding:0;">
                    <div class="hss-divider" style="height:60px;"></div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>
</div>

<section id="section-kec">
    <div class="container" style="max-width:900px;">
        <div class="section-label"><i class="fas fa-map-marker-alt me-1"></i>Langkah 1</div>
        <div class="section-title">Pilih Kecamatan</div>
        <p class="section-sub">Klik salah satu kecamatan untuk melihat daftar desa.</p>

        <div class="kec-grid">
            @php
                $icons = ['fa-map','fa-city','fa-tree','fa-water','fa-mountain','fa-sun','fa-leaf','fa-star'];
                $i = 0;
            @endphp
            @foreach($kecamatan as $nama => $desaList)
            <div class="kec-card" data-kec="{{ $nama }}" onclick="pilihKecamatan('{{ $nama }}')">
                <div class="kec-icon"><i class="fas {{ $icons[$i++ % count($icons)] }}"></i></div>
                <div class="kec-name">Kec. {{ $nama }}</div>
                <div class="kec-count">{{ count($desaList) }} desa</div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section id="section-desa">
    <div class="container" style="max-width:900px;">
        <div class="section-label"><i class="fas fa-village me-1"></i>Langkah 2</div>
        <div class="section-title">
            Pilih Desa
            <span id="desa-kec-badge" style="font-family:'Poppins',sans-serif;font-size:.75rem;font-weight:600;background:var(--c1);color:var(--c6);border-radius:50px;padding:4px 14px;vertical-align:middle;margin-left:10px;"></span>
        </div>
        <p class="section-sub">Pilih desa yang ingin Anda kunjungi di Kecamatan <span id="sub-kec-name" style="font-weight:700;color:var(--c6);"></span>.</p>

        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-2">
            <div class="legend">
                <span><span class="ldot" style="background:var(--c5);"></span>Website tersedia</span>
                <span><span class="ldot" style="background:#d1d5db;"></span>Belum tersedia</span>
            </div>
            <div class="search-wrap mb-0">
                <i class="fas fa-search"></i>
                <input type="text" id="searchDesa" placeholder="Cari desa..." oninput="filterDesa()">
            </div>
        </div>

        <div class="desa-grid" id="desa-grid"></div>
    </div>
</section>

<div class="lay-overlay" id="layOverlay" onclick="tutupModal(event)">
    <div class="lay-modal" id="layModal">
        <div class="lay-modal-head">
            <div>
                <div class="dest-label">Desa / Kelurahan</div>
                <div class="dest-name" id="modal-desa">—</div>
                <div class="dest-kec">Kec. <span id="modal-kec">—</span> · Kab. {{ $kabupaten }}</div>
            </div>
            <button class="lay-close" onclick="tutupModal()"><i class="fas fa-times"></i></button>
        </div>
        <div class="lay-modal-body">
            <div class="lay-q"><i class="fas fa-hand-pointer me-2" style="color:var(--c5);"></i>Apa yang ingin Anda akses?</div>
            <div class="lay-cards">
                <a id="card-website" href="#" class="lay-card lc-web" target="_blank" rel="noopener">
                    <div class="lci"><i class="fas fa-globe"></i></div>
                    <div class="lt">Website Desa</div>
                    <div class="ld">Informasi, berita, layanan publik, dan profil desa.</div>
                    <span class="lb" id="badge-web"><i class="fas fa-arrow-right me-1"></i>Kunjungi</span>
                </a>
                <a id="card-bankdata" href="#" class="lay-card lc-data" target="_blank" rel="noopener">
                    <div class="lci"><i class="fas fa-database"></i></div>
                    <div class="lt">Bank Data Desa</div>
                    <div class="ld">Statistik, kependudukan, potensi, dan aset desa.</div>
                    <span class="lb" id="badge-bd"><i class="fas fa-arrow-right me-1"></i>Akses Data</span>
                </a>
            </div>
        </div>
    </div>
</div>

{{-- FOOTER --}}
<footer class="portal-footer">
    <strong>KLIK Dhisâ</strong> &mdash; Kanal Layanan Informasi dan Statistik Dhisâ<br>
    <span style="font-size:.7rem;">Kabupaten {{ $kabupaten }}, {{ $provinsi }} &copy; {{ date('Y') }}</span>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const portalData = @json($kecamatan);
    let selectedKec = null;

    function pilihKecamatan(nama) {
        // Highlight kec terpilih
        document.querySelectorAll('.kec-card').forEach(c => c.classList.remove('active-kec'));
        document.querySelector(`.kec-card[data-kec="${nama}"]`).classList.add('active-kec');

        selectedKec = nama;
        document.getElementById('desa-kec-badge').textContent = 'Kec. ' + nama;
        document.getElementById('sub-kec-name').textContent   = nama;
        document.getElementById('searchDesa').value = '';

        renderDesa(portalData[nama]);

        const secDesa = document.getElementById('section-desa');
        secDesa.classList.add('show');
        setTimeout(() => secDesa.scrollIntoView({ behavior: 'smooth', block: 'start' }), 50);
    }

    function renderDesa(list) {
        const grid = document.getElementById('desa-grid');
        if (!list || list.length === 0) {
            grid.innerHTML = '<p class="text-muted small py-3">Tidak ada desa ditemukan.</p>';
            return;
        }
        grid.innerHTML = list.map((d, idx) =>
            `<div class="desa-card ${d.website ? 'has-web' : ''}" onclick="pilihDesa(${idx})">
                <div class="ddot"></div>
                <div>
                    <div class="dname">Desa ${escHtml(d.nama)}</div>
                    <div class="dstatus">${d.website ? '● Website tersedia' : 'Belum tersedia'}</div>
                </div>
            </div>`
        ).join('');
    }

    function filterDesa() {
        const q = document.getElementById('searchDesa').value.toLowerCase().trim();
        const list = portalData[selectedKec].filter(d => d.nama.toLowerCase().includes(q));
        renderDesa(list);
    }

    function pilihDesa(idx) {
        const q    = document.getElementById('searchDesa').value.toLowerCase().trim();
        const list = portalData[selectedKec].filter(d => d.nama.toLowerCase().includes(q));
        const d    = list[idx];
        if (!d) return;

        document.getElementById('modal-desa').textContent = 'Desa ' + d.nama;
        document.getElementById('modal-kec').textContent  = selectedKec;

        const cardWeb  = document.getElementById('card-website');
        const badgeWeb = document.getElementById('badge-web');
        if (d.website) {
            cardWeb.href = d.website;
            cardWeb.classList.remove('lc-disabled');
            badgeWeb.innerHTML = '<i class="fas fa-arrow-right me-1"></i>Kunjungi';
        } else {
            cardWeb.removeAttribute('href');
            cardWeb.classList.add('lc-disabled');
            badgeWeb.innerHTML = '<i class="fas fa-clock me-1"></i>Belum Tersedia';
        }

        const cardBd  = document.getElementById('card-bankdata');
        const badgeBd = document.getElementById('badge-bd');
        if (d.bank_data) {
            cardBd.href = d.bank_data;
            cardBd.classList.remove('lc-disabled');
            badgeBd.innerHTML = '<i class="fas fa-arrow-right me-1"></i>Akses Data';
        } else {
            cardBd.removeAttribute('href');
            cardBd.classList.add('lc-disabled');
            badgeBd.innerHTML = '<i class="fas fa-clock me-1"></i>Belum Tersedia';
        }

        document.getElementById('layOverlay').classList.add('show');
        document.body.style.overflow = 'hidden';
    }

    function tutupModal(e) {
        if (e && e.target !== document.getElementById('layOverlay')) return;
        document.getElementById('layOverlay').classList.remove('show');
        document.body.style.overflow = '';
    }

    function resetPortal() {
        selectedKec = null;
        document.getElementById('section-desa').classList.remove('show');
        document.querySelectorAll('.kec-card').forEach(c => c.classList.remove('active-kec'));
    }

    function escHtml(s) {
        return s.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
    }

    // Tutup modal dengan Escape
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') tutupModal();
    });
</script>
</body>
</html>
