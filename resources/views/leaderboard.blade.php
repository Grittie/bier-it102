<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Leaderboard') }}
        </h2>
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

                <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative"
                     style="height: 405px;">
                    <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
                        <thead>
                        <tr class="text-left">
                            <th class="py-2 px-3 sticky top-0 border-b border-gray-200 bg-gray-100">
                                <label
                                    class=" inline-flex justify-between items-center hover:bg-gray-200 px-2 py-2 rounded-lg cursor-pointer">
                                    #
                                </label>
                            </th>
                            <th class="py-2 px-3 sticky top-0 border-b border-gray-200 bg-gray-100">
                                <label
                                    class=" inline-flex justify-between items-center hover:bg-gray-200 px-2 py-2 rounded-lg cursor-pointer">
                                    Naam
                                </label>
                            </th>
                            <th class="py-2 px-3 sticky top-0 border-b border-gray-200 bg-gray-100">
                                <label
                                    class=" inline-flex justify-between items-center hover:bg-gray-200 px-2 py-2 rounded-lg cursor-pointer">
                                    Pitchers
                                </label>
                            </th>
                            <th class="py-2 px-3 sticky top-0 border-b border-gray-200 bg-gray-100">
                                <label
                                    class=" inline-flex justify-between items-center hover:bg-gray-200 px-2 py-2 rounded-lg cursor-pointer">
                                    Liter bier
                                </label>
                            </th>
                            <th class="py-2 px-3 sticky top-0 border-b border-gray-200 bg-gray-100">
                                <label
                                    class=" inline-flex justify-between items-center hover:bg-gray-200 px-2 py-2 rounded-lg cursor-pointer">
                                    Prijskes
                                </label>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $key => $user)
                            <tr>
                                <td class="border-dashed border-t border-gray-200 userId">
                                    <span class="text-gray-700 px-6 py-3 flex items-center"> {{$key + 1}} </span>
                                </td>
                                <td class="border-dashed border-t border-gray-200 firstName">
                                    <span class="text-gray-700 px-6 py-3 flex items-center"> {{$user->name}}  </span>
                                </td>
                                <td class="border-dashed border-t border-gray-200 lastName">
                                    <span class="text-gray-700 px-6 py-3 flex items-center"> {{$user->scores->pitchers}} </span>
                                </td>
                                <td class="border-dashed border-t border-gray-200 lastName">
                                    <span class="text-gray-700 px-6 py-3 flex items-center"> {{$user->scores->pitchers * 1.8}} L</span>
                                </td>
                                <td class="border-dashed border-t border-gray-200 lastName">
                                    <span class="text-gray-700 px-6 py-3 flex items-center"> € {{$user->scores->pitchers * 13}} </span>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
