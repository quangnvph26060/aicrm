<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Services\ClientService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ClientController extends Controller
{
    //
    protected $clientService;
    public function __construct(ClientService $clientService){
        $this->clientService = $clientService;
    }

    public function addClient(Request $request){
        dd($request->all());
        try{
            $client = $this->clientService->addClient($request->all());

        }
        catch(Exception$e){
            Log::error('Failed to fetch clients: ' . $e->getMessage());
            return ApiResponse::error('Failed to fetch clients', 500);
        }
    }

}
