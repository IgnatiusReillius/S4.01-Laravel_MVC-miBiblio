<?php

namespace App\Enums;

enum BookUserState : string
{
    case Favourite  = 'favorite';
    case Borrowed   = 'borrowed';
    case Sold       = 'sold';
    case Lost       = 'lost';
}
