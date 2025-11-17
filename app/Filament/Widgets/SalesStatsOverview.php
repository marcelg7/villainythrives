<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class SalesStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        // Total revenue (all time)
        $totalRevenue = Order::sum('total');

        // Revenue this month
        $monthlyRevenue = Order::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('total');

        // Revenue today
        $todayRevenue = Order::whereDate('created_at', today())
            ->sum('total');

        // Total orders
        $totalOrders = Order::count();

        // Orders this month
        $monthlyOrders = Order::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        // Pending orders
        $pendingOrders = Order::where('status', 'pending')->count();

        return [
            Stat::make('Total Revenue', '$' . number_format($totalRevenue, 2))
                ->description('All time sales')
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->color('success'),

            Stat::make('Monthly Revenue', '$' . number_format($monthlyRevenue, 2))
                ->description('Revenue this month')
                ->descriptionIcon('heroicon-m-chart-bar')
                ->color('success'),

            Stat::make('Today\'s Revenue', '$' . number_format($todayRevenue, 2))
                ->description('Sales today')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('info'),

            Stat::make('Total Orders', number_format($totalOrders))
                ->description('All time orders')
                ->descriptionIcon('heroicon-m-shopping-cart')
                ->color('primary'),

            Stat::make('Monthly Orders', number_format($monthlyOrders))
                ->description('Orders this month')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('primary'),

            Stat::make('Pending Orders', number_format($pendingOrders))
                ->description('Awaiting payment')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),
        ];
    }
}
