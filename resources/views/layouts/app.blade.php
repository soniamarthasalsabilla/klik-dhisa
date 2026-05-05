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
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
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

        /* Navbar scroll effect */
        .navbar { transition: padding .3s, box-shadow .3s, background .3s; }
        .navbar-scrolled { box-shadow: 0 4px 20px rgba(0,0,0,.18) !important; padding-top: 6px !important; padding-bottom: 6px !important; }

        /* Scroll to top button */
        #btn-to-top {
            position: fixed; bottom: 28px; right: 28px; z-index: 9999;
            width: 44px; height: 44px; border-radius: 50%;
            background: var(--color-5); color: white; border: none;
            box-shadow: 0 4px 16px rgba(0,0,0,.2);
            display: flex; align-items: center; justify-content: center;
            font-size: 1rem; cursor: pointer;
            opacity: 0; transform: translateY(16px);
            transition: opacity .3s, transform .3s;
            pointer-events: none;
        }
        #btn-to-top.show { opacity: 1; transform: translateY(0); pointer-events: auto; }
        #btn-to-top:hover { background: var(--color-7); }
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

    <button id="btn-to-top" aria-label="Kembali ke atas">
        <i class="fas fa-chevron-up"></i>
    </button>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 700, easing: 'ease-out-cubic', once: true, offset: 60 });

        // Navbar shrink on scroll
        const navbar = document.querySelector('.navbar');
        if (navbar) {
            window.addEventListener('scroll', () => {
                navbar.classList.toggle('navbar-scrolled', window.scrollY > 50);
            }, { passive: true });
        }

        // Scroll-to-top button
        const btnTop = document.getElementById('btn-to-top');
        if (btnTop) {
            window.addEventListener('scroll', () => {
                btnTop.classList.toggle('show', window.scrollY > 400);
            }, { passive: true });
            btnTop.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));
        }

        // Counter animation
        function animateCounter(el) {
            const target = parseFloat(el.dataset.target);
            const isDecimal = el.dataset.target.includes('.');
            const duration = 1500;
            const step = target / (duration / 16);
            let current = 0;
            const timer = setInterval(() => {
                current += step;
                if (current >= target) { current = target; clearInterval(timer); }
                el.textContent = isDecimal
                    ? current.toFixed(target % 1 === 0 ? 0 : 1).toLocaleString('id-ID')
                    : Math.floor(current).toLocaleString('id-ID');
            }, 16);
        }
        const counterObserver = new IntersectionObserver(entries => {
            entries.forEach(e => { if (e.isIntersecting && !e.target.dataset.done) {
                e.target.dataset.done = '1'; animateCounter(e.target);
            }});
        }, { threshold: 0.5 });
        document.querySelectorAll('[data-counter]').forEach(el => counterObserver.observe(el));
    </script>
    @stack('scripts')
</body>
</html>