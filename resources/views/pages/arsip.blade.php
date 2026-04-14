@extends('layouts.app')

@section('content')
<section class="py-3" style="background: white; border-bottom: 3px solid var(--color-5);">
    <div class="container text-center py-4">
        <h2 class="fw-bold mb-2" style="color: var(--color-7); font-size: 2rem;">Arsip Artikel & Berita</h2>
        <p class="mb-0" style="color: var(--color-6); font-size: 1rem;">Kumpulan informasi, kegiatan, dan kabar terbaru dari Desa Tajungan</p>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container">
        
        <div class="row mb-5 align-items-center">
            <div class="col-md-8 mb-3 mb-md-0">
                <div class="d-flex gap-2 flex-wrap" id="filter-buttons">
                    <button class="btn btn-navy text-white px-4 rounded-pill filter-btn active" data-filter="all" style="background: var(--navy);">Semua</button>
                    <button class="btn btn-outline-secondary px-4 rounded-pill filter-btn" data-filter="Kegiatan">Kegiatan</button>
                    <button class="btn btn-outline-secondary px-4 rounded-pill filter-btn" data-filter="Pembangunan">Pembangunan</button>
                    <button class="btn btn-outline-secondary px-4 rounded-pill filter-btn" data-filter="Ekonomi">Ekonomi</button>
                    <button class="btn btn-outline-secondary px-4 rounded-pill filter-btn" data-filter="Kesehatan">Kesehatan</button>
                </div>
            </div>
            <div class="col-md-4">
                <div class="input-group shadow-sm border rounded-pill overflow-hidden bg-white">
                    <span class="input-group-text bg-white border-0 ps-3">
                        <i class="fas fa-search text-muted"></i>
                    </span>
                    <input type="text" id="search-article" class="form-control border-0 shadow-none" placeholder="Cari judul artikel...">
                </div>
            </div>
        </div>

        {{-- Container Artikel --}}
        <div class="row g-4" id="article-container">
            @forelse($items as $item)
            <div class="col-md-4 article-item" data-category="{{ $item->category ?? 'Umum' }}">
                <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden news-card-archive">
                    <div class="position-relative">
                        <img src="{{ $item->image ?: 'https://images.unsplash.com/photo-1540910419892-4a36d2c3266c?auto=format&fit=crop&w=600&q=80' }}" class="card-img-top" alt="{{ $item->title }}" style="height: 220px; object-fit: cover;">
                        <span class="position-absolute top-0 end-0 m-3 badge bg-primary px-3 py-2 rounded-pill category-label">{{ $item->category ?? 'Umum' }}</span>
                    </div>
                    <div class="card-body p-4 text-start">
                        <div class="d-flex align-items-center mb-2 text-muted small">
                            <i class="far fa-calendar-alt me-2"></i> {{ $item->year ?? '-' }}
                        </div>
                        <h5 class="fw-bold mb-3 lh-base article-title">
                            <a href="{{ $item->link ?: '#' }}" class="text-decoration-none text-dark hover-gold" target="_blank">{{ $item->title }}</a>
                        </h5>
                        <p class="text-muted small mb-4">{{ $item->excerpt ?: 'Tidak ada ringkasan tersedia.' }}</p>
                        <a href="{{ $item->link ?: '#' }}" class="btn btn-link text-primary fw-bold p-0 text-decoration-none" target="_blank">Baca Selengkapnya <i class="fas fa-arrow-right ms-1"></i></a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <i class="fas fa-info-circle fa-3x text-muted mb-3"></i>
                <p class="text-muted">Belum ada arsip artikel yang tersedia.</p>
            </div>
            @endforelse
        </div>

        {{-- Pesan Jika Data Tidak Ditemukan --}}
        <div id="no-results" class="text-center py-5 d-none">
            <i class="fas fa-search fa-3x text-muted mb-3"></i>
            <p class="text-muted">Maaf, artikel yang Anda cari tidak ditemukan.</p>
        </div>

        <nav class="mt-5" id="pagination-nav">
            <ul class="pagination justify-content-center">
                <li class="page-item disabled"><a class="page-link shadow-sm rounded-circle me-2" href="#"><i class="fas fa-chevron-left"></i></a></li>
                <li class="page-item active"><a class="page-link shadow-sm rounded-circle me-2" href="#" style="background: var(--navy); border-color: var(--navy);">1</a></li>
                <li class="page-item"><a class="page-link shadow-sm rounded-circle me-2" href="#">2</a></li>
                <li class="page-item"><a class="page-link shadow-sm rounded-circle" href="#"><i class="fas fa-chevron-right"></i></a></li>
            </ul>
        </nav>

    </div>
</section>

<style>
    .news-card-archive { transition: transform 0.3s ease, box-shadow 0.3s ease; }
    .news-card-archive:hover { transform: translateY(-10px); box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important; }
    .hover-gold:hover { color: var(--gold) !important; }
    .pagination .page-link { width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; color: var(--navy); border: none; }
    .filter-btn.active { background: var(--navy) !important; color: white !important; border-color: var(--navy) !important; }
</style>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('search-article');
        const articleItems = document.querySelectorAll('.article-item');
        const filterButtons = document.querySelectorAll('.filter-btn');
        const noResults = document.getElementById('no-results');

        function filterArticles() {
            const searchTerm = searchInput.value.toLowerCase();
            const activeFilter = document.querySelector('.filter-btn.active').getAttribute('data-filter');
            let visibleCount = 0;

            articleItems.forEach(item => {
                const title = item.querySelector('.article-title').innerText.toLowerCase();
                const category = item.getAttribute('data-category');
                
                const matchesSearch = title.includes(searchTerm);
                const matchesFilter = (activeFilter === 'all' || category === activeFilter);

                if (matchesSearch && matchesFilter) {
                    item.classList.remove('d-none');
                    visibleCount++;
                } else {
                    item.classList.add('d-none');
                }
            });

            // Tampilkan pesan jika tidak ada hasil
            if (visibleCount === 0) {
                noResults.classList.remove('d-none');
                document.getElementById('pagination-nav').classList.add('d-none');
            } else {
                noResults.classList.add('d-none');
                document.getElementById('pagination-nav').classList.remove('d-none');
            }
        }

        // Event listener untuk Search
        searchInput.addEventListener('input', filterArticles);

        // Event listener untuk Tombol Kategori
        filterButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                filterButtons.forEach(b => {
                    b.classList.remove('active', 'btn-navy', 'text-white');
                    b.classList.add('btn-outline-secondary');
                    b.style.background = '';
                });
                
                this.classList.add('active', 'btn-navy', 'text-white');
                this.classList.remove('btn-outline-secondary');
                this.style.background = 'var(--navy)';
                
                filterArticles();
            });
        });
    });
</script>
@endpush
@endsection