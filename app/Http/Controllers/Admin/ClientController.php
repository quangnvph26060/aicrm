<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Services\ClientService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ClientController extends Controller
{
    protected $clientService;
    public function __construct(ClientService $clientService) {
        $this->clientService = $clientService;
    }
    public function index(){
        try{
            $client = $this->clientService->getAllClient();
            return view('Themes.pages.client.index', compact('client'));
        }
        catch(Exception$e){
            Log::error('Failed to fetch clients: ' . $e->getMessage());
            return ApiResponse::error('Failed to fetch clients', 500);
        }
    }

    public function edit($id){
        try{
            $client =  $this->clientService->getClientByID($id);
            return view('Themes.pages.client.detail', compact('client'));
        }
        catch(\Exception $e){
            Log::error('Failed to find client profile');
        }
    }

    public function update($id, Request $request)
    {
        try{
            $client = $this->clientService->updateClient($id, $request->all());
            session()->flash('success', 'Cập nhật thông tin khách hàng thành công!');
            return redirect()->route('admin.client.index');
        }
        catch(\Exception $e)
        {
            Log::error('Failed to update client profile: ' . $e->getMessage());
            return ApiResponse::error('Failed to update client profile', 500);
        }
    }

    public function delete($id)
    {
        try{
            $this->clientService->deleteClient($id);
            session()->flash('success', 'Xóa thông tin khách hàng thành công');
            return redirect()->back();
        }
        catch(\Exception $e)
        {
            Log::error('Failed to delete client profile: ' . $e->getMessage());
            return ApiResponse::error('Failed to update client profile ',500);
        }
    }
}
