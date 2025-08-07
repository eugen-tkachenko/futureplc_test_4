<?php

include_once('./enums/StatusEnumTrait.php');

enum IapProductStatus: string
{
    use StatusEnumTrait;

    // const __default = self::StatusCustom;

    case Status1        = 'purchased_single_issue_while_no_sub'; // added
    case Status2        = 'purchased_single_issue_while_active_sub'; // added

    case Status3        = 'has_downloaded_iap_product';
    case Status4        = 'not_downloaded_iap_product'; // fixed typo
    case StatusUnknown  = 'downloaded_iap_product_unknown';
    case StatusCustom   = 'custom';
}