<x-action-section>
    <x-slot name="title">
        {{ __('Edit Card UID') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update the card UID associated with this user.') }}
    </x-slot>

    <x-slot name="content">
        <div class="max-w-xl text-sm text-gray-600">
            {{ __('You can edit the card UID tied to this user. Please ensure the new UID is correct.') }}
        </div>

        <div class="mt-5">
            <form wire:submit.prevent="updateCardUid">
                <div class="flex items-center">
                    <x-input type="text" class="block w-3/4 mr-2"
                        placeholder="{{ __('Card UID') }}"
                        wire:model.defer="newCardUid" />

                    <x-primary-button>
                        {{ __('Update') }}
                    </x-primary-button>
                </div>

                <x-input-error for="newCardUid" class="mt-2" />
            </form>
        </div>

        @if (session()->has('message'))
            <div class="mt-3 text-green-600">
                {{ session('message') }}
            </div>
        @endif
    </x-slot>
</x-action-section>
