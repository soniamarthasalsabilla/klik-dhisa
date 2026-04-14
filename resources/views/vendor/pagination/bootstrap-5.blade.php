@if ($paginator->hasPages())
<nav aria-label="Navigasi Halaman" class="mt-3">
    <div class="d-flex flex-column flex-sm-row align-items-center justify-content-between gap-2">

        {{-- Info Jumlah --}}
        <p class="text-muted small mb-0">
            Menampilkan
            <strong style="color:var(--color-6);">{{ $paginator->firstItem() }}</strong>–<strong style="color:var(--color-6);">{{ $paginator->lastItem() }}</strong>
            dari
            <strong style="color:var(--color-6);">{{ $paginator->total() }}</strong> data
        </p>

        {{-- Tombol Halaman --}}
        <ul class="pagination pagination-sm mb-0" style="gap:4px;">

            {{-- Prev --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link rounded-pill px-3" style="color:#adb5bd;border:1px solid #dee2e6;">
                        <i class="fas fa-chevron-left" style="font-size:.7rem;"></i>
                    </span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link rounded-pill px-3" href="{{ $paginator->previousPageUrl() }}" rel="prev"
                       style="border:1px solid var(--color-3);color:var(--color-6);">
                        <i class="fas fa-chevron-left" style="font-size:.7rem;"></i>
                    </a>
                </li>
            @endif

            {{-- Nomor Halaman --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="page-item disabled">
                        <span class="page-link rounded-pill px-3" style="border:none;color:#adb5bd;">{{ $element }}</span>
                    </li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active">
                                <span class="page-link rounded-pill px-3 fw-bold"
                                      style="background:var(--color-6);border-color:var(--color-6);color:white;">
                                    {{ $page }}
                                </span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link rounded-pill px-3" href="{{ $url }}"
                                   style="border:1px solid var(--color-2);color:var(--color-6);">
                                    {{ $page }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link rounded-pill px-3" href="{{ $paginator->nextPageUrl() }}" rel="next"
                       style="border:1px solid var(--color-3);color:var(--color-6);">
                        <i class="fas fa-chevron-right" style="font-size:.7rem;"></i>
                    </a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link rounded-pill px-3" style="color:#adb5bd;border:1px solid #dee2e6;">
                        <i class="fas fa-chevron-right" style="font-size:.7rem;"></i>
                    </span>
                </li>
            @endif

        </ul>
    </div>
</nav>
@endif
