<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Resmi Desa Tajungan - Bangkalan</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --navy: #002b5b;
            --gold: #f9d923;
            --teal: #2b7a78;
            --white-glass: rgba(255, 255, 255, 0.15);
        }
        
        body { 
            font-family: 'Poppins', sans-serif; 
            background-color: #f4f7f6; 
            scroll-behavior: smooth; 
            overflow-x: hidden; 
        }
        
        .navbar { 
            background: var(--navy) !important; 
            padding: 15px 0; 
            transition: 0.3s; 
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        
        @media (min-width: 992px) {
            .navbar .nav-item.dropdown:hover .dropdown-menu {
                display: block;
                margin-top: 0;
                opacity: 1;
                visibility: visible;
                transform: translateY(0);
            }
            .dropdown-menu {
                display: block;
                opacity: 0;
                visibility: hidden;
                transition: all 0.3s ease;
                transform: translateY(10px);
                border: none;
                border-radius: 12px;
                box-shadow: 0 10px 25px rgba(0,0,0,0.2);
                padding: 10px;
                background: rgba(0, 43, 91, 0.9);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.1);
            }
        }

        .dropdown-item {
            padding: 10px 15px;
            border-radius: 8px;
            font-size: 0.9rem;
            transition: 0.2s;
            color: rgba(255, 255, 255, 0.9) !important;
        }
        .dropdown-item:hover {
            background: rgba(255, 255, 255, 0.1);
            color: var(--gold) !important;
        }
        .dropdown-item i { width: 25px; color: var(--gold); }

        .btn-admin-custom {
            background: var(--white-glass);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white !important;
            border-radius: 50px;
            font-weight: 600;
            backdrop-filter: blur(5px);
            transition: 0.3s;
        }
        .btn-admin-custom:hover { 
            background: white; 
            color: var(--navy) !important; 
            transform: scale(1.05); 
        }

        main { min-height: 80vh; }
        footer { background: var(--navy); color: white; padding: 70px 0 30px; }
        
        .floating-logo {
            animation: float 4s ease-in-out infinite;
            filter: drop-shadow(0 10px 15px rgba(0,0,0,0.1));
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
        }

        section { position: relative; }
    </style>
</head>
<body>

    @include('partials.navbar')

    <main id="main-content">
        @yield('content')
    </main>

    @include('partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    @stack('scripts')

</body>
</html>