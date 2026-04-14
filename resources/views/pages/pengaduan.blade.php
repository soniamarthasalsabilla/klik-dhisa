@extends('layouts.app')

@push('styles')
<style>
    .form-control, .form-select {
        border: 2px solid var(--color-2);
        border-radius: 10px;
        padding: 10px 14px;
        font-size: .88rem;
        transition: .2s;
    }
    .form-control:focus, .form-select:focus {
        border-color: var(--color-4);
        box-shadow: 0 0 0 3px rgba(58,154,140,.12);
    }
    .form-label { font-size: .85rem; font-weight: 600; color: var(--color-7); margin-bottom: 6px; }

    .form-card {
        background: white; border-radius: 16px;
        border: 1px solid var(--color-2);
        padding: 32px;
        box-shadow: 0 2px 14px rgba(0,0,0,.06);
    }

    .kontak-item {
        display: flex; gap: 14px; padding: 12px 0;
        border-bottom: 1px solid var(--color-2);
    }
    .kontak-item:last-child { border-bottom: none; padding-bottom: 0; }
    .kontak-icon {
        width: 38px; height: 38px; border-radius: 10px;
        background: var(--color-1);
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0; color: var(--color-5);
    }
    .kontak-label { font-size: .82rem; font-weight: 600; color: var(--color-7); margin-bottom: 2px; }
    .kontak-val { font-size: .78rem; color: #6c757d; }

    .ketentuan-item {
        display: flex; gap: 10px; padding: 6px 0; font-size: .82rem; color: #444;
    }
    .ketentuan-item i { color: var(--color-5); margin-top: 3px; flex-shrink: 0; }

    .submit-btn {
        background: var(--color-5); color: white; border: none;
        border-radius: 50px; padding: 12px 32px;
        font-weight: 700; font-size: .9rem; width: 100%;
        transition: .2s; cursor: pointer;
    }
    .submit-btn:hover { background: var(--color-7); color: white; }
</style>
@endpush

@section('content')

{{-- Hero --}}
<section class="py-3" style="background: white; border-bottom: 3px solid var(--color-5);">
    <div class="container text-center py-4">
        <h2 class="fw-bold mb-2" style="color: var(--color-7); font-size: 2rem;">
            <i class="fas fa-comment-dots me-2" style="color:var(--color-5);"></i>Pengaduan & Aspirasi
        </h2>
        <p class="mb-0" style="color: var(--color-6); font-size: 1rem;">Sampaikan pengaduan, saran, atau aspirasi Anda kepada pemerintah desa</p>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container">
        <div class="row g-4 justify-content-center">

            {{-- Form --}}
            <div class="col-lg-7">

                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-3 border-0 shadow-sm mb-4" style="background:#d1e7dd;color:#0a3622;">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                <div class="form-card">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div style="width:42px;height:42px;border-radius:11px;background:var(--color-1);display:flex;align-items:center;justify-content:center;">
                            <i class="fas fa-edit" style="color:var(--color-5);"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-0" style="color:var(--color-7);">Form Pengaduan</h5>
                            <small class="text-muted">Semua pengaduan akan ditindaklanjuti dalam 3 hari kerja</small>
                        </div>
                    </div>

                    <form action="{{ route('pengaduan.submit') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="nama"
                                   class="form-control @error('nama') is-invalid @enderror"
                                   value="{{ old('nama') }}"
                                   placeholder="Nama sesuai KTP"
                                   required>
                            @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Email <span class="text-muted fw-normal">(opsional)</span></label>
                                <input type="email" name="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       value="{{ old('email') }}"
                                       placeholder="contoh@email.com">
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">No. HP / WhatsApp <span class="text-muted fw-normal">(opsional)</span></label>
                                <input type="text" name="no_hp" class="form-control"
                                       value="{{ old('no_hp') }}" placeholder="08xx-xxxx-xxxx">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kategori Pengaduan <span class="text-danger">*</span></label>
                            <select name="kategori" class="form-select @error('kategori') is-invalid @enderror" required>
                                <option value="" disabled {{ !old('kategori') ? 'selected' : '' }}>-- Pilih Kategori --</option>
                                @foreach(['Infrastruktur','Pelayanan Publik','Sosial','Kesehatan','Pendidikan','Ekonomi','Lingkungan','Keamanan','Lainnya'] as $kat)
                                <option value="{{ $kat }}" {{ old('kategori')==$kat ? 'selected' : '' }}>{{ $kat }}</option>
                                @endforeach
                            </select>
                            @error('kategori')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Judul Pengaduan <span class="text-danger">*</span></label>
                            <input type="text" name="judul"
                                   class="form-control @error('judul') is-invalid @enderror"
                                   value="{{ old('judul') }}"
                                   placeholder="Ringkasan singkat pengaduan"
                                   required>
                            @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Isi Pengaduan / Aspirasi <span class="text-danger">*</span></label>
                            <textarea name="isi"
                                      class="form-control @error('isi') is-invalid @enderror"
                                      rows="6"
                                      placeholder="Jelaskan pengaduan atau aspirasi Anda secara lengkap dan jelas..."
                                      required>{{ old('isi') }}</textarea>
                            @error('isi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <button type="submit" class="submit-btn">
                            <i class="fas fa-paper-plane me-2"></i>Kirim Pengaduan
                        </button>
                    </form>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="col-lg-4">

                {{-- Kontak --}}
                <div class="card border-0 rounded-4 p-4 mb-3" style="background:white;border:1px solid var(--color-2) !important;box-shadow:0 2px 14px rgba(0,0,0,.06);">
                    <h6 class="fw-bold mb-3" style="color:var(--color-7);">
                        <i class="fas fa-phone-alt me-2" style="color:var(--color-5);"></i>Kontak Langsung
                    </h6>
                    <div class="kontak-item">
                        <div class="kontak-icon"><i class="fas fa-phone-alt"></i></div>
                        <div>
                            <div class="kontak-label">Telepon Kantor Desa</div>
                            <div class="kontak-val">(031) 3014567</div>
                            <div class="kontak-val">Jam kerja: 08.00 – 15.00</div>
                        </div>
                    </div>
                    <div class="kontak-item">
                        <div class="kontak-icon"><i class="fab fa-whatsapp"></i></div>
                        <div>
                            <div class="kontak-label">WhatsApp Desa</div>
                            <div class="kontak-val">0812-3456-7890</div>
                        </div>
                    </div>
                    <div class="kontak-item">
                        <div class="kontak-icon"><i class="fas fa-map-marker-alt"></i></div>
                        <div>
                            <div class="kontak-label">Kantor Desa</div>
                            <div class="kontak-val">Jl. Raya Tajungan, Kec. Kamal, Bangkalan</div>
                        </div>
                    </div>
                    <div class="kontak-item">
                        <div class="kontak-icon"><i class="fas fa-clock"></i></div>
                        <div>
                            <div class="kontak-label">Jam Pelayanan</div>
                            <div class="kontak-val">Senin – Jumat: 08.00 – 15.00 WIB</div>
                        </div>
                    </div>
                </div>

                {{-- Ketentuan --}}
                <div class="card border-0 rounded-4 p-4" style="background:var(--color-1);border:1px solid var(--color-2) !important;">
                    <h6 class="fw-bold mb-3" style="color:var(--color-7);">
                        <i class="fas fa-shield-alt me-2" style="color:var(--color-5);"></i>Ketentuan Pengaduan
                    </h6>
                    <div class="ketentuan-item">
                        <i class="fas fa-check-circle"></i>
                        <span>Sampaikan pengaduan dengan sopan dan jelas</span>
                    </div>
                    <div class="ketentuan-item">
                        <i class="fas fa-check-circle"></i>
                        <span>Sertakan kontak agar kami dapat menindaklanjuti</span>
                    </div>
                    <div class="ketentuan-item">
                        <i class="fas fa-check-circle"></i>
                        <span>Respons diberikan dalam 3 hari kerja</span>
                    </div>
                    <div class="ketentuan-item">
                        <i class="fas fa-check-circle"></i>
                        <span>Pengaduan tidak boleh mengandung SARA atau fitnah</span>
                    </div>
                    <div class="ketentuan-item">
                        <i class="fas fa-check-circle"></i>
                        <span>Identitas pelapor dijaga kerahasiaannya</span>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection
