<?php

namespace App\Services\Mobile;

use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

/**
 * Class StoreService.
 */
class StoreService
{

    public function store(FormRequest $request)
    {
        $user = auth()->user();
        if ($user->store()->first()) {
            throw new Exception("لا يمكنك إنشاء أكثر من متجر", 400);
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
            throw new Exception("عليك إنشاء المتجر أولاً", 400);
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
