<?php

include_once('./enums/StatusEnumTrait.php');

enum FreeProductStatus: string
{
    use StatusEnumTrait;

    // const __default = self::StatusCustom;

    case Status0        = 'downloaded_free_single_issue_while_active_sub'; // added
    case Status1        = 'has_downloaded_free_product';
    case Status2        = 'not_downloaded_free_product';
    case StatusUnknown  = 'downloaded_free_product_unknown';
    case StatusCustom   = 'custom';

}