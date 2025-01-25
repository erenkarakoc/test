@php
  $currentPage = $paginator->currentPage();
  $lastPage = $paginator->lastPage();
  $startPage = max(1, $currentPage - 2);
  $endPage = min($lastPage, $currentPage + 2);
@endphp

@if ($paginator->hasPages())
  <div class="d-flex justify-content-center w-100 mt-6">
    <nav>
      <ul class="pagination pagination-rounded pagination-sm mb-0">
        @if ($startPage > 1)
          <li class="page-item first">
            <a class="page-link" href="{{ $paginator->url(1) }}&tab={{ $tab }}">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24">
                <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                  stroke-width="1.5">
                  <path d="m13 19l-6-7l6-7" />
                  <path d="m17 19l-6-7l6-7" />
                </g>
              </svg>
            </a>
          </li>
        @else
          <li class="page-item first">
            <a class="page-link page-link-disabled">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24">
                <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                  stroke-width="1.5">
                  <path d="m13 19l-6-7l6-7" />
                  <path d="m17 19l-6-7l6-7" />
                </g>
              </svg>
            </a>
          </li>
        @endif

        <li class="page-item prev">
          @if ($paginator->onFirstPage())
            <a class="page-link text-light page-link-disabled">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24">
                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                  stroke-width="1.5" d="m15 5l-6 7l6 7" />
              </svg>
            </a>
          @else
            <a class="page-link" href="{{ $paginator->previousPageUrl() }}&tab={{ $tab }}">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24">
                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                  stroke-width="1.5" d="m15 5l-6 7l6 7" />
              </svg>
            </a>
          @endif
        </li>

        @if ($startPage > 2)
          <li class="page-item">
            <a class="page-link page-link-more">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24">
                <path fill="currentColor"
                  d="M7 12a2 2 0 1 1-4 0a2 2 0 0 1 4 0m7 0a2 2 0 1 1-4 0a2 2 0 0 1 4 0m7 0a2 2 0 1 1-4 0a2 2 0 0 1 4 0" />
              </svg>
            </a>
          </li>
        @endif

        @for ($page = $startPage; $page <= $endPage; $page++)
          <li class="page-item">
            @if ($page == $paginator->currentPage())
              <a class="page-link active">{{ $page }}</a>
            @else
              <a class="page-link" href="{{ $paginator->url($page) }}&tab={{ $tab }}">{{ $page }}</a>
            @endif
          </li>
        @endfor

        @if ($endPage < $lastPage - 1)
          <li class="page-item">
            <a class="page-link page-link-more">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24">
                <path fill="currentColor"
                  d="M7 12a2 2 0 1 1-4 0a2 2 0 0 1 4 0m7 0a2 2 0 1 1-4 0a2 2 0 0 1 4 0m7 0a2 2 0 1 1-4 0a2 2 0 0 1 4 0" />
              </svg>
            </a>
          </li>
        @endif

        <li class="page-item next">
          @if ($paginator->hasMorePages())
            <a class="page-link" href="{{ $paginator->nextPageUrl() }}&tab={{ $tab }}">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24">
                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                  stroke-width="1.5" d="m9 5l6 7l-6 7" />
              </svg>
            </a>
          @else
            <a class="page-link text-light page-link-disabled">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24">
                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                  stroke-width="1.5" d="m9 5l6 7l-6 7" />
              </svg>
            </a>
          @endif
        </li>

        @if ($endPage < $lastPage)
          <li class="page-item">
            <a class="page-link" href="{{ $paginator->url($lastPage) }}&tab={{ $tab }}">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24">
                <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                  stroke-width="1.5">
                  <path d="m11 19l6-7l-6-7" />
                  <path d="m7 19l6-7l-6-7" />
                </g>
              </svg>
            </a>
          </li>
        @else
          <li class="page-item">
            <a class="page-link page-link-disabled">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24">
                <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                  stroke-width="1.5">
                  <path d="m11 19l6-7l-6-7" />
                  <path d="m7 19l6-7l-6-7" />
                </g>
              </svg>
            </a>
          </li>
        @endif
      </ul>
    </nav>
  </div>
@endif
