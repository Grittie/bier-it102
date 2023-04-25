<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('To Do') }}
        </h2>
        <p class="mt-4 text-gray-500 text-sm leading-relaxed">
            Version: 0.02
        </p>
        <p class="mt-4 text-gray-500 text-sm leading-relaxed">
            To request features or changes message Lars Grit on your favorite messaging application.
        </p>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css">
            <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>

            <div class="container mx-auto py-6 px-4" x-data="datatables()" x-cloak>

                <div x-show="selectedRows.length" class="bg-teal-200 fixed top-0 left-0 right-0 z-40 w-full shadow">
                    <div class="container mx-auto px-4 py-4">
                        <div class="flex md:items-center">
                            <div class="mr-4 flex-shrink-0">
                                <svg class="h-8 w-8 text-teal-600" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                          d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                          clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div x-html="selectedRows.length + ' rows are selected'"
                                 class="text-teal-800 text-lg"></div>
                        </div>
                    </div>
                </div>
                <h2 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">To-do items:</h2>
                <ul class="max-w-md space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400">
                    <li>
                        IMPORTANT: FIX MOBILE NAVBAR
                    </li>
                    <li>
                        Implement Hall of Shame
                    </li>
                    <li>
                        Personalize styling
                    </li>
                    <li>
                        Enable users to add pitchers for themselves
                    </li>
                    <li>
                        Add graphics to dashboard
                    </li>
                    <li>
                        Implement more items other than pitchers
                    </li>
                    <li>
                        Add footer
                    </li>
                    <li>
                        Fix some mobile issues
                    </li>
                    <li>
                        Automate to-do list
                    </li>
                    <li>
                        Fix weird top bar size difference
                    </li>
                    <li>
                        Agenda function for planning
                    </li>
                    <li>
                        about us page
                    </li>
                    <li>
                        Stupid quotes on hall of shame
                    </li>
                    <li>
                        Attendency for the 'meetings'
                    </li>
                    <li>
                        Icons for top 3
                    </li>
                    <li>
                        Message board
                    </li>
                    <li>
                        Member list
                    </li>
                    <li>
                        Beer filling graphics
                    </li>
                    <li>
                        Analytics
                    </li>
                    <li>
                        Food leaderboard
                    </li>
                </ul>

            </div>
        </div>
    </div>
</x-app-layout>
