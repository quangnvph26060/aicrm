<?php

namespace App\Services;

use App\Models\Config;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ConfigService
{
    protected $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    public function getConfig()
    {
        try {
            Log::info('Fetching all configuration');
            return Config::first();
        } catch (Exception $e) {
            Log::error('Failed to fetch configuration: ' . $e->getMessage());
            throw new Exception('Failed to fetch configuration');
        }
    }

    public function updateConfig(array $data): Config
    {
        try {
            DB::beginTransaction();

            $config = Config::firstOrNew(); // Use firstOrNew to create or retrieve a new instance
            $config->name = $data['name'];
            $config->email = $data['email'];
            $config->phone = $data['phone'];
            $config->bank_account = $data['bank_account'];
            $config->bank_name = $data['bank_name'];

            if (isset($data['logo'])) {
                $logo = $data['logo'];
                $logoFileName = 'image_' . $logo->getClientOriginalName();
                $logoFilePath = 'storage/config/' . $logoFileName;
                Storage::putFileAs('public/config', $logo, $logoFileName);
                $config->logo = $logoFilePath;
            }

            $config->save();

            DB::commit();

            return $config;
        } catch (Exception $e) {
            DB::rollback();
            Log::error('Failed to update configuration: ' . $e->getMessage());
            throw new Exception('Failed to update configuration');
        }
    }
}
