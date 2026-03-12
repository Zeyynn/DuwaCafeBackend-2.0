<?php

namespace Modules\Cart\Providers;

enum OrderStatus:string
{
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
}
