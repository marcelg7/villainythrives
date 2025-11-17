<?php

namespace App\Filament\Widgets;

use App\Models\Expense;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ExpenseStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        // Total expenses (all time)
        $totalExpenses = Expense::sum('amount');

        // Expenses this month
        $monthlyExpenses = Expense::whereMonth('expense_date', now()->month)
            ->whereYear('expense_date', now()->year)
            ->sum('amount');

        // Expenses today
        $todayExpenses = Expense::whereDate('expense_date', today())
            ->sum('amount');

        return [
            Stat::make('Total Expenses', '$' . number_format($totalExpenses, 2))
                ->description('All time expenses')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger'),

            Stat::make('Monthly Expenses', '$' . number_format($monthlyExpenses, 2))
                ->description('Expenses this month')
                ->descriptionIcon('heroicon-m-calendar')
                ->color('warning'),

            Stat::make('Today\'s Expenses', '$' . number_format($todayExpenses, 2))
                ->description('Expenses today')
                ->descriptionIcon('heroicon-m-clock')
                ->color('info'),
        ];
    }
}
