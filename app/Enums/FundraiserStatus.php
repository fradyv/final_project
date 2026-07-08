<?php

namespace App\Enums;

enum FundraiserStatus : string
{
    case Pending = 'pending';
    case Approved = 'approved';
    case Rejected = 'rejected';
}
