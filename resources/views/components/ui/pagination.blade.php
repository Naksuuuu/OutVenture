@if ($paginator->hasPages())
  <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between">
    <div class="flex justify-between flex-1 sm:hidden">
      @if ($paginator->onFirstPage())
        <span
          class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md">
          {!! __('pagination.previous') !!}
        </span>
      @else
        <a href="{{ $paginator->previousPageUrl() }}"
          class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
          {!! __('pagination.previous') !!}
        </a>
      @endif

      @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}"
          class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
          {!! __('pagination.next') !!}
        </a>
      @else
        <span
          class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md">
          {!! __('pagination.next') !!}
        </span>
      @endif
    </div>

    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
      <div>
        <p class="text-sm text-gray-500 leading-5">
          Menampilkan
          <span class="font-bold text-gray-700">{{ $paginator->firstItem() }}</span>
          sampai
          <span class="font-bold text-gray-700">{{ $paginator->lastItem() }}</span>
          dari
          <span class="font-bold text-gray-700">{{ $paginator->total() }}</span>
          data
        </p>
      </div>

      <div>
        <span class="relative z-0 inline-flex rounded-xl shadow-sm border border-slate-200 bg-white overflow-hidden">
          {{-- Previous Page Link --}}
          @if ($paginator->onFirstPage())
            <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
              <span
                class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-gray-300 bg-slate-50 border-r border-slate-100 cursor-default leading-5"
                aria-hidden="true">
                <x-lucide-chevron-left class="w-4 h-4" />
              </span>
            </span>
          @else
            <button wire:click="previousPage" wire:loading.attr="disabled" rel="prev"
              class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-slate-500 bg-white border-r border-slate-100 leading-5 hover:bg-slate-50 hover:text-slate-700 focus:z-10 focus:outline-none focus:ring ring-indigo-300 active:bg-slate-100 transition ease-in-out duration-150"
              aria-label="{{ __('pagination.previous') }}">
              <x-lucide-chevron-left class="w-4 h-4" />
            </button>
          @endif

          {{-- Pagination Elements --}}
          @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
              <span aria-disabled="true">
                <span
                  class="relative inline-flex items-center px-4 py-2 text-sm font-bold text-gray-400 bg-white border-r border-slate-100 cursor-default leading-5">{{ $element }}</span>
              </span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
              @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                  <span aria-current="page">
                    <span
                      class="relative inline-flex items-center px-4 py-2 text-sm font-bold text-white bg-gray-400 border-r border-gray-500 cursor-default leading-5">{{ $page }}</span>
                  </span>
                @else
                  <button wire:click="gotoPage({{ $page }})"
                    class="relative inline-flex items-center px-4 py-2 text-sm font-bold text-slate-600 bg-white border-r border-slate-100 leading-5 hover:bg-slate-50 focus:z-10 focus:outline-none focus:ring ring-indigo-300 active:bg-slate-100 transition ease-in-out duration-150"
                    aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                    {{ $page }}
                  </button>
                @endif
              @endforeach
            @endif
          @endforeach

          {{-- Next Page Link --}}
          @if ($paginator->hasMorePages())
            <button wire:click="nextPage" wire:loading.attr="disabled" rel="next"
              class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-slate-500 bg-white leading-5 hover:bg-slate-50 hover:text-slate-700 focus:z-10 focus:outline-none focus:ring ring-indigo-300 active:bg-slate-100 transition ease-in-out duration-150"
              aria-label="{{ __('pagination.next') }}">
              <x-lucide-chevron-right class="w-4 h-4" />
            </button>
          @else
            <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
              <span
                class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-gray-300 bg-slate-50 cursor-default leading-5"
                aria-hidden="true">
                <x-lucide-chevron-right class="w-4 h-4" />
              </span>
            </span>
          @endif
        </span>
      </div>
    </div>
  </nav>
@endif