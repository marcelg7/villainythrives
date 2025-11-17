<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class RevenueChart extends ChartWidget
{
    protected static ?string $heading = 'Revenue Overview';

    protected static ?int $sort = 2;

    protected function getData(): array
    {
        // Get revenue for the last 12 months
        $data = Order::select(
            DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
            DB::raw('SUM(total) as revenue')
        )
            ->where('created_at', '>=', now()->subMonths(12))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $labels = [];
        $revenues = [];

        // Fill in all 12 months
        for ($i = 11; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $monthKey = $month->format('Y-m');
            $labels[] = $month->format('M Y');

            // Find revenue for this month
            $monthData = $data->firstWhere('month', $monthKey);
            $revenues[] = $monthData ? (float) $monthData->revenue : 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Revenue (CAD)',
                    'data' => $revenues,
                    'backgroundColor' => 'rgba(239, 68, 68, 0.1)',
                    'borderColor' => 'rgb(239, 68, 68)',
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
