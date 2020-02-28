@if ($paginator->hasPages())
      <div class="page">
        {{-- Previous Page Link --}}
        @if (! $paginator->onFirstPage())
          <a class="prev" href="{{ $paginator->previousPageUrl() }}">&lt;&lt;</a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="current">{{$page}}</span>
                    @else
                        <a class="num" href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach


        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
          <a class="next" href="{{ $paginator->nextPageUrl() }}">&gt;&gt;</a>
        @endif
      </div>
@endif