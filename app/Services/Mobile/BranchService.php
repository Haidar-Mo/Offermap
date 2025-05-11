<?php

namespace App\Services\Mobile;

use App\Models\Branch;
use App\Models\Store;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class BranchService.
 */
class BranchService
{

    public function index(string $id)
    {
        $store = Store::findOrFail($id);
        return $store->branches()->get();
    }

    public function show(string $id)
    {
        return Branch::findOrFail($id);
    }

    public function store(FormRequest $request)
    {
        $store = $request->user()->store()->first();
        $data = $request->validated();
        return DB::transaction(function () use ($data, $store) {
            $branch = $store->branches()->create($data); 
            return $branch;
        });
    }

    public function update(FormRequest $request, string $id)
    {
        $branch = $request->user()
            ->store()->first()
            ->branches()->findOrFail($id);
        $data = $request->validated();
        return DB::transaction(function () use ($data, $branch) {
            $branch->update($data);
            return $branch;
        });
    }

    public function destroy(string $id)
    {
        $user = request()->user();

        $store = $user->store()->firstOrFail();
        $branch = $store->branches()->findOrFail($id);

        return DB::transaction(function () use ($branch) {
            $branch->delete();
        });
    }

}
