<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sessions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

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
            <div class="overflow-x-auto bg-white rounded-lg shadow">
                <table class="table-auto w-full border-collapse bg-white">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="py-4 px-6 font-semibold text-gray-700 border-b text-left w-1/12">#</th>
                            <th class="py-4 px-6 font-semibold text-gray-700 border-b text-left w-3/12">Name</th>
                            <th class="py-4 px-6 font-semibold text-gray-700 border-b text-left w-2/12">Clocked In</th>
                            <th class="py-4 px-6 font-semibold text-gray-700 border-b text-left w-2/12">Clocked Out</th>
                            <th class="py-4 px-6 font-semibold text-gray-700 border-b text-left w-2/12">Total Hours</th>
                            <th class="py-4 px-6 font-semibold text-gray-700 border-b text-left w-2/12">Pitchers</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($sessionDetails as $key => $detail)
                            <tr class="hover:bg-gray-100">
                                <td class="py-4 px-6 text-gray-700 border-b text-left">{{ $key + 1 }}</td>
                                <td class="py-4 px-6 text-gray-700 border-b text-left">{{ $detail->user->name }}</td>
                                <td class="py-4 px-6 text-gray-700 border-b text-left">{{ $detail->check_in_time }}</td>
                                <td class="py-4 px-6 text-gray-700 border-b text-left">{{ $detail->check_out_time ?? '-' }}</td>
                                <td class="py-4 px-6 text-gray-700 border-b text-left">{{ $detail->total_hours ?? '0' }} hrs</td>
                                <td class="py-4 px-6 text-gray-700 border-b text-left">{{ $detail->pitchers }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-4 px-6 text-center text-gray-700 border-b">No session details available for this date.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
