<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WalletController extends Controller
{
    /** @deprecated Use WithdrawalController – wallet hanya untuk penggalang */
    public function show(Request $request)
    {
        return redirect()->route('wallet.index');
    }
}
