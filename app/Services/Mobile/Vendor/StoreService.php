<?php

namespace App\Services\Mobile\Vendor;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class StoreService
 */
class StoreService
{
    public function show()
    {
        $store = auth()->user()
            ->store();


        $allOrders = $store->first()->branches->flatMap(function ($branch) {
            return $branch->orderHistory()
                ->whereBetween('created_at', [now()->startOfMonth(), now()->endOfDay()])
                ->select(
                    DB::raw("DATE(created_at) as period"),
                    DB::raw('count(*) as count')
                )
                ->groupBy('period')
                ->get();
        });

        // Now group all orders by date and sum the counts
        $offer_number_statistics = $allOrders->groupBy('period')->map(function ($orders) {
            return [
                'date' => $orders->first()->period,
                'total_orders' => $orders->sum('count'),
            ];
        })->values();


        $most_popular_branches = $store->first()?->branches()
            ->get()
            ->append(['rate'])
            ->sortByDesc('rate')->values();

        return (object) [
            'branches' => $store?->with(['branches'])->get()->makeHidden(['user']),
            'offer_number_statistics' => $offer_number_statistics,
            'most_popular_branches' => $most_popular_branches
        ];
    }

    public function store(FormRequest $request)
    {
        $user = auth()->user();
        if ($user->store()->first()) {
            throw new \Exception("لا يمكنك إنشاء أكثر من متجر", 400);
        }
        $data = $request->validated();
        return DB::transaction(function () use ($data, $user) {

            $store = $user->store()->create($data);
            return $store;
        });
    }


    public function update(FormRequest $request)
    {
        $store = auth()->user()->store()->first();
        $data = $request->validated();
        if (!$store) {
            throw new \Exception("عليك إنشاء المتجر أولاً", 400);
        }
        return DB::transaction(function () use ($store, $data) {
            $store->update($data);
            return $store;
        });
    }

    public function destroy()
    {
        return DB::transaction(function () {

            auth()->user()
                ->store()->first()
                ->delete();
        });
    }

}