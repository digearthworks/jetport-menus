<div>
    <x-jet-form-section submit="createClient">
        <x-slot name="title">
            {{ __('Create a new OAuth2 Application') }}
        </x-slot>

        <x-slot name="description">
            {{ __('OAuth2 Applications gives your third-party application access to user accounts on this instance.') }}
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
                    {{ __('Authorized OAuth2 Applications') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('You have granted access to your personal account to these third party applications. Please revoke access for applications no longer needed.') }}
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

                                        <div class="text-sm text-gray-400">
                                            {{ $client->id }}
                                        </div>

                                        @if(app()->environment(['local', 'testing']))
                                            <div class="text-xs ml-2 text-gray-400">
                                                {{ $client->secret }}
                                            </div>
                                        @endif

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
                {{ __('Please copy your new secret. For your security, it won\'t be shown again.') }}
            </div>

            <x-jet-input class="mt-2" id="newClientId" type="text" readonly :value="$newClientId"
                class="mt-4 bg-gray-100 px-6 py-2 rounded font-mono text-sm text-gray-500 w-full" autofocus
                autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />
            <x-form-help-text value="{{ __('Client Id') }}" />

            <x-jet-input class="mt-2" id="newClientSecret" x-ref="clientSecret" type="text" readonly :value="$clientSecret"
                class="mt-4 bg-gray-100 px-6 py-2 rounded font-mono text-sm text-gray-500 w-full" autofocus
                autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"
                @showing-secret-modal.window="setTimeout(() => $refs.clientSecret.select(), 250)" />
            <x-form-help-text value="{{ __('Client secret. Please store this somewhere safe. Your application will need it for access') }}" />

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
