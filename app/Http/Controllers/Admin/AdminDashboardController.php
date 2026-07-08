<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Fundraiser;
use App\Models\Order;
use App\Models\User;
use App\Models\WithdrawalRequest;
use App\Enums\PaymentStatus;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return response()->json([
            'total_users'              => User::count(),
            'total_fundraisers'        => Fundraiser::where('status', 'approved')->count(),
            'total_active_campaigns'   => Campaign::where('status', 'active')->count(),
            'total_orders'             => Order::where('payment_status', PaymentStatus::Paid)->count(),
            'total_order_amount'       => Order::where('payment_status', PaymentStatus::Paid)->sum('total_amount'),
            'pending_withdrawals'      => WithdrawalRequest::where('status', 'pending')->count(),
        ]);
    }

    public function dashboard()
    {
        $stats = [
            'users'                => User::count(),
            'campaigns'            => Campaign::where('status', 'active')->count(),
            'orders'               => Order::where('payment_status', PaymentStatus::Paid)->count(),
            'pending_fundraisers'  => Fundraiser::where('status', 'pending')->count(),
            'pending_withdrawals'  => WithdrawalRequest::where('status', 'pending')->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
