<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\ConfigService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ConfigController extends Controller
{
    protected $configService;

    public function __construct(ConfigService $configService)
    {
        $this->configService = $configService;
    }

    public function index()
    {
        try {
            $data = $this->configService->getConfig();
            return view('admin.configuration.config', compact('data'));
        } catch (\Exception $e) {
            Log::error('Failed to get configuration: ' . $e->getMessage());
            return view('admin.dashboard.dashboard', ['error' => 'Failed to get configuration']);
        }
    }

    public function updateConfig(Request $request)
    {
        try {
            $config = $this->configService->updateConfig($request->all());
            return redirect()->back()->with('success', 'Chỉnh sửa thông tin thành công');
        } catch (\Exception $e) {
            Log::error('Failed to update configuration: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to update configuration');
        }
    }
}
