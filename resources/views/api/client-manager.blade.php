<div>
    <x-jet-form-section submit="createClient">
        <x-slot name="title">
            {{ __('Create a Confidential Client') }}
        </x-slot>

        <x-slot name="description">
            {{ __('Requires the client to authenticate with a secret. Confidential Clients can hold credentails is a secure way without exposing them to unauthorized parties. Public applications, such as native destop or Javascript SPA applications, are unable to hold secrets securely.') }}
        </x-slot>

        <x-slot name="form">
            <!-- Client Name -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="clientName" value="{{ __('Name') }}" />
                <x-jet-input id="clientName" type="text" class="mt-1 block w-full" wire:model.defer="createForm.name"
                    autofocus />
                <x-jet-input-error for="clientName" class="mt-2" />
                <x-form-help-text class="mt-2" value="{{ __('Something your users will recognize and trust.') }}" />
            </div>
            <!-- Redirect Url -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="redirect" value="{{ __('Redirect URL') }}" />
                <x-jet-input id="redirect" type="text" class="mt-1 block w-full" wire:model.defer="createForm.redirect"
                    autofocus />
                <x-jet-input-error for="redirect" class="mt-2" />
                <x-form-help-text class="mt-2" value="Your application's authorization callback url." />
            </div>
        </x-slot>
        <x-slot name="actions">
            <x-jet-action-message class="mr-3" on="created">
                {{ __('Created.') }}
            </x-jet-action-message>

            <x-jet-button>
                {{ __('Create') }}
            </x-jet-button>
        </x-slot>
    </x-jet-form-section>

    @if ($this->user->hasActiveClients())

        <x-jet-section-border />

        <!-- Manage API Tokens -->
        <div class="mt-10 sm:mt-0">
            <x-jet-action-section>
                <x-slot name="title">
                    {{ __('Manage Confidential Clients') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('You may delete any of your existing clients if they are no longer needed.') }}
                </x-slot>

                <!-- API Token List -->
                <x-slot name="content">
                    <div class="space-y-6">
                        @foreach ($this->user->clients->sortBy('name') as $client)
                            @if (!$client->revoked)
                                <div class="flex items-center justify-between">
                                    <div>
                                        {{ $client->name }}
                                    </div>

                                    <div class="flex items-center">

                                        <div class="text-sm text-red-400">
                                            {{ $client->secret }}
                                        </div>

                                        <button class="cursor-pointer ml-6 text-sm text-gray-400 underline"
                                            wire:click="manageClient({{ '"' . $client->id . '"' }})">
                                            {{ __('Edit') }}
                                        </button>

                                        <button class="cursor-pointer ml-6 text-sm text-red-500"
                                            wire:click="confirmDeletion({{ '"' . $client->id . '"' }})">
                                            {{ __('Delete') }}
                                        </button>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </x-slot>
            </x-jet-action-section>
        </div>
    @endif

    <!-- Token Value Modal -->
    <x-jet-dialog-modal wire:model="displayingSecret">
        <x-slot name="title">
            {{ __('Manage Client') }}
        </x-slot>

        <x-slot name="content">
            <div>
                {{ __('You will need to use this secret in your app to gain access.') }}
            </div>

            <x-jet-input x-ref="clientSecret" type="text" readonly :value="$clientSecret"
                class="mt-4 bg-gray-100 px-4 py-2 rounded font-mono text-sm text-gray-500 w-full" autofocus
                autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"
                @showing-token-modal.window="setTimeout(() => $refs.clientSecret.select(), 250)" />
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('displayingSecret', false)" wire:loading.attr="disabled">
                {{ __('Close') }}
            </x-jet-secondary-button>
        </x-slot>
    </x-jet-dialog-modal>

    <!-- Client edit Modal -->
    <x-jet-dialog-modal wire:model="managingClient">
        <x-slot name="title">
            {{ __('Client Details') }}
        </x-slot>

        <x-slot name="content">


            <!-- Client Name -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="updatingClientName" value="{{ __('Name') }}" />
                <x-jet-input id="updatingClientName" type="text" class="mt-1 block w-full"
                    wire:model.defer="updateForm.name" autofocus />
                <x-jet-input-error for="updatingClientName" class="mt-2" />
                <x-form-help-text class="mt-2" value="{{ __('Something your users will recognize and trust.') }}" />
            </div>
            <!-- Redirect Url -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="updatingClientRedirect" value="{{ __('Redirect URL') }}" />
                <x-jet-input id="updatingClientRedirect" type="text" class="mt-1 block w-full"
                    wire:model.defer="updateForm.redirect" autofocus />
                <x-jet-input-error for="updatingClientRedirect" class="mt-2" />
                <x-form-help-text class="mt-2" value="Your application's authorization callback url." />
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('managingClient', false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-button class="ml-2" wire:click="updateClient" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>

    <!-- Delete Token Confirmation Modal -->
    <x-jet-confirmation-modal wire:model="confirmingDeletion">
        <x-slot name="title">
            {{ __('Delete API Token') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you would like to delete this API token?') }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('confirmingDeletion')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="deleteClient" wire:loading.attr="disabled">
                {{ __('Delete') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>


</div>
