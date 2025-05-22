<?php

namespace App\Http\Controllers\Api\Mobile;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class PlanAndSubscriptionController extends Controller
{
    use ResponseTrait;
    public function indexPlans()
    {
        $plans = Plan::all();
        return $this->showResponse($plans, 'تم جلب كل الخطط بنجاح');
    }

    public function subscribeToPlan(string $id)
    {
        $plan = Plan::findOrFail($id);
        $user = auth()->user();
        if ($user->HasRunningSubscription())
            return $this->showMessage('انت بالفعل مشترك بباقة', 400, false);
        return auth()->user()->subscriptions()->create([
            'plan_id' => $plan->id,
            'status' => 'running',
            'starts_at' => now(),
            'ends_at' => now()->addDays($plan->duration),
            'number_of_remaining_ads' => $plan->size,
            'afford_price' => $plan->discount_price ?: $plan->price
        ]);

    }

    public function showSubscription()
    {
        $subscription = auth()->user()
            ->subscriptions()->with(['plan'])
            ->whereDate('ends_at', '>', now())
            ->latest()
            ->first();
        if (!$subscription)
            return $this->showMessage('عذراً انت لست مشترك بخطة حالياً', 400, false);
        return $this->showResponse($subscription, 'تم جلب نفاصيل الإشتراك الحالي');
    }

}
