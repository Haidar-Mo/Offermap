<?php

namespace App\Http\Controllers\Api\Mobile;

use App\Enums\OrderStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Models\Branch;
use App\Models\OrderHistory;
use App\Traits\ResponseTrait;
use Illuminate\Support\Facades\DB;

class HomePageController extends Controller
{
    use ResponseTrait;

    public function getNearbyBranches()
    {
        $lat = (float) request()->input('latitude');
        $lng = (float) request()->input('longitude');
        $distance = (int) request()->input('distance');
        // Earth's radius in km

        $branches = Branch::whereHas('advertisements')->whereRaw(
            "6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude))) <= ?",
            [$lat, $lng, $lat, $distance]
        )->get();

        return $this->showResponse($branches, "تم عرض المتاجر القريبة على بعد $distance كيلومتر ");
    }

    public function getBranchAdvertisements(string $id)
    {
        $branch = Branch::with(['advertisements.media'])->findOrFail($id);
        return $this->showResponse($branch, 'تم جلب إعلانات الفرع بنجاح');
    }

    public function getAdvertisementDetails(string $id)
    {
        $advertisement = Advertisement::with(['media', 'branch.rates'])
            ->withCount('views')
            ->findOrFail($id)->append(['end_date_format']);
        return $this->showResponse($advertisement, 'تم جلب تفاصيل الإعلان بنجاح');
    }

    public function orderAdvertisement(string $id)
    {
        $advertisement = Advertisement::findOrFail($id);
        if ($advertisement->end_date < now())
            return $this->showMessage('هذا الإعلان منتهي الصلاحية', 400);
        $order = DB::transaction(function () use ($advertisement) {
            return OrderHistory::create([
                'advertisement_id' => $advertisement->id,
                'user_id' => auth()->user()->id,
                'branch_id' => $advertisement->branch_id,
                'status' => OrderStatusEnum::NEW ,
            ]);
        });
        $order->load(['advertisement.media']);
        return $this->showResponse($order, 'تم إرسال طلبك بنجاح');
    }


    public function getSimilarAdvertisement(string $id)
    {
        $advertisement = Advertisement::findOrFail($id);
        if ($advertisement->end_date < now())
            return $this->showMessage('هذا الإعلان منتهي الصلاحية', 400);

        $similar = Advertisement::whereHas('branch', function ($query) use ($advertisement) {
            $query->where('type', $advertisement->branch->type);
        })->paginate(10);

        return $this->showResponse($similar, 'تم جلب الإعلانات المشابهة بنجاح');
    }
}
