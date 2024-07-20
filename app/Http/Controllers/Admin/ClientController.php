<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Models\Client;
use App\Services\ClientService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Log;

class ClientController extends Controller
{
    protected $clientService;
    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }
    public function index()
    {
        $title = 'Khách hàng';
        try {
            $clients = $this->clientService->getAllClient();
            return view('admin.client.index', compact('clients', 'title'));
        } catch (Exception $e) {
            Log::error('Failed to fetch clients: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch clients'], 500);
        }
    }

    public function findClient(Request $request)
    {
        $title = 'Khách hàng';
        try {
            $client = $this->clientService->findClientByPhone($request->phone);

            // Convert single client to a paginator instance
            $clients = new LengthAwarePaginator(
                $client ? [$client] : [],
                $client ? 1 : 0,
                10,
                1,
                ['path' => Paginator::resolveCurrentPath()]
            );

            return view('admin.client.index', compact('clients', 'title'));
        } catch (Exception $e) {
            Log::error('Failed to find client: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to find client'], 500);
        }
    }
    public function edit($id)
    {
        $title = 'Sửa thông tin khách hàng';
        try {
            $client =  $this->clientService->getClientByID($id);
            return view('admin.client.edit', compact('client', 'title'));
        } catch (\Exception $e) {
            Log::error('Failed to find client profile');
        }
    }

    public function update($id, Request $request)
    {
        try {
            $client = $this->clientService->updateClient($id, $request->all());
            session()->flash('success', 'Cập nhật thông tin khách hàng thành công!');
            return redirect()->route('admin.client.index');
        } catch (\Exception $e) {
            Log::error('Failed to update client profile: ' . $e->getMessage());
            return ApiResponse::error('Failed to update client profile', 500);
        }
    }

    public function delete($id)
    {
        try {
            $this->clientService->deleteClient($id);
            $clients = Client::orderByDesc('created_at')->paginate(5); 
            $view = view('admin.client.table', compact('clients'))->render();
            return response()->json(['success' => true, 'message' => 'Xóa thành công!', 'table' => $view]);
        } catch (Exception $e) {
            Log::error('Failed to delete client: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Khách hàng không thể xóa.']);
        }
    }
}
