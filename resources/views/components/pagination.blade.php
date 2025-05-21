@props(['paginator', 'entityName'])

<div class="flex flex-col sm:flex-row items-center justify-between">
    <!-- Informasi Halaman -->
    <div class="text-sm text-gray-700 dark:text-gray-400 mb-4 sm:mb-0">
        Showing <span class="font-semibold text-gray-900 dark:text-white">{{ $paginator->firstItem() ?? 0 }}</span> to 
        <span class="font-semibold text-gray-900 dark:text-white">{{ $paginator->lastItem() ?? 0 }}</span> of 
        <span class="font-semibold text-gray-900 dark:text-white">{{ $paginator->total() }}</span> {{ $entityName }}
    </div>
    
    <!-- Navigation dan Indikator Halaman -->
    <div class="inline-flex">
        <!-- Tombol Previous -->
        @if ($paginator->onFirstPage())
            <button disabled class="flex items-center justify-center px-3 h-8 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-l-lg cursor-not-allowed dark:bg-gray-700 dark:border-gray-700 dark:text-gray-400">
                Prev
            </button>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="flex items-center justify-center px-3 h-8 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white">
                Prev
            </a>
        @endif
        
        <!-- Indikator Halaman - Numerik -->
        @if($paginator->currentPage() > 3)
            <a href="{{ $paginator->url(1) }}" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">1</a>
            @if($paginator->currentPage() > 4)
                <span class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400">...</span>
            @endif
        @endif
        
        @foreach(range(max(1, $paginator->currentPage() - 2), min($paginator->lastPage(), $paginator->currentPage() + 2)) as $page)
            <a href="{{ $paginator->url($page) }}" 
               class="flex items-center justify-center px-3 h-8 leading-tight {{ $paginator->currentPage() == $page ? 'text-blue-600 border border-blue-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white' : 'text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white' }}">
                {{ $page }}
            </a>
        @endforeach
        
        @if($paginator->currentPage() < $paginator->lastPage() - 2)
            @if($paginator->currentPage() < $paginator->lastPage() - 3)
                <span class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400">...</span>
            @endif
            <a href="{{ $paginator->url($paginator->lastPage()) }}" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">{{ $paginator->lastPage() }}</a>
        @endif
        
        <!-- Tombol Next -->
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="flex items-center justify-center px-3 h-8 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white">
                Next
            </a>
        @else
            <button disabled class="flex items-center justify-center px-3 h-8 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-r-lg cursor-not-allowed dark:bg-gray-700 dark:border-gray-700 dark:text-gray-400">
                Next
            </button>
        @endif
    </div>
</div>