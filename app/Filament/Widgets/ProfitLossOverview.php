<?php

namespace App\Filament\Widgets;

use App\Models\Expense;
use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ProfitLossOverview extends BaseWidget
{
    protected static ?int $sort = 3;

    protected function getStats(): array
    {
        // Monthly calculations
        $monthlyRevenue = Order::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('total');

        $monthlyExpenses = Expense::whereMonth('expense_date', now()->month)
            ->whereYear('expense_date', now()->year)
            ->sum('amount');

        $monthlyProfit = $monthlyRevenue - $monthlyExpenses;

        // All time calculations
        $totalRevenue = Order::sum('total');
        $totalExpenses = Expense::sum('amount');
        $totalProfit = $totalRevenue - $totalExpenses;

        // Today calculations
        $todayRevenue = Order::whereDate('created_at', today())->sum('total');
        $todayExpenses = Expense::whereDate('expense_date', today())->sum('amount');
        $todayProfit = $todayRevenue - $todayExpenses;

        return [
            Stat::make('Monthly Profit/Loss', '$' . number_format($monthlyProfit, 2))
                ->description('Revenue - Expenses this month')
                ->descriptionIcon($monthlyProfit >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->color($monthlyProfit >= 0 ? 'success' : 'danger'),

            Stat::make('Total Profit/Loss', '$' . number_format($totalProfit, 2))
                ->description('All time net profit')
                ->descriptionIcon($totalProfit >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->color($totalProfit >= 0 ? 'success' : 'danger'),

            Stat::make('Today\'s Profit/Loss', '$' . number_format($todayProfit, 2))
                ->description('Net profit today')
                ->descriptionIcon($todayProfit >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->color($todayProfit >= 0 ? 'success' : 'danger'),
        ];
    }
}
