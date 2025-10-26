<?php

namespace App\Manager\Constants;
class GlobalConstants
{
    public const DEFAULT_PAGINATION = 10;

    public const STATUS_ACTIVE      = 1;
    public const STATUS_INACTIVE    = 2;

    public const STATUS_LIST_COLOR  = [
        self::STATUS_ACTIVE             => '#67AE6E',
        self::STATUS_INACTIVE           => '#d5c641ff',
    ];

}
