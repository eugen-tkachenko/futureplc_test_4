<?php

namespace App\DTO;

use App\Enum\SubscriptionStatus;
use App\Enum\FreeProductStatus;
use App\Enum\IapProductStatus;

class DataDTO implements DTOInterface {

    static $idCounter = 1;

    static $appCodes = [];

    /**
     * @param string $key
     * 
     * @return string|null
     */
    function getAppCode($key): ?string {
        return self::$appCodes[$key] ?? null;
    }

    /**
     * @param string $data
     * 
     * @return array
     */
    public function process(string $data): array {

        [$appCode, $deviceId, $contactable, $tags] = explode(',', $data);

        return [
            $this->processId(),
            $this->processAppCode($appCode),
            $this->processDeviceId($deviceId),
            $this->processContactable($contactable),
            ...$this->processTags($tags),
        ];
    }

    public function processId() {
        return self::$idCounter++;        
    }

    public function processDeviceId($deviceId) {
        return trim($deviceId);        
    }

    public function processAppCode($appCode) {
        return self::$appCodes[$appCode] ?? null;
    }

    public function processContactable($status) {
        return (int) $status;
    }

    public function processTags($tags) {
        
        $subscriptionStatus = $freeProductStatus = $iapProductStatus = null;

        $tags = explode('|', trim($tags));

        // first found tag stays
        foreach ($tags as $tag) {
            $subscriptionStatus = $subscriptionStatus   ?? $this->processSubscriptionStatus($tag);
            $freeProductStatus  = $freeProductStatus    ?? $this->processFreeProductStatus($tag);
            $iapProductStatus   = $iapProductStatus     ?? $this->processIapProductStatus($tag);
        }

        // TODO process _while_no_sub

        return [
            $subscriptionStatus ?? SubscriptionStatus::StatusUnknown->value,
            $freeProductStatus  ?? FreeProductStatus::StatusUnknown->value,
            $iapProductStatus   ?? IapProductStatus::StatusUnknown->value,
        ];
    }

    public function processSubscriptionStatus($status) {
        return SubscriptionStatus::fromValue($status);
    }

    public function processIapProductStatus($status) {
        return IapProductStatus::fromValue($status);
    }

    public function processFreeProductStatus($status) {
        return FreeProductStatus::fromValue($status);
    }
}