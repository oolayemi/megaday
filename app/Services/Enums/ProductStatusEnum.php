<?php

namespace App\Services\Enums;

enum ProductStatusEnum
{
    case active;
    case pending;
    case declined;
    case draft;
    case sold;
}
