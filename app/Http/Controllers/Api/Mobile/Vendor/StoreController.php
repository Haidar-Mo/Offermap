<?php

namespace App\Http\Controllers\Api\Mobile\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Mobile\StoreCreateRequest;
use App\Http\Requests\Api\V1\Mobile\StoreUpdateRequest;
use App\Services\Mobile\StoreService;
use App\Traits\ResponseTrait;

class StoreController extends Controller
{
    use ResponseTrait;

    public function __construct(public StoreService $service)
    {
    }

    public function show()
    {
        try {
            $store = auth()->user()
                ->store()?->with('branches')->get();
            return $this->showResponse($store, 'تم جلب المتجر بنجاح', 200);
        } catch (\Exception $e) {
            return $this->showError($e, 'حدث خطأ أثناء عرض تفاصيل المتجر');
        }
    }


    public function store(StoreCreateRequest $request)
    {
        try {
            $store = $this->service->store($request);
            return $this->showResponse($store, 'تم إنشاء المتجر بنجاح');
        } catch (\Exception $e) {
            return $this->showError($e, 'حدث خطأ أثناء إنشاء المتجر');
        }
    }


    public function update(StoreUpdateRequest $request)
    {
        try {
            $store = $this->service->update($request);
            return $this->showResponse($store, 'تم تعديل بيانات المتجر بنجاح');
        } catch (\Exception $e) {
            return $this->showError($e, 'حدث خطأ ما أثناء تعديل بيانات المتجر');
        }
    }

    public function destroy()
    {
        try {
            $this->service->destroy();
            return $this->showMessage('تم حذف المتجر بنجاح', 200);
        } catch (\Exception $e) {
            return $this->showError($e, 'حدث خطأ أثناء حذف المتجر');
        }
    }
}
