<?php

namespace App\Enums;

enum AdvertisementStatusEnum: string
{

    case PENDING = 'pending';

    case ACTIVE = 'active';

    case EXPIRED = 'expired';

    case REJECTED = 'rejected';
}