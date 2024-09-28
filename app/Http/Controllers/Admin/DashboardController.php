<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Laravel\Cashier\Subscription;

class DashboardController extends Controller
{
    public function index()
    {

        return inertia('Admin/Dashboard', [
            'stats' => [
                'new_registrations' => [
                    'value' => 10,
                    'change' => 10,
                ],
                'active_subscriptions' => [
                    'value' => 10,
                    'change' => 10,
                ],
                'inactive_subscriptions' => [
                    'value' => 10,
                    'change' => 10,
                ],
                'total_revenue' => [
                    'value' => 10,
                    'change' => 10,
                ],
            ],
            'charts' => [
                'registrations_over_time' => [
                    'current_year' => [
                        'months' => 10,
                        'count' => 10,
                    ],
                ],
                'subscriptions_trend' => [
                    'active_subscriptions' => [
                        'months' => 10,
                        'count' => 10,
                    ],
                    // 'inactive_subscriptions' => [
                    //     "months" => 10,
                    //     "count" => 10,
                    // ]
                ],
                'revenue_breakdown' => [
                    'current_year' => [
                        'months' => 10,
                        'amount' => 10,
                    ],
                    'last_year' => [
                        'months' => 10,
                        'amount' => 10,
                    ],
                ],
            ],
        ]);
    }

    private function calculatePercentageChange($current, $previous)
    {
        $percentage = 0;

        if ($previous > 0) {
            $percentage = (($current - $previous) / $previous) * 100;
        }

        return round(max(min($percentage, 100), -100), 2);
    }
}
