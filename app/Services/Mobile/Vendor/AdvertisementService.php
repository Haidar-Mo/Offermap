<?php

namespace App\Services\Mobile\Vendor;

use App\Enums\PathsEnum;
use App\Models\Advertisement;
use App\Traits\HasFiles;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class AdvertisementService.
 */
class AdvertisementService
{

    use HasFiles;


    public function indexAllAdvertisements(Request $request)
    {
        $store = auth()->user()->store()->first();
        if (!$store)
            throw new \Exception("you do not have a store yet", 400);

        $branchIds = $store->branches()->pluck('id');

        return Advertisement::whereIn('branch_id', $branchIds)
            ->with(['media', 'branch'])
            ->withCount('views')
            ->paginate(10)
            ->through(function ($ad) {
                $ad->branch->makeHidden(['store']);
                return $ad;
            });
    }


    public function show(string $id)
    {
        $store = auth()->user()->store()->first();
        $branchIds = $store->branches()->pluck('id');
        $advertisement = Advertisement::with(['media', 'branch'])
            ->whereIn('branch_id', $branchIds)
            ->where('id', '=', $id)
            ->withCount('views')
            ->first();

        $advertisement->branch->makeHidden(['store']);
        return $advertisement->append(['branch_name']);
    }


    public function create(FormRequest $request)
    {
        $data = $request->validated();
        return DB::transaction(function () use ($request, $data) {

            $advertisement = Advertisement::create($data);

            if ($request->has('media') && is_array($request->media)) {
                foreach ($request->media as $media) {
                    $path = $this->saveFile($media, PathsEnum::ADVERTISEMENT->value);
                    $advertisement->media()->create([
                        'path' => $path
                    ]);
                }
            }

            return $advertisement->makeHidden(['branch'])->load(['media']);
        });
    }


    public function update(FormRequest $request, string $id)
    {
        $data = $request->validated();
        $store = auth()->user()->store()->first();
        $branchIds = $store->branches()->pluck('id');
        $advertisement = Advertisement::whereIn('branch_id', $branchIds)->where('id', '=', $id)->first();

        return DB::transaction(function () use ($request, $data, $advertisement) {

            $advertisement->update($data);

            // if ($request->has('media') && is_array($request->media)) {
            //     foreach ($request->media as $media) {
            //         $path = $this->saveFile($media, PathsEnum::ADVERTISEMENT->value);

            //         $advertisement->media()->create([
            //             'path' => $path
            //         ]);
            //     }
            // }

            return $advertisement->makeHidden(['branch'])->load(['media']);
        });
    }



    public function delete(string $id)
    {
        $store = auth()->user()->store()->first();
        $branchIds = $store->branches()->pluck('id');
        Advertisement::whereIn('branch_id', $branchIds)->where('id', '=', $id)?->delete();
    }
}
