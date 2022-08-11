<div class="min-h-full">
    <header class="pb-24 bg-pink-600">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:max-w-7xl lg:px-8">
            <div class="relative py-5 flex items-center justify-center lg:justify-between">
                <!-- Logo -->
                <div class=" left-0 flex-shrink-0 lg:static flex items-center space-x-3 text-white">
                    <a href="#">
                        <span class="sr-only">Workflow</span>
                        <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/workflow-mark-white.svg" alt="Workflow">
                    </a>

                    <h1 class="text-xl font-semibold">The Restaurant Mockup Project</h1>
                </div>

                <!-- Right section on desktop -->
                <div class="hidden lg:ml-4 lg:flex lg:items-center lg:pr-0.5">
                    <button type="button"
                            class="flex-shrink-0 p-1 text-indigo-200 rounded-full hover:text-white hover:bg-white hover:bg-opacity-10 focus:outline-none focus:ring-2 focus:ring-white">
                        <span class="sr-only">View notifications</span>
                        <!-- Heroicon name: outline/bell -->
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                             stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="hidden lg:block border-t border-white border-opacity-20 py-5">
                <div class="grid grid-cols-3 gap-8 items-center">
                    <div class="col-span-2">
                        <nav class="flex space-x-4">
                            <!-- Current: "text-white", Default: "text-indigo-100" -->
                            <a href="#"
                               class="text-white text-sm font-medium rounded-md bg-white bg-opacity-0 px-3 py-2 hover:bg-opacity-10"
                               aria-current="page"> Home </a>

                            <a href="#"
                               class="text-indigo-100 text-sm font-medium rounded-md bg-white bg-opacity-0 px-3 py-2 hover:bg-opacity-10">
                                Menu </a>

                            <a href="#"
                               class="text-indigo-100 text-sm font-medium rounded-md bg-white bg-opacity-0 px-3 py-2 hover:bg-opacity-10">
                                Restaurant profile </a>

                            <a href="#"
                               class="text-indigo-100 text-sm font-medium rounded-md bg-white bg-opacity-0 px-3 py-2 hover:bg-opacity-10">
                                About us </a>
                        </nav>
                    </div>
                    <div>
                        {{-- <div class="max-w-md w-full mx-auto">
                            <label for="mobile-search" class="sr-only">Search</label>
                            <div class="relative text-white focus-within:text-gray-600">
                                <div class="pointer-events-none absolute inset-y-0 left-0 pl-3 flex items-center">
                                    <!-- Heroicon name: solid/search -->
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                         aria-hidden="true">
                                        <path fill-rule="evenodd"
                                              d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                              clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input id="mobile-search"
                                       class="block w-full bg-white bg-opacity-20 py-2 pl-10 pr-3 border border-transparent rounded-md leading-5 text-gray-900 placeholder-white focus:outline-none focus:bg-opacity-100 focus:border-transparent focus:placeholder-gray-500 focus:ring-0 sm:text-sm"
                                       placeholder="Search" type="search" name="search">
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="-mt-24 pb-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:max-w-7xl lg:px-8">
            <h1 class="sr-only">Page title</h1>
            <!-- Main 3 column grid -->
            <div class="grid grid-cols-1 gap-4 items-start lg:grid-cols-3 lg:gap-8">
                <!-- Left column -->
                <div class="grid grid-cols-1 gap-4 lg:col-span-2">
                    <section aria-labelledby="section-1-title">
                        <h2 class="sr-only" id="section-1-title">Section title</h2>
                        <div class="rounded-lg bg-white overflow-hidden shadow">
                            <div class="p-6">
                                {{ $slot }}
                            </div>
                        </div>
                    </section>
                </div>

                <!-- Right column -->
                <div class="grid grid-cols-1 gap-4 h-full">
                    <section aria-labelledby="section-2-title">
                        <h2 class="sr-only" id="section-2-title">Section title</h2>
                        <div class="rounded-lg h-full bg-white overflow-hidden shadow">
                            <div class="p-6">
                                {{ $rightSection }}
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 lg:max-w-7xl">
            <div class="border-t border-gray-200 py-8 text-sm text-gray-500 text-center sm:text-left"><span class="block sm:inline">&copy;
                    2021 Tailwind Labs Inc.</span> <span class="block sm:inline">All rights reserved.</span></div>
        </div>
    </footer>
</div>
