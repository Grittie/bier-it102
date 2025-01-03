<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Member List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Success and Error Messages -->
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-500 text-white font-bold rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 p-4 bg-red-500 text-white font-bold rounded">
                    {{ session('error') }}
                </div>
            @endif

            <div class="overflow-x-auto bg-white rounded-lg shadow">
                <table class="table-auto w-full border-collapse bg-white">
                    <thead>
                        <tr class="text-left bg-gray-200">
                            <th class="py-4 px-6 font-semibold text-gray-700 border-b">#</th>
                            <th class="py-4 px-6 font-semibold text-gray-700 border-b">Name</th>
                            <th class="py-4 px-6 font-semibold text-gray-700 border-b">Email</th>
                            <th class="py-4 px-6 font-semibold text-gray-700 border-b">Card UID</th>
                            <th class="py-4 px-6 font-semibold text-gray-700 border-b">Card Status</th>
                            <th class="py-4 px-6 font-semibold text-gray-700 border-b">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $key => $user)
                            <tr class="hover:bg-gray-100">
                                <td class="py-4 px-6 text-gray-700 border-b">{{ $key + 1 }}</td>
                                <td class="py-4 px-6 text-gray-700 border-b">{{ $user->name }}</td>
                                <td class="py-4 px-6 text-gray-700 border-b">{{ $user->email }}</td>
                                <td class="py-4 px-6 text-gray-700 border-b">{{ $user->card->rfid_tag ?? 'N/A' }}</td>
                                <td class="py-4 px-6 text-gray-700 border-b">{{ $user->card->status ?? 'N/A' }}</td>
                                <td class="py-4 px-6 text-gray-700 border-b">
                                    <button 
                                        class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 edit-btn"
                                        data-id="{{ $user->id }}"
                                        data-name="{{ $user->name }}"
                                        data-email="{{ $user->email }}"
                                        data-card-rfid="{{ $user->card->rfid_tag ?? '' }}"
                                        data-card-status="{{ $user->card->status ?? '' }}">
                                        Edit
                                    </button>
                                    @if ($user->id !== auth()->id())
                                        <form action="{{ route('memberlist.destroy', $user->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Are you sure you want to delete this user?')" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                                                Delete
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
