<?php

namespace App\Enums;

<<<<<<< HEAD
enum TransactionStatus: string
{
    case Pending = 'pending';
    case Paid = 'paid';
    case Expired = 'expired';
    case Cancelled = 'cancelled';
=======
enum TransactionStatus : string
{
    case Pending = 'pending';
    case Success = 'success';
    case Denied = 'denied';
>>>>>>> master
}
