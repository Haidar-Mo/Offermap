<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Dashboard\UpdateStatusAds;
use Illuminate\Http\Request;
use App\Models\{
    Advertisement
};
use App\Traits\ResponseTrait;

use App\Http\Resources\{
    AdvertisementResource,
    AdvertisementShowResource
};
use Exception;
use Illuminate\Support\Facades\DB;

class AdvertisementController extends Controller
{
    use ResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $advertisements = Advertisement::query()
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->searchByTitle($request->search);
            })
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->filterByStatus($request->status);
            })
            ->get();

        return $this->showResponse(AdvertisementResource::collection($advertisements), 'done successfully');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ads = Advertisement::FindOrFail($id);
        return $this->showResponse(new AdvertisementShowResource($ads), 'done successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStatusAds $request, string $id)
    {
        $ads = Advertisement::FindOrFail($id);
        $ads->update($request->all());
        return $this->showMessage('Status updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {
            $ads = Advertisement::FindOrFail($id);
            $ads->delete();
            DB::commit();
            return $this->showMessage('Ads Deleted successfully');
        } catch (Exception $e) {
            DB::rollBack();
            return $this->showError($e, 'Try again');
        }
    }
}
