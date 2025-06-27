<?php

namespace App\Http\Controllers\Api\Mobile\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Mobile\BranchCreateRequest;
use App\Http\Requests\Api\V1\Mobile\BranchUpdateRequest;
use App\Services\Mobile\BranchService;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    use ResponseTrait;

    public function __construct(public BranchService $service)
    {
    }

    public function index()
    {
        try {
            $branches = $this->service->index();
            return $this->showResponse($branches, 'تم جلب كل الفروع الخاصة بالمتجر');
        } catch (\Exception $e) {
            return $this->showError($e, 'حدث خطأ ما أثناء جلب الفروع الخاصة بالمتجر');
        }
    }

    public function show(string $id, Request $request)
    {
        try {
            $branch = $this->service->show($id, $request)
                ->latest()
                ->withCount(['views'])
                ->paginate(10)
                ->load(['media'])
                ->makeHidden('branch');
            return $this->showResponse($branch, 'تم جلب الفرع بنجاح');
        } catch (\Exception $e) {
            return $this->showError($e, 'حدث خطأ ما أثناء عرض معلومات الفرع');
        }
    }

    public function store(BranchCreateRequest $request)
    {
        try {
            $branch = $this->service->store($request);
            return $this->showResponse($branch, 'تم إضافة فرع إلى المتجر بنجاح ');
        } catch (\Exception $e) {
            return $this->showError($e, 'حدث خطأ ما أثناء إضافة الفرع');
        }
    }

    public function update(BranchUpdateRequest $request, string $id)
    {
        try {
            $branch = $this->service->update($request, $id);
            return $this->showResponse($branch, 'تم تعديل بيانات الفرع بنجاح ');
        } catch (\Exception $e) {
            return $this->showError($e, '');
        }
    }

    public function destroy(string $id)
    {
        try {
            $this->service->destroy($id);
            return $this->showMessage('تم حذف الفرع بنجاح', 200);
        } catch (\Exception $e) {
            return $this->showError($e, 'حدث خطأ أثناء حضف الفرع');
        }
    }
}
