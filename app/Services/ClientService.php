<?php

namespace App\Services;

use App\Models\Client;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ClientService
{
    protected $client;
    public function __construct(Client $client) {
        $this->client = $client;
    }
    public function getAllClient(){
        try{
            $client = $this->client->all();
            return $client;
        }
        catch(Exception $e){
            Log::error('Failed to get all clients: ' . $e->getMessage());
            throw new Exception('Failed to get all clients');
        }
    }

    public function getClientByID($id)
    {
        try{
            $client = $this->client->find($id);
            return $client;
        }
        catch(Exception $e){
            Log::error('Failed to find client: ' . $e->getMessage());
            throw new Exception('Failed to find client');
        }
    }
    public function addClient($data): Client
    {
        try{
            Log::info('Adding new client');
            $client = $this->client->create($data);
            DB::commit();
            return $client;
        }
        catch(Exception $e){
            DB::rollBack();
            Log::error('Failed to add new client: ' . $e->getMessage());
            throw new Exception('Failed to add new client');
        }
    }

    public function updateClient($id, array $data): Client
    {
        DB::beginTransaction();
        try{
            Log::info("Updating client $id profile");
            $client = $this->client->find($id);
            $client->update($data);
            DB::commit();
            return $client;
        }
        catch(Exception $e){
            DB::rollBack();
            Log::error('Failed to update client profile: ' . $e->getMessage());
            throw new Exception('Failed to update client profile');
        }
    }

    public function deleteClient($id): void
    {
        DB::beginTransaction();
        try{
            Log::info("Deleting client $id profile");
            $client = $this->client->find($id);
            $client->delete();
        }
        catch(Exception $e){
            DB::rollBack();
            Log::error('Failed to delete client profile: ' . $e->getMessage());
            throw new Exception('Failed to delete client profile');
        }
    }
    public function findClientByPhone($phone){
        try{
            $client = $this->client
            ->where('phone', $phone)
            ->orWhere('email', $phone)
            ->first();

            if($client->isEmpty()){
                throw new Exception('Client not found');
            }
            Log::info($client);
            return $client;
        }
        catch(Exception $e){
            Log::error('Failed to find client profile: ' . $e->getMessage());
            throw new Exception('Failed to find client profile');
        }
    }
}
