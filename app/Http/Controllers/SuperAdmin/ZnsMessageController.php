<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Models\ZaloOa;
use App\Models\ZnsMessage;
use App\Services\OaTemplateService;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ZnsMessageController extends Controller
{
    protected $oaTemplateService;

    public function __construct(OaTemplateService $oaTemplateService)
    {
        $this->oaTemplateService = $oaTemplateService;
    }
    public function znsMessage()
    {
        $messages = ZnsMessage::orderByDesc('sent_at')->get();
        return view('superadmin.message.index', compact('messages'));
    }

    public function znsQuota()
    {
        $accessToken = ZaloOa::where('is_active', 1)->first()->access_token;
        try {
            $client = new Client();
            $response = $client->get('https://business.openapi.zalo.me/message/quota', [
                'headers' => [
                    'access_token' => $accessToken,
                    'Content-Type' => 'application/json'
                ],
            ]);
            $responseBody = $response->getBody()->getContents();
            Log::info('Phản hồi API: ' . $responseBody);
            $responseData = json_decode($responseBody, true)['data'];
            return view('superadmin.message.quota', compact('responseData'));
        } catch (Exception $e) {
            Log::error('Cannot get ZNS quota: ' . $e->getMessage());
            return ApiResponse::error('Cannot get ZNS quota', 500);
        }
    }

    public function templateIndex()
    {
        $templates = $this->oaTemplateService->getAllTemplate();
        $initialTemplateData = null;

        if ($templates->isNotEmpty()) {
            $initialTemplateData = $this->oaTemplateService->getTemplateById($templates->first()->template_id, $templates->first()->oa_id);
        }

        return view('superadmin.message.template', compact('templates', 'initialTemplateData'));
    }

    public function getTemplateDetail(Request $request)
    {
        $templateId = $request->input('template_id');
        $accessToken = ZaloOa::where('is_active', 1)->first()->access_token;

        try {
            $client = new Client();
            $response = $client->get('https://business.openapi.zalo.me/template/info', [
                'headers' => [
                    'access_token' => $accessToken,
                    'Content-Type' => 'application/json'
                ],
                'query' => [
                    'template_id' => $templateId,
                ],
            ]);

            $responseBody = $response->getBody()->getContents();
            $responseData = json_decode($responseBody, true)['data'];

            // Format response for display
            return view('superadmin.message.template_detail', compact('responseData'));
        } catch (Exception $e) {
            Log::error('Failed to get template details: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to get template details'], 500);
        }
    }


    public function refreshTemplates()
    {
        try {
            $statusMessage = $this->oaTemplateService->checkTemplate();
            $templates = $this->oaTemplateService->getAllTemplate();

            // Generate HTML for dropdown
            $options = '';
            foreach ($templates as $template) {
                $options .= '<option value="' . $template->template_id . '">' . $template->template_name . '</option>';
            }

            // Get the details of the first template if it exists
            $initialTemplateData = null;
            if ($templates->isNotEmpty()) {
                $initialTemplateData = $this->oaTemplateService->getTemplateById($templates->first()->template_id, $templates->first()->oa_id);
            }

            return response()->json(['templates' => $options, 'initialTemplateData' => $initialTemplateData]);
        } catch (Exception $e) {
            Log::error('Failed to refresh templates: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to refresh templates'], 500);
        }
    }

    // public function test()
    // {
    //     try {
    //         $accessToken = ZaloOa::where('is_active', 1)->first()->access_token;
    //         $client = new Client();
    //         $response = $client->get('https://business.openapi.zalo.me/template/sample-data', [
    //             'headers' => [
    //                 'access_token' => $accessToken,
    //                 'Content-Type' => 'appliaction/json',
    //             ],
    //             'query' => [
    //                 'template_id' => '355423'
    //             ]
    //         ]);
    //         $responseBody = $response->getBody()->getContents();
    //         $responseData = json_decode($responseBody, true)['data'];
    //         return $responseData;
    //     } catch (Exception $e) {
    //         Log::error('Failed to test: ' . $e->getMessage());
    //     }
    // }
}
