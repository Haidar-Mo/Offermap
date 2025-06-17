<?php

namespace App\Services\Mobile\Vendor;

use App\Models\OrderHistory;
use Illuminate\Http\Request;

/**
 * Class OrderService.
 */
class OrderService
{

    public function indexAllOrders(Request $request)
    {
        $branchIds = auth()->user()->store()->first()->branches()->pluck('id');
        return OrderHistory::whereIn('branch_id', $branchIds)->get();
    }


    public function indexBranchOrders(Request $request, string $id)
    {
        return auth()->user()
            ->store()->first()
            ->branches()->find($id)
            ->orders;
    }
}
