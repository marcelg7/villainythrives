<?php

namespace App\Filament\Widgets;

use App\Models\Expense;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class ExpenseChart extends ChartWidget
{
    protected static ?string $heading = 'Expense Overview';

    protected static ?int $sort = 4;

    protected function getData(): array
    {
        // Get expenses for the last 12 months
        $data = Expense::select(
            DB::raw('DATE_FORMAT(expense_date, "%Y-%m") as month'),
            DB::raw('SUM(amount) as total')
        )
            ->where('expense_date', '>=', now()->subMonths(12))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $labels = [];
        $expenses = [];

        // Fill in all 12 months
        for ($i = 11; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $monthKey = $month->format('Y-m');
            $labels[] = $month->format('M Y');

            // Find expense for this month
            $monthData = $data->firstWhere('month', $monthKey);
            $expenses[] = $monthData ? (float) $monthData->total : 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Expenses (CAD)',
                    'data' => $expenses,
                    'backgroundColor' => 'rgba(245, 158, 11, 0.1)',
                    'borderColor' => 'rgb(245, 158, 11)',
                    'fill' => true,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
