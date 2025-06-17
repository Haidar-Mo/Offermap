<?php

namespace App\Enums;

enum OrderStatusEnum: string
{
    case NEW = 'new';

    case ACCEPTED = 'accepted';

    case REJECTED = 'rejected';

    case EXPIRED = 'expired';
}
