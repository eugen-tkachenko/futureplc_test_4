<?php

include_once('./enums/StatusEnumTrait.php');

enum SubscriptionStatus: string
{
    use StatusEnumTrait;

    // const __default = self::StatusCustom;

    case ActiveSubscriber       = 'active_subscriber';
    case ExpiredSubscriber      = 'expired_subscriber';
    case NeverSubscribed        = 'never_subscribed';
    case StatusUnknown          = 'subscription_unknown';
    case StatusCustom           = 'custom';
}