<?php

namespace App\Http\Controllers\Api\Mobile\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Mobile\AdvertisementCreateRequest;
use App\Http\Requests\Api\V1\Mobile\AdvertisementUpdateRequest;
use App\Services\Mobile\Vendor\AdvertisementService;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    use ResponseTrait;

    public function __construct(protected AdvertisementService $service)
    {
    }

    public function index(Request $request)
    {
        try {
            $advertisements = $this->service->indexAllAdvertisements($request);
            return $this->showResponse($advertisements);
        } catch (\Exception $e) {
            return $this->showError($e);
        }
    }

    public function show(string $id)
    {
        try {
            $advertisement = $this->service->show($id);
            return $this->showResponse($advertisement);
        } catch (\Exception $e) {
            return $this->showError($e);
        }
    }


    public function store(AdvertisementCreateRequest $request)
    {
        try {
            $advertisement = $this->service->create($request);
            return $this->showResponse($advertisement);
        } catch (\Exception $e) {
            return $this->showError($e);
        }
    }

    public function update(AdvertisementUpdateRequest $request, string $id)
    {
        try {
            $advertisement = $this->service->update($request, $id);
            return $this->showResponse($advertisement);
        } catch (\Exception $e) {
            return $this->showError($e);
        }
    }


    public function destroy(string $id)
    {
        try {
            $this->service->delete($id);
            return $this->showMessage("Operation done");
        } catch (\Exception $e) {
            return $this->showError($e);
        }
    }
}
