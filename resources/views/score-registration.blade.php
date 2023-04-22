<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Registration') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <form method="POST" action="{{ route('score-store') }}">
                    @csrf

                    <div class="form-group">
                        <label for="user_id">Select User:</label>
                        <select class="form-control" id="user_id" name="user_id">
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="pitchers">Pitchers:</label>
                        <input type="number" class="form-control" id="pitchers" name="pitchers">
                    </div>

                    <div class="form-group">
                        <label for="shame">Shame:</label>
                        <input type="number" class="form-control" id="shame" name="shame">
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
