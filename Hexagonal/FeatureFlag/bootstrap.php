<?php

use App\Constants\FeatureFlag;
use App\Services\FeatureFlagService;


if (!function_exists('get_target_framework')) {
    function get_target_framework()
    {
        $ldFeatureFlagService = new FeatureFlagService(getenv('LD_CLIENT_KEY'));
        return $ldFeatureFlagService->isFlagEnable(FeatureFlag::FEATURE_FLAG_USE_FRAMEWORK);
    }
}