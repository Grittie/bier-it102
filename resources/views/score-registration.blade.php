<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Registration') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                <form method="POST" action="{{ route('score-store') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="user_id" class="block text-gray-700 font-bold mb-2">Select User:</label>
                        <select class="form-select w-full" id="user_id" name="user_id">
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="pitchers" class="block text-gray-700 font-bold mb-2">Pitchers:</label>
                        <input type="number" class="form-input w-full" id="pitchers" name="pitchers">
                    </div>

                    <div class="mb-4">
                        <label for="shame" class="block text-gray-700 font-bold mb-2">Shame:</label>
                        <input type="number" class="form-input w-full" id="shame" name="shame">
                    </div>

                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                        Button
                    </button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
