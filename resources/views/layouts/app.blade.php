<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Resmi Dhisâ - Bangkalan</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,700&family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    @stack('styles')

    <style>
        /* Menggunakan Palet Warna Teal/Navy yang dipudarkan */
        :root { 
            --color-1: #E8F5F0; /* Teal Sangat Muda - Dipudarkan */
            --color-2: #B8E6D9; /* Teal Muda - Dipudarkan */
            --color-3: #8FD4C2; /* Teal - Dipudarkan */
            --color-4: #5BBFAB; /* Teal Tua - Dipudarkan */
            --color-5: #3A9A8C; /* Navy Teal - Dipudarkan */
            --color-6: #2C7A6F; /* Navy Muda - Dipudarkan */
            --color-7: #1E5A52; /* Navy Tua - Dipudarkan */
            --gold: #f9d923; 
        }
        
        body { font-family: 'Poppins', sans-serif; background-color: #fff; color: var(--color-7); overflow-x: hidden; scroll-behavior: smooth; }
        
        .serif-title { font-family: 'Playfair Display', serif; }

        /* Global Wave Separator */
        .wave-container { line-height: 0; width: 100%; overflow: hidden; }
        .wave-container svg { position: relative; display: block; width: calc(100% + 1.3px); height: 70px; }
        
        /* Tombol Custom Teal/Gold */
        .btn-desa-warning { background-color: var(--gold); color: var(--color-7); border-radius: 50px; border: none; transition: 0.3s; font-weight: 600; }
        .btn-desa-warning:hover { background-color: #fff; color: var(--color-7); transform: translateY(-3px); box-shadow: 0 5px 15px rgba(0,0,0,0.1); }

        .btn-desa-navy { background-color: var(--color-6); color: white; border-radius: 50px; border: none; transition: 0.3s; font-weight: 600; padding: 10px 25px;}
        .btn-desa-navy:hover { background-color: var(--color-7); color: white; transform: translateY(-3px); }
        
        /* Card Wisata & Berita Hover Efek */
        .card-hover:hover { transform: translateY(-10px); box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important; transition: 0.3s ease; }
        
        section { position: relative; z-index: 1; }
        .section-padding { padding: 100px 0; }
    </style>
</head>
<body>

    @include('partials.navbar')

    <main>
        @yield('content')
    </main>

    @unless(View::hasSection('no-footer'))
        @include('partials.footer')
    @endunless

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    @stack('scripts')
</body>
</html>