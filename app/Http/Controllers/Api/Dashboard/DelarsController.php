<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    User,
    Store
};
use App\Traits\ResponseTrait;
use App\Http\Resources\DelardsResource;

class DelarsController extends Controller
{

    use ResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $delars = Store::when($request->has('search'), function ($query) use ($request) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        })
            ->get();

        return $this->showResponse(DelardsResource::collection($delars), 'done successfully');
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
        $delars=Store::FindOrFail($id);
        return $this->showResponse($delars->with(['user','branches','branches.advertisements'])->get());
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delars=Store::FindOrFail($id);
        $delars->delete();
        return $this->showMessage('delars deleted successfully');
    }
}
