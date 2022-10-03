@if ($paginator->hasPages())
<nav aria-label="...">
    <ul class="pagination">
        {{-- Previous Page --}}
        @if ($paginator->onFirstPage())
      <li class="page-item disabled">
        <span class="page-link">Previous</span>
      </li>
        @else
        <li class="page-item ">
            <a href="{{ $paginator->url($paginator->currentPage()-1) }}" class="page-link" >Previous</a>
          </li>
        @endif
      <li class="page-item"><a class="page-link" href="#">1</a></li>
      <li class="page-item active" aria-current="page">
        <span class="page-link">2</span>
      </li>
      <li class="page-item"><a class="page-link" href="#">3</a></li>
      <li class="page-item">
        <a class="page-link" href="#">Next</a>
      </li>
    </ul>
  </nav>
@endif