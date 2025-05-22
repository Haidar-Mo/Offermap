<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plan;
use App\Traits\ResponseTrait;
use App\Http\Requests\Api\V1\Dashboard\{
    PlanStoreRequest,
    UpdatePlanRequest
};
use Exception;
use Illuminate\Support\Facades\DB;

class PlanController extends Controller
{
    use ResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->showResponse(Plan::get(),'done successfully..!');
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
    public function store(PlanStoreRequest $request)
    {
        DB::beginTransaction();
        try{
            Plan::create($request->all());
            DB::commit();
            return $this->showMessage('Plan created successfully');
        }catch(Exception $e){
            DB::rollBack();
            return $this->showError($e,'something goes wrong...try again');

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(UpdatePlanRequest $request, string $id)
    {
        DB::beginTransaction();
        try{
            $Plan=Plan::findOrFail($id);
            $Plan->update($request->all());
            DB::commit();
            return $this->showMessage('plan updated successfully');
        }catch(Exception $e){
            DB::commit();
            return $this->showError($e,'something goes wrong...try again');

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Plan=Plan::FindOrFail($id);
        $Plan->delete();
        return $this->showMessage('plan deleted successfully');
    }
}
