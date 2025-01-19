<?php

namespace App\Enums;

enum Status: string
{
    case Available = 'available';
    case Pending = 'pending';
    case Sold = 'sold';
}
