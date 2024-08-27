<?php

namespace App\Services;

use App\Models\Campaign;
use App\Models\CampaignDetail;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CampaignService
{
    protected $campaign;
    protected $campaignDetail;

    public function __construct(Campaign $campaign, CampaignDetail $campaignDetail)
    {
        $this->campaign = $campaign;
        $this->campaignDetail = $campaignDetail;
    }

    public function getAllCampaign()
    {
        try {
            return $this->campaign->get();
        } catch (Exception $e) {
            Log::error('Failed to fetch all campaign: ' . $e->getMessage());
            throw new Exception('Failed to fetch all campaign');
        }
    }

    public function getPaginateCampaign()
    {
        try {
            return $this->campaign->orderByDesc('created_at')->paginate(10);
        } catch (Exception $e) {
            Log::error('Failed to fetch paginated campaign: ' . $e->getMessage());
            throw new Exception('Failed to fetch paginated campaign');
        }
    }

    public function createNewCampaign(array $data)
    {
        try {
            $campaign =  $this->campaign->create([
                'name' => $data['name'],
                'template_id' => $data['template_id'],
                'delay_date' => $data['delay_date'],
                'status' => 1
            ]);

            if (!empty($data['user_id'])) {
                foreach ($data['user_id'] as $user_id) {
                    $this->campaignDetail->create([
                        'campaign_id' => $campaign->id,
                        'user_id' => $user_id,
                        'scheduled_date' => now()->addDays($data['delay_days']),
                        'data' => json_encode([]),
                    ]);
                }
            }
            DB::commit();
            return $campaign;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Failed to create new campaign: ' . $e->getMessage());
            throw new Exception("Failed to create new campaign");
        }
    }

    public function updateCampaign(array $data, $id)
    {
        DB::beginTransaction();
        try {
            // Tìm chiến dịch cần cập nhật
            $campaign = $this->campaign->find($id);
            if (!$campaign) {
                throw new Exception('Campaign not found!');
            }

            // Cập nhật thông tin chiến dịch
            $campaign->update([
                'name' => $data['name'],
                'template_id' => $data['template_id'],
                'delay_date' => $data['delay_date'],
            ]);

            // Xóa các chi tiết chiến dịch được chỉ định
            if (isset($data['user_ids_to_remove'])) {
                $this->campaignDetail->where('campaign_id', $id)
                    ->whereIn('user_id', $data['user_ids_to_remove'])
                    ->delete();
            }

            // Thêm mới các chi tiết chiến dịch
            if (isset($data['user_ids_to_add'])) {
                foreach ($data['user_ids_to_add'] as $user_id) {
                    // Kiểm tra nếu user_id đã tồn tại trong chiến dịch
                    $existingDetail = $this->campaignDetail->where([
                        ['campaign_id', $id],
                        ['user_id', $user_id]
                    ])->first();

                    if (!$existingDetail) {
                        // Nếu chi tiết không tồn tại, tạo mới
                        $this->campaignDetail->create([
                            'campaign_id' => $campaign->id,
                            'user_id' => $user_id,
                            'scheduled_date' => now()->addDays($data['delay_days']),
                            'data' => json_encode([]),
                        ]);
                    }
                }
            }

            DB::commit();
            return $campaign;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Failed to update campaign: ' . $e->getMessage());
            throw new Exception("Failed to update campaign");
        }
    }

    public function deleteCampaign($id)
    {
        DB::beginTransaction();
        try {
            $campaign = $this->campaign->find($id);
            $campaignDetail = $this->campaignDetail->where('campaign_id', $id)->delete();
            $campaign->delete();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Failed to delete campaign: ' . $e->getMessage());
            throw new Exception('Failed to delete campaign');
        }
    }
}
