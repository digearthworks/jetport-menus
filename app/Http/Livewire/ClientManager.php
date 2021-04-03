<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Laravel\Passport\ClientRepository;
use Livewire\Component;

class ClientManager extends Component
{
    /**
     * The create form state.
     *
     * @var array
     */
    public $createForm = [
        'name' => '',
        'redirect' => '',
        'confidential' => true,
    ];

    /**
     * The the id of the client currently being managed.
     *
     * @var \Laravel\Passport\ClientRepository|null
     */
    public $managingClientId;

    /**
     * The the id of the client currently being managed.
     *
     * @var string
     */
    public $clientId;

    /**
     * The update form state.
     *
     * @var array
     */
    public $updateForm = [
        'name' => '',
        'redirect' => '',
        'confidential' => true,
    ];

    /**
     * Indicates if the application is confirming if an API token should be deleted.
     *
     * @var bool
     */
    public $confirmingDeletion = false;

    /**
     * Indicates if the application is managing a client.
     *
     * @var bool
     */
    public $managingClient = false;

    /**
     * Indicates if the application is displaying the client secret.
     *
     * @var bool
     */
    public $displayingSecret = false;

    /**
     * The ID of the client being deleted.
     *
     * @var string
     */
    public $clientIdBeingDeleted;

    /**
     * The Client Secret.
     *
     * @var string
     */
    public $clientSecret;


    /**
     * Create a new Client.
     *
     * @return void
     */
    public function createClient(ClientRepository $clients)
    {
        $this->resetErrorBag();

        Validator::make([
            'name' => $this->createForm['name'],
            'redirect' => $this->createForm['redirect'],
        ], [
            'name' => ['required', 'string', 'max:255'],
            'redirect' => ['required', 'string', 'max:255'],
        ])->validateWithBag('createClient');

        $client = $clients->create(
            $this->user->id,
            $this->createForm['name'],
            $this->createForm['redirect'],
            null,
            false,
            false,
            $this->createForm['confidential']
        );

        $this->displaySecretValue($client->secret, $client->id);

        $this->createForm['name'] = '';
        $this->createForm['redirect'] = '';
        $this->createForm['confidential'] = true;

        $this->emit('created');
    }

    /**
     * Display the token value to the user.
     *
     * @param  \Laravel\Passport\Token  $token
     * @return void
     */
    protected function displaySecretValue($clientSecret, $clientId)
    {
        $this->displayingSecret = true;

        $this->clientSecret = $clientSecret;
        $this->clientId = $clientId;

        $this->dispatchBrowserEvent('showing-secret-modal');
    }

    /**
     * Allow the given Client to be managed.
     *
     * @param  int  $tokenId
     * @return void
     */
    public function manageClient($clientId, ClientRepository $clients)
    {
        $this->managingClient = true;

        $client = $clients->findForUser($clientId, $this->user->id);
        // dd($client);

        $this->managingClientId = $clientId;

        $this->updateForm['name'] = $client->name;
        $this->updateForm['redirect'] = $client->redirect;
        $this->updateForm['confidential'] = true;
    }

    /**
     * Update the API token's permissions.
     *
     * @return void
     */
    public function updateClient(ClientRepository $clients)
    {
        $client = $clients->findForUser($this->managingClientId, $this->user->id);
        $clients->update($client, $this->updateForm['name'], $this->updateForm['redirect']);

        $this->managingClient = false;
    }

    /**
     * Confirm that the given API token should be deleted.
     *
     * @param  int  $tokenId
     * @return void
     */
    public function confirmDeletion($clientId)
    {
        $this->confirmingDeletion = true;

        $this->clientIdBeingDeleted = $clientId;
    }

    /**
     * Delete the API token.
     *
     * @return void
     */
    public function deleteClient(ClientRepository $clients)
    {
        $client = $clients->findForUser($this->clientIdBeingDeleted, $this->user->id);

        $clients->delete($client);

        $this->user->load('clients');

        $this->confirmingDeletion = false;

        $this->managingClientId = null;
    }

    /**
     * Get the current user of the application.
     *
     * @return mixed
     */
    public function getUserProperty()
    {
        return Auth::user();
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('api.client-manager');
    }
}
