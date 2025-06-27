<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Dashboard\IsBlockRequest;
use App\Http\Requests\Api\V1\Dashboard\UpdateStatus;
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

        $delars = Store::query()
            ->with('user')
            ->withCount('branches')
            ->when($request->has('search'), function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%');
            })
            ->get();

        return $this->showResponse(
            DelardsResource::collection($delars),
            'done successfully'
        );
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
        $delars = Store::FindOrFail($id);
        return $this->showResponse($delars->with(['user', 'branches', 'branches.advertisements'])->get());
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
    public function update(UpdateStatus $request, string $id)
    {
        $delar = Store::findOrFail($id);
        $delar->update($request->all());
        return $this->showMessage('done successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delars = Store::FindOrFail($id);
        $delars->delete();
        return $this->showMessage('delars deleted successfully');
    }



    public function IsBlock(IsBlockRequest $request, string $id)
    {

        $delar = Store::FindOrFail($id);
        $delar->update($request->all());
        if ($request->is_blocked) {
            return $this->showMessage('delar blocked successfully');
        } else {
            return $this->showMessage('delar unblocked successfully');
        }
    }
}
