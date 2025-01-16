<?php
namespace App\Services;

use LaunchDarkly\LDClient;
use LaunchDarkly\LDContext;

class FeatureFlagService
{
    private LDClient $client;
    private LDContext $context;
    public function __construct($clientKey)
    {
        $this->client = new LDClient($clientKey);
    }

    public function setContext(LDCOntext $context)
    {
        $this->context = $context;
    }

    public function isFlagEnable(string $flag, $default = null)
    {
        $ldContext = LDContext::builder('phucnguyen.snow@gmail.com')->kind('user')->build();
        $this->setContext($ldContext);
        return $this->client->variation($flag, $this->context, $default);
    }
}