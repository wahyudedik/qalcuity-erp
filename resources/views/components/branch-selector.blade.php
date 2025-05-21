@php
    $userBranches = auth()->user()->branches;
    $currentBranch = session('current_branch_id') ? auth()->user()->branches->find(session('current_branch_id')) : 
        (count($userBranches) > 0 ? $userBranches->first() : null);
@endphp

<div class="relative">
    <button id="branch-menu-button" data-dropdown-toggle="branch-dropdown" class="flex items-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" type="button">
        <span class="mr-2">{{ $currentBranch ? $currentBranch->name : 'Pilih Cabang' }}</span>
        <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
    </button>
    
    <div id="branch-dropdown" class="hidden z-10 w-56 p-3 bg-white rounded-lg shadow dark:bg-gray-700">
        <h6 class="mb-3 text-sm font-medium text-gray-900 dark:text-white">
            Pilih Cabang
        </h6>
        <ul class="space-y-2 text-sm max-h-48 overflow-y-auto" aria-labelledby="branch-menu-button">
            @foreach($userBranches as $branch)
                <li>
                    <a href="{{ route('branches.switch', $branch->id) }}" 
                       class="flex items-center p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 
                       {{ $currentBranch && $currentBranch->id == $branch->id ? 'bg-gray-100 dark:bg-gray-600' : '' }}">
                        <span class="w-6 h-6 rounded-full flex items-center justify-center bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300">
                            {{ substr($branch->name, 0, 1) }}
                        </span>
                        <span class="ml-2 text-sm font-medium text-gray-900 dark:text-white">{{ $branch->name }}</span>
                        @if($currentBranch && $currentBranch->id == $branch->id)
                            <svg class="w-3 h-3 ml-auto text-blue-600 dark:text-blue-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5"/>
                            </svg>
                        @endif
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>