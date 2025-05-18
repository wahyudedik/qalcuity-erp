<aside id="sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
    aria-label="Sidebar">
    <div class="h-full flex flex-col px-3 py-4 overflow-y-auto bg-gray-800 dark:bg-gray-900">
        <div class="flex items-center justify-between ps-2.5 mb-5">
            <a href="{{ route('dashboard') }}" class="flex items-center">
                <img src="{{ asset('img/favicon.png') }}" class="h-9 me-3" alt="Logo" />
                <span
                    class="self-center text-xl font-semibold whitespace-nowrap text-white">{{ config('app.name', 'Laravel') }}</span>
            </a>
            <button type="button" data-drawer-target="sidebar" data-drawer-toggle="sidebar" aria-controls="sidebar"
                class="sm:hidden text-gray-400 hover:text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg> 
            </button> 
        </div>

        <!-- Search within sidebar -->
        <div class="relative mb-4">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
            </div>
            <input type="search" id="sidebar-search"
                class="block w-full p-2 ps-10 text-sm border rounded-lg bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                placeholder="Search...">
        </div>

        <!-- Main navigation -->
        <ul class="space-y-2 font-medium flex-1 overflow-y-auto">
            <li>
                <a href="{{ route('dashboard') }}"
                    class="flex items-center p-2 text-white rounded-lg hover:bg-gray-700 group {{ request()->routeIs('dashboard') ? 'bg-blue-700 hover:bg-blue-800' : '' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('dashboard') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                        <path
                            d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                        <path
                            d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                    </svg>
                    <span class="ms-3">Dashboard</span>
                </a>
            </li>

            <!-- Finance Module -->
            <li>
                <button type="button"
                    class="flex items-center w-full p-2 text-base text-white transition duration-75 rounded-lg group hover:bg-gray-700"
                    aria-controls="dropdown-finance" data-collapse-toggle="dropdown-finance">
                    <svg class="flex-shrink-0 w-5 h-5 text-gray-400 transition duration-75 group-hover:text-white"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 18a8 8 0 1 1 8-8 8.009 8.009 0 0 1-8 8Z" />
                        <path d="M10.5 5.5A1.5 1.5 0 0 0 9 7v3a1.5 1.5 0 0 0 3 0V7a1.5 1.5 0 0 0-1.5-1.5Z" />
                        <path d="M10 15a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z" />
                    </svg>
                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Finance</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <ul id="dropdown-finance" class="hidden py-2 space-y-2">
                    <li>
                        <a href="#"
                            class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-gray-700">Accounting</a>
                    </li>
                    <li>
                        <a href="#"
                            class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-gray-700">Payroll</a>
                    </li>
                    <li>
                        <a href="#"
                            class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-gray-700">Cost
                            Management</a>
                    </li>
                    <li>
                        <a href="#"
                            class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-gray-700">Financial
                            Reports</a>
                    </li>
                </ul>
            </li>

            <!-- Sales Module -->
            <li>
                <button type="button"
                    class="flex items-center w-full p-2 text-base text-white transition duration-75 rounded-lg group hover:bg-gray-700"
                    aria-controls="dropdown-sales" data-collapse-toggle="dropdown-sales">
                    <svg class="flex-shrink-0 w-5 h-5 text-gray-400 transition duration-75 group-hover:text-white"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                        <path
                            d="M17 5.923A1 1 0 0 0 16 5h-3V4a4 4 0 1 0-8 0v1H2a1 1 0 0 0-1 .923L.086 17.846A2 2 0 0 0 2.08 20h13.84a2 2 0 0 0 1.994-2.153L17 5.923ZM7 9a1 1 0 0 1-2 0V7h2v2Zm0-5a2 2 0 1 1 4 0v1H7V4Zm6 5a1 1 0 1 1-2 0V7h2v2Z" />
                    </svg>
                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Sales</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <ul id="dropdown-sales" class="hidden py-2 space-y-2">
                    <li>
                        <a href="#"
                            class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-gray-700">Customer
                            Management</a>
                    </li>
                    <li>
                        <a href="#"
                            class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-gray-700">Quotes
                            & Contracts</a>
                    </li>
                    <li>
                        <a href="#"
                            class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-gray-700">Invoices
                            & Payments</a>
                    </li>
                </ul>
            </li>

            <!-- Production Module -->
            <li>
                <button type="button"
                    class="flex items-center w-full p-2 text-base text-white transition duration-75 rounded-lg group hover:bg-gray-700"
                    aria-controls="dropdown-production" data-collapse-toggle="dropdown-production">
                    <svg class="flex-shrink-0 w-5 h-5 text-gray-400 transition duration-75 group-hover:text-white"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="M19.728 10.686c-2.38 2.256-6.153 3.381-9.875 3.381-3.722 0-7.4-1.126-9.571-3.371L0 10.437V18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-7.6l-.272.286Z" />
                        <path
                            d="m.135 7.847 1.542 1.417c3.6 3.712 12.747 3.7 16.635.01L19.605 7.9A.98.98 0 0 1 20 7.652V6a2 2 0 0 0-2-2h-3V3a3 3 0 0 0-3-3H8a3 3 0 0 0-3 3v1H2a2 2 0 0 0-2 2v1.765c.047.024.092.051.135.082ZM10 10.25a1.25 1.25 0 1 1 0-2.5 1.25 1.25 0 0 1 0 2.5ZM7 3a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v1H7V3Z" />
                    </svg>
                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Production</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <ul id="dropdown-production" class="hidden py-2 space-y-2">
                    <li>
                        <a href="#"
                            class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-gray-700">Production
                            Planning</a>
                    </li>
                    <li>
                        <a href="#"
                            class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-gray-700">Raw
                            Materials</a>
                    </li>
                    <li>
                        <a href="#"
                            class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-gray-700">Quality
                            Control</a>
                    </li>
                    <li>
                        <a href="#"
                            class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-gray-700">Equipment
                            Maintenance</a>
                    </li>
                    <li>
                        <a href="#"
                            class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-gray-700">Mix
                            Design</a>
                    </li>
                </ul>
            </li>

            <!-- Inventory Module -->
            <li>
                <button type="button"
                    class="flex items-center w-full p-2 text-base text-white transition duration-75 rounded-lg group hover:bg-gray-700"
                    aria-controls="dropdown-inventory" data-collapse-toggle="dropdown-inventory">
                    <svg class="flex-shrink-0 w-5 h-5 text-gray-400 transition duration-75 group-hover:text-white"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 18">
                        <path
                            d="M17 16h-1V2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v14H0v2h17c.6 0 1-.4 1-1v-1h2v-2h-3v2Zm-3-6H3V3h11v7Z" />
                        <path d="M10 7H6v2h4V7Zm2-3H6v2h6V4Z" />
                    </svg>
                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Inventory</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <ul id="dropdown-inventory" class="hidden py-2 space-y-2">
                    <li>
                        <a href="#"
                            class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-gray-700">Raw
                            Materials</a>
                    </li>
                    <li>
                        <a href="#"
                            class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-gray-700">Finished
                            Products</a>
                    </li>
                    <li>
                        <a href="#"
                            class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-gray-700">Silo
                            Management</a>
                    </li>
                    <li>
                        <a href="#"
                            class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-gray-700">Stock
                            Opname</a>
                    </li>
                </ul>
            </li>

            <!-- HR Module -->
            <li>
                <button type="button"
                    class="flex items-center w-full p-2 text-base text-white transition duration-75 rounded-lg group hover:bg-gray-700"
                    aria-controls="dropdown-hr" data-collapse-toggle="dropdown-hr">
                    <svg class="flex-shrink-0 w-5 h-5 text-gray-400 transition duration-75 group-hover:text-white"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 18">
                        <path
                            d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
                    </svg>
                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Employees</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <ul id="dropdown-hr" class="hidden py-2 space-y-2">
                    <li>
                        <a href="#"
                            class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-gray-700">Employee
                            Data</a>
                    </li>
                    <li>
                        <a href="#"
                            class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-gray-700">Attendance</a>
                    </li>
                    <li>
                        <a href="#"
                            class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-gray-700">Work
                            Shifts</a>
                    </li>
                    <li>
                        <a href="#"
                            class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-gray-700">Leave</a>
                    </li>
                    <li>
                        <a href="#"
                            class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-gray-700">Payroll</a>
                    </li>
                </ul>
            </li>

            <!-- Settings -->
            <li>
                <a href="#" class="flex items-center p-2 text-white rounded-lg hover:bg-gray-700 group">
                    <svg class="flex-shrink-0 w-5 h-5 text-gray-400 transition duration-75 group-hover:text-white"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="M5 11.424V1a1 1 0 0 0-2 0v10.424a3.228 3.228 0 0 0 0 6.152V19a1 1 0 1 0 2 0v-1.424a3.228 3.228 0 0 0 0-6.152ZM19.25 14.5A3.243 3.243 0 0 0 17 11.424V1a1 1 0 0 0-2 0v10.424a3.227 3.227 0 0 0 0 6.152V19a1 1 0 1 0 2 0v-1.424a3.243 3.243 0 0 0 2.25-3.076Zm-6-9A3.243 3.243 0 0 0 11 2.424V1a1 1 0 0 0-2 0v1.424a3.228 3.228 0 0 0 0 6.152V19a1 1 0 1 0 2 0V8.576A3.243 3.243 0 0 0 13.25 5.5Z" />
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Settings</span>
                </a>
            </li>

            <!-- Mobile menu button - Only visible on mobile -->
            <div class="sm:hidden pt-4 mt-4">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center p-2 text-white bg-red-600 hover:bg-red-700 rounded-lg">
                        <svg class="flex-shrink-0 w-5 h-5 text-white transition duration-75" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 16">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="M4 8h11m0 0-4-4m4 4-4 4m-5 3H3a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h3" />
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Logout</span>
                    </button>
                </form>
            </div>
        </ul>

        <!-- User profile section -->
        <div class="pt-4 mt-4 hidden sm:block space-y-2 border-t border-gray-700">
            <div class="px-2 py-3 bg-gray-700 rounded-lg mb-2">
                <div class="flex items-center space-x-4">
                    <div class="flex-shrink-0">
                        <div class="relative">
                            <img class="w-10 h-10 rounded-full"
                                src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random"
                                alt="{{ Auth::user()->name }}">
                            <span
                                class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 border-2 border-gray-700 rounded-full"></span>
                        </div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-white truncate">
                            {{ Auth::user()->name }}
                        </p>
                        <p class="text-xs text-gray-400 truncate">
                            {{ Auth::user()->email }}
                        </p>
                    </div>
                    <div
                        class="inline-flex items-center text-xs font-medium text-white bg-gray-600 px-2 py-1 rounded-lg">
                        Admin
                    </div>
                </div>
            </div>
            <a href="{{ route('profile.show') }}" class="flex items-center p-2 text-white rounded-lg hover:bg-gray-700 group">
                <svg class="flex-shrink-0 w-5 h-5 text-gray-400 transition duration-75 group-hover:text-white"
                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19a9 9 0 1 0 0-18 9 9 0 0 0 0 18Zm0 0a8.949 8.949 0 0 0 4.951-1.488A3.987 3.987 0 0 0 11 14H9a3.987 3.987 0 0 0-3.951 3.512A8.948 8.948 0 0 0 10 19Zm3-11a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>
                <span class="ms-3">Profile</span>
            </a>
            <form method="POST" action="{{ route('logout') }}"
                class="flex items-center p-2 text-white rounded-lg hover:bg-gray-700 group">
                @csrf
                <svg class="flex-shrink-0 w-5 h-5 text-gray-400 transition duration-75 group-hover:text-white"
                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 16">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 8h11m0 0-4-4m4 4-4 4m-5 3H3a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h3" />
                </svg>
                <button type="submit" class="ms-3 text-left w-full">Logout</button>
            </form>
        </div>
    </div>
</aside>
