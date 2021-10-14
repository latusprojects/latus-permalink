<?php

namespace Latus\Permalink\Database\Seeders;

use Latus\Settings\Services\SettingService;

class SettingSeeder
{
    public function __construct(
        protected SettingService $settingService
    )
    {
    }

    protected static array $settings = [
        'permalink_syntaxes' => '{}',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::$settings as $key => $value) {
            if (!$this->settingService->findByKey($key)) {
                $this->settingService->createSetting(['key' => $key, 'value' => $value]);
            }
        }
    }
}