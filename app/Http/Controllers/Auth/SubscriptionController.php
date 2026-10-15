<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\DiscountCoupon;
use App\Models\Subscription;
use App\Models\SubscriptionPlan;
use App\Models\SubscriptionTransaction;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class SubscriptionController extends Controller
{
    /**
     * ثبت‌نام مدیر با کد تخفیف ۱۰۰ درصدی.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'phone' => ['required', 'string', 'max:20', 'unique:users,phone'],

            'password' => ['required', 'string', 'min:8', 'confirmed'],

            'building_name' => ['required', 'string', 'max:255'],
            'building_address' => ['required', 'string'],

            'human_verification' => ['accepted'],

            'discount_code' => ['required', 'string', 'max:100'],
        ]);

        /*
         * بررسی کد تخفیف
         */
        $coupon = DiscountCoupon::where('code', $validated['discount_code'])
            ->where('is_active', true)
            ->first();

        if (!$coupon) {
            throw ValidationException::withMessages([
                'discount_code' => 'کد تخفیف واردشده معتبر نیست.',
            ]);
        }

        if ($coupon->starts_at && now()->lt($coupon->starts_at)) {
            throw ValidationException::withMessages([
                'discount_code' => 'این کد تخفیف هنوز فعال نشده است.',
            ]);
        }

        if ($coupon->expires_at && now()->gt($coupon->expires_at)) {
            throw ValidationException::withMessages([
                'discount_code' => 'مهلت استفاده از این کد تخفیف به پایان رسیده است.',
            ]);
        }

        if (
            $coupon->usage_limit !== null &&
            $coupon->used_count >= $coupon->usage_limit
        ) {
            throw ValidationException::withMessages([
                'discount_code' => 'ظرفیت استفاده از این کد تخفیف به پایان رسیده است.',
            ]);
        }

        /*
         * فعلاً فقط کدهای ۱۰۰ درصدی
         * امکان فعال‌سازی اشتراک دارند.
         */
        if ($coupon->discount_percent < 100) {
            return redirect()
                ->route('home')
                ->with(
                    'error',
                    'در حال حاضر شرایط خرید اشتراک برای شما مهیا نمی‌باشد.'
                );
        }

        /*
         * دریافت پلن یک‌ساله فعال
         */
        $plan = SubscriptionPlan::where('is_active', true)
            ->where('duration_days', 365)
            ->first();

        if (!$plan) {
            return redirect()
                ->route('home')
                ->with(
                    'error',
                    'در حال حاضر شرایط خرید اشتراک برای شما مهیا نمی‌باشد.'
                );
        }

        /*
         * ایجاد مدیر، ساختمان، اشتراک و تراکنش
         */
        $user = DB::transaction(function () use (
            $validated,
            $coupon,
            $plan
        ) {
            /*
             * ایجاد مدیر
             */
            $user = User::create([
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'phone' => $validated['phone'],
                'password' => $validated['password'],
            ]);

            /*
             * ایجاد ساختمان
             *
             * اطلاعات تکمیلی ساختمان در مرحله بعد
             * در صفحه building-create تکمیل می‌شود.
             */
            Building::create([
                'manager_id' => $user->id,
                'name' => $validated['building_name'],
                'address' => $validated['building_address'],
            ]);

            /*
             * ایجاد اشتراک فعال
             */
            $startsAt = today();
            $endsAt = today()->addDays($plan->duration_days - 1);

            $subscription = Subscription::create([
                'user_id' => $user->id,
                'subscription_plan_id' => $plan->id,
                'starts_at' => $startsAt,
                'ends_at' => $endsAt,
                'status' => 'active',
            ]);

            /*
             * ثبت تراکنش با تخفیف ۱۰۰ درصدی
             */
            SubscriptionTransaction::create([
                'subscription_id' => $subscription->id,
                'user_id' => $user->id,
                'discount_coupon_id' => $coupon->id,

                'amount' => $plan->price,

                'discount_code' => $coupon->code,
                'discount_percent' => $coupon->discount_percent,
                'discount_amount' => $plan->price,

                'final_amount' => 0,

                'status' => 'paid',

                'paid_at' => now(),

                'description' => 'فعال‌سازی اشتراک با کد تخفیف ۱۰۰ درصدی.',
            ]);

            /*
             * ثبت استفاده از کد تخفیف
             */
            $coupon->increment('used_count');

            return $user;
        });

        /*
         * ورود خودکار مدیر
         */
        auth()->login($user);

        $request->session()->regenerate();

        /*
         * انتقال به صفحه تکمیل اطلاعات ساختمان
         */
        return redirect()
            ->route('building.create')
            ->with('success', 'اشتراک شما با موفقیت فعال شد.');
    }

    /**
     * بررسی کد تخفیف بدون ثبت‌نام.
     */
    public function checkCoupon(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'discount_code' => ['required', 'string', 'max:100'],
        ]);

        $coupon = DiscountCoupon::where('code', $validated['discount_code'])
            ->where('is_active', true)
            ->first();

        if (!$coupon) {
            return response()->json([
                'success' => false,
                'message' => 'کد تخفیف واردشده معتبر نیست.',
            ], 422);
        }

        if ($coupon->starts_at && now()->lt($coupon->starts_at)) {
            return response()->json([
                'success' => false,
                'message' => 'این کد تخفیف هنوز فعال نشده است.',
            ], 422);
        }

        if ($coupon->expires_at && now()->gt($coupon->expires_at)) {
            return response()->json([
                'success' => false,
                'message' => 'مهلت استفاده از این کد تخفیف به پایان رسیده است.',
            ], 422);
        }

        if (
            $coupon->usage_limit !== null &&
            $coupon->used_count >= $coupon->usage_limit
        ) {
            return response()->json([
                'success' => false,
                'message' => 'ظرفیت استفاده از این کد تخفیف به پایان رسیده است.',
            ], 422);
        }

        return response()->json([
            'success' => true,
            'message' => "کد تخفیف با موفقیت اعمال شد. {$coupon->discount_percent}٪ تخفیف.",
            'discount_percent' => $coupon->discount_percent,
        ]);
    }
}