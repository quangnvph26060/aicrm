<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Models\Campaign;
use App\Models\OaTemplate;
use App\Models\ZaloOa;
use App\Services\CampaignService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CampaignController extends Controller
{
    protected $campaignService;
    public function __construct(CampaignService $campaignService)
    {
        $this->campaignService = $campaignService;
    }

    public function index()
    {
        try {
            $title = 'Chiến dịch';
            $campaigns = $this->campaignService->getPaginateCampaign();
            // dd($campaigns);
            if (request()->ajax()) {
                $view = view('superadmin.campaign.table', compact('campaigns'))->render();
                return response()->json(['success' => true, 'table' => $view]);
            }
            return view('superadmin.campaign.index', compact('campaigns', 'title'));
        } catch (Exception $e) {
            Log::error('Failed to fetch all Campaign:' . $e->getMessage());
            return ApiResponse::error('Failed to fetch all Campaign', 500);
        }
    }

    public function add()
    {
        try {
            $oa_id = ZaloOa::where('is_active', 1)->first()->id;
            $template = OaTemplate::where('oa_id', $oa_id)->get();
            return view('superadmin.campaign.add', compact('template'));
        } catch (Exception $e) {
            Log::error('Failed to get OaId or templates: ' . $e->getMessage());
            return ApiResponse::error('Failed to get OaId or templates', 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $campaigns = $this->campaignService->createNewCampaign($request->all());
            session()->flash('success', 'Thêm chiến dịch thành công');
            return redirect()->route('super.campaign.index');
        } catch (Exception $e) {
            Log::error('Failed to create new Campaign:' . $e->getMessage());
            return ApiResponse::error('Failed to create new Campaign', 500);
        }
    }

    public function edit($id)
    {
        try {
            $oa_id = ZaloOa::where('is_active', 1)->first()->id;
            $template = OaTemplate::where('oa_id', $oa_id)->get();
            $campaigns = Campaign::find($id);
            return view('superadmin.campaign.edit', compact('template', 'campaigns'));
        } catch (Exception $e) {
            Log::error('Failed to find Campaign: ' . $e->getMessage());
            return ApiResponse::error('Failed to find Campaign', 500);
        }
    }

    public function update($id, Request $request)
    {
        try {
            $campaigns = $this->campaignService->updateCampaign($request->all(), $id);
            session()->flash('success', 'Cập nhật thông tin chiến dịch thành công');
            return redirect()->route('super.campaign.index');
        } catch (Exception $e) {
            Log::error('Failed to update Campagin Information:' . $e->getMessage());
            return ApiResponse::error('Failed to update Campaign Information', 500);
        }
    }

    public function delete($id)
    {
        try {
            $this->campaignService->deleteCampaign($id);
            $campaigns = $this->campaignService->getPaginateCampaign();
            $table = view('superadmin.campaign.table', compact('campaigns'))->render();
            $pagination = $campaigns->links('vendor.pagination.custom')->render();

            return response()->json([
                'success' => true,
                'message' => 'Xóa chiến dịch thành công',
                'table' => $table,
                'pagination' => $pagination,
            ]);
        } catch (Exception $e) {
            Log::error('Failed to delete Campaigns: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Xóa chiến dịch thất bại'
            ]);
        }
    }

    public function updateStatus(Request $request, $id)
    {
        try {
            $campaigns = Campaign::findOrFail($id);
            $campaigns->status = $request->input('status');
            $campaigns->save();
            return response()->json(['success' => true]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Cập nhật trạng thái thất bại', 'error' => $e->getMessage()]);
        }
    }

    public function fetch()
    {
        $campaigns = Campaign::paginate(10);

        return view('superadmin.campaign.table', compact('campaigns'))->render();
    }
}
