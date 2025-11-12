@if ($paginator->hasPages())
    <nav>
        <ul class="pagination pagination-sm justify-content-center my-2">
            {{-- Link da Página Anterior --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link bg-transparent border-secondary text-secondary">&lsaquo;</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link bg-transparent border-secondary text-primary"
                        href="{{ $paginator->previousPageUrl() }}" rel="prev">&lsaquo;</a>
                </li>
            @endif

            {{-- Elementos de Paginação --}}
            @foreach ($elements as $element)
                {{-- "..." --}}
                @if (is_string($element))
                    <li class="page-item disabled">
                        <span class="page-link bg-transparent border-secondary text-secondary">{{ $element }}</span>
                    </li>
                @endif

                {{-- Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active">
                                <span class="page-link bg-primary border-primary text-white">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link bg-transparent border-secondary text-primary"
                                    href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Link da Próxima Página --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link bg-transparent border-secondary text-primary"
                        href="{{ $paginator->nextPageUrl() }}" rel="next">&rsaquo;</a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link bg-transparent border-secondary text-secondary">&rsaquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
