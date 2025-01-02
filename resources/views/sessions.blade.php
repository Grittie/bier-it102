<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sessions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css">
            <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>

            <div class="container mx-auto py-6 px-4" x-data="{}" x-cloak>

                <!-- Dropdown for Selecting Session Date -->
                <div class="mb-4">
                    <label for="session-date" class="block text-sm font-medium text-gray-700">
                        Select Session Date:
                    </label>
                    <select id="session-date" name="session_date" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                            onchange="window.location.href = '?session_date=' + this.value;">
                        <option value="">-- Select a Date --</option>
                        @foreach ($sessionDates as $date)
                            <option value="{{ $date }}" {{ request('session_date') == $date ? 'selected' : '' }}>
                                {{ \Carbon\Carbon::parse($date)->format('d-m-Y') }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Table for Session Details -->
                <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative"
                     style="height: 405px;">
                    <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
                        <thead>
                        <tr class="text-left">
                            <th class="py-2 px-3 sticky top-0 border-b border-gray-200 bg-gray-100">#</th>
                            <th class="py-2 px-3 sticky top-0 border-b border-gray-200 bg-gray-100">Name</th>
                            <th class="py-2 px-3 sticky top-0 border-b border-gray-200 bg-gray-100">Clocked In</th>
                            <th class="py-2 px-3 sticky top-0 border-b border-gray-200 bg-gray-100">Clocked Out</th>
                            <th class="py-2 px-3 sticky top-0 border-b border-gray-200 bg-gray-100">Total Hours</th>
                            <th class="py-2 px-3 sticky top-0 border-b border-gray-200 bg-gray-100">Pitchers</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($sessionDetails as $key => $detail)
                            <tr>
                                <td class="border-dashed border-t border-gray-200">
                                    <span class="text-gray-700 px-6 py-3 flex items-center">{{ $key + 1 }}</span>
                                </td>
                                <td class="border-dashed border-t border-gray-200">
                                    <span class="text-gray-700 px-6 py-3 flex items-center">{{ $detail->user->name }}</span>
                                </td>
                                <td class="border-dashed border-t border-gray-200">
                                    <span class="text-gray-700 px-6 py-3 flex items-center">{{ $detail->check_in_time }}</span>
                                </td>
                                <td class="border-dashed border-t border-gray-200">
                                    <span class="text-gray-700 px-6 py-3 flex items-center">{{ $detail->check_out_time ?? '-' }}</span>
                                </td>
                                <td class="border-dashed border-t border-gray-200">
                                    <span class="text-gray-700 px-6 py-3 flex items-center">{{ $detail->total_hours ?? '0' }} hrs</span>
                                </td>
                                <td class="border-dashed border-t border-gray-200">
                                    <span class="text-gray-700 px-6 py-3 flex items-center">{{ $detail->pitchers }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="border-dashed border-t border-gray-200 text-center text-gray-700 px-6 py-3">
                                    No session details available for this date.
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
