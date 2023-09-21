<?php

namespace App\Services\Enums;

enum NotificationTypeEnum: string
{
    case NEW_MESSAGE = "new-message";
    case NEW_OFFER = "new-offer";
    case PRODUCT_APPROVAL = "product-approval";
}
