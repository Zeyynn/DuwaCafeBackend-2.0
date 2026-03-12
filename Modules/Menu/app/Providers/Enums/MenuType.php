<?php

namespace Modules\Menu\Providers\Enums;

enum MenuType: string
{
    case AllDay = 'all_day';
    case Toast = 'toast';
    case Bites = 'bites';
    case Pizza = 'pizza';
    case Pasta = 'pasta';
    case EtCetera = 'etcetera';
    case Soup = 'soup';
}
