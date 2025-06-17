<?php

namespace App\Http\Controllers\Api\Mobile\Vendor;

use App\Http\Controllers\Controller;
use App\Services\Mobile\Vendor\OrderService;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    use ResponseTrait;

    public function __construct(protected OrderService $service)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function indexAllOrders(Request $request)
    {
        try {
            $orders = $this->service->indexAllOrders($request);
            return $this->showResponse($orders);
        } catch (\Exception $e) {
            return $this->showError($e);
        }
    }


    /**
     * Display a listing of the resource.
     */
    public function indexBranchOrders(Request $request, string $id)
    {
        try {
            $orders = $this->service->indexBranchOrders($request, $id);
            return $this->showResponse($orders);
        } catch (\Exception $e) {
            return $this->showError($e);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
        } catch (\Exception $e) {
            return $this->showError($e);
        }

    }




    public function accept(string $id)
    {
        try {
        } catch (\Exception $e) {
            return $this->showError($e);
        }

    }


    public function reject(string $id)
    {
        try {
        } catch (\Exception $e) {
            return $this->showError($e);
        }

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
        } catch (\Exception $e) {
            return $this->showError($e);
        }

    }
}
