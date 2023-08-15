<?php

namespace App\Services\Enums;

enum ProductStatusEnum
{
    case ACTIVE;
    case PENDING;
    case DECLINED;
    case DRAFT;
    case EXPIRED;
}
