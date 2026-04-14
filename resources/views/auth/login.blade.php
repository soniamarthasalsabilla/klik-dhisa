@extends('layouts.app')

@section('content')
<section class="login-hero d-flex align-items-center justify-content-center">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-5">
                <div class="login-card p-4 rounded-4 shadow-lg">
                    <div class="text-center mb-4">
                        <h3 class="fw-bold mb-1">Login Admin</h3>
                        <p class="text-muted mb-0">Masuk untuk mengelola data UMKM dan konten desa.</p>
                    </div>

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Terjadi kesalahan:</strong>
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control form-control-lg" id="email" name="email" value="{{ old('email') }}" required autofocus>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control form-control-lg" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-desa-navy btn-lg w-100">Masuk Sekarang</button>
                    </form>

                    <div class="text-center mt-4 text-muted small">
                        Pastikan menggunakan akun admin yang telah terdaftar.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .login-hero {
        min-height: calc(100vh - 80px);
        background: linear-gradient(rgba(8, 52, 73, 0.65), rgba(8, 52, 73, 0.35)), url('https://images.unsplash.com/photo-1500382017468-9049fed747ef?auto=format&fit=crop&w=1600&q=80') center/cover no-repeat;
        position: relative;
        color: white;
    }

    .login-card {
        background: rgba(255, 255, 255, 0.72);
        backdrop-filter: blur(22px);
        border: 1px solid rgba(255, 255, 255, 0.55);
        box-shadow: 0 25px 60px rgba(0, 0, 0, 0.16);
        color: #1f3d5a;
    }

    .login-card .form-control {
        border-radius: 14px;
        border: 1px solid rgba(34, 57, 84, 0.15);
    }

    .login-card .btn-desa-navy {
        background-color: var(--color-6);
        border-color: transparent;
        color: #fff;
    }

    .login-card .btn-desa-navy:hover {
        background-color: var(--color-7);
    }

    .login-card h3 {
        color: #10233f;
    }

    .login-card p {
        color: #4b6078;
    }

    .login-card .alert {
        background-color: rgba(254, 241, 242, 0.95);
        color: #842029;
        border-color: rgba(248, 215, 218, 0.95);
    }

    @media (max-width: 768px) {
        .login-hero {
            min-height: auto;
            padding: 4rem 0;
        }
    }
</style>
@endsection