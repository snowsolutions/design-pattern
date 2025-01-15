<?php

use App\Constants\FeatureFlag;
use App\Services\FeatureFlagService;


if (!function_exists('get_target_framework')) {
    function get_target_framework()
    {
        $ldFeatureFlagService = new FeatureFlagService('sdk-9930dbaf-2218-4616-b865-a5349423ecc5');
        return $ldFeatureFlagService->isFlagEnable(FeatureFlag::FEATURE_FLAG_USE_FRAMEWORK);
    }
}