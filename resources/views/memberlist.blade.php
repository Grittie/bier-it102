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
                <div class="mb-4 p-4 bg-green-600 text-white font-bold rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 p-4 bg-red-600 text-white font-bold rounded">
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
                                    <form action="{{ route('memberlist.destroy', $user->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this user?')" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-500">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="edit-modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg shadow-lg w-1/2">
            <div class="p-6">
                <h2 class="text-xl font-bold text-gray-700 mb-4">Edit User</h2>
                <form id="edit-form" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label class="block text-gray-700">Name</label>
                        <input type="text" id="edit-name" name="name" class="w-full p-2 border rounded">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Email</label>
                        <input type="email" id="edit-email" name="email" class="w-full p-2 border rounded">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Card UID</label>
                        <input type="text" id="edit-card-rfid" name="rfid_tag" class="w-full p-2 border rounded">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Card Status</label>
                        <input type="text" id="edit-card-status" name="status" class="w-full p-2 border rounded">
                    </div>
                    <div class="flex justify-end">
                        <button type="button" class="px-4 py-2 bg-gray-500 text-white rounded mr-2" id="close-modal">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript for Modal -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modal = document.getElementById('edit-modal');
            const editForm = document.getElementById('edit-form');
            const closeModal = document.getElementById('close-modal');
            const editButtons = document.querySelectorAll('.edit-btn');

            editButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const id = button.getAttribute('data-id');
                    const name = button.getAttribute('data-name');
                    const email = button.getAttribute('data-email');
                    const cardRfid = button.getAttribute('data-card-rfid');
                    const cardStatus = button.getAttribute('data-card-status');

                    editForm.action = `/memberlist/${id}`;
                    document.getElementById('edit-name').value = name;
                    document.getElementById('edit-email').value = email;
                    document.getElementById('edit-card-rfid').value = cardRfid;
                    document.getElementById('edit-card-status').value = cardStatus;

                    modal.classList.remove('hidden');
                });
            });

            closeModal.addEventListener('click', () => {
                modal.classList.add('hidden');
            });
        });
    </script>
</x-app-layout>
