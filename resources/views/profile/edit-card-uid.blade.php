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
            <x-primary-button wire:click="confirmCardEdit" wire:loading.attr="disabled">
                {{ __('Edit Card UID') }}
            </x-primary-button>
        </div>

        <!-- Edit Card UID Confirmation Modal -->
        <x-dialog-modal wire:model="confirmingCardEdit">
            <x-slot name="title">
                {{ __('Edit Card UID') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Please enter the new Card UID you want to assign to this user.') }}

                <div class="mt-4" x-data="{}" x-on:confirming-edit-card.window="setTimeout(() => $refs.cardUid.focus(), 250)">
                    <x-input type="text" class="mt-1 block w-3/4"
                                placeholder="{{ __('Card UID') }}"
                                x-ref="cardUid"
                                wire:model.defer="newCardUid"
                                wire:keydown.enter="updateCardUid" />

                    <x-input-error for="newCardUid" class="mt-2" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('confirmingCardEdit')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-primary-button class="ml-3" wire:click="updateCardUid" wire:loading.attr="disabled">
                    {{ __('Save') }}
                </x-primary-button>
            </x-slot>
        </x-dialog-modal>
    </x-slot>
</x-action-section>
