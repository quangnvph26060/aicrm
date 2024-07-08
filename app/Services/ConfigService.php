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
            $config = Config::first();
            if (!$config) {
                $result = new Config();
                DB::beginTransaction();
                if (isset($data['logo'])) {
                    $logo = $data['logo'];
                    $logoFileName = 'image_' . '_' . $logo->getClientOriginalName();
                    $logoFilePath = 'public/config/' . $logoFileName; // Storage path
                    Storage::putFileAs('public/config', $logo, $logoFileName); // Store image
                     $result->logo = $logoFilePath;
                }

                if (isset($data['login_banner'])) {
                    $banner = $data['login_banner'];
                    $bannerFileName = 'image_' . '_' . $banner->getClientOriginalName();
                    $bannerFilePath = 'public/config/' . $bannerFileName; // Storage path
                    Storage::putFileAs('public/config', $banner, $bannerFileName); // Store image
                     $result->login_banner = $bannerFilePath;
                }

                $result->name = $data['name'];
                $result->email = $data['email'];
                $result->phone = $data['phone'];
                $result->policy = $data['policy'];
                $result->save();
                DB::commit();
                return $result;
            } else {
                DB::beginTransaction();
                if (isset($data['logo'])) {
                    $logo = $data['logo']; // Single file
                    $logoFileName = 'image_' . $logo->getClientOriginalName();
                    $logoFilePath = 'storage/config/' . $logoFileName; // Storage path
                    Storage::putFileAs('public/config', $logo, $logoFileName); // Store image
                    $config->logo = $logoFilePath; // Update logo path in database
                }

                if (isset($data['login_banner'])) {
                    $banner = $data['login_banner']; // Single file
                    $bannerFileName = 'image_' . $banner->getClientOriginalName();
                    $bannerFilePath = 'storage/config/' . $bannerFileName; // Storage path
                    Storage::putFileAs('public/config', $banner, $bannerFileName); // Store image
                    $config->login_banner = $bannerFilePath; // Update banner path in database
                }

                $config->name = $data['name'];
                $config->email = $data['email'];
                $config->phone = $data['phone'];
                $config->policy = $data['policy'];

                $config->save();

                DB::commit();

                return $config;
            }
        } catch (Exception $e) {
            Log::error('Failed to fetch configuration: ' . $e->getMessage());
            throw new Exception('Failed to fetch configuration');
        }
    }
}
