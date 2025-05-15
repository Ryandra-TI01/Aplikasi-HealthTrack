<?php

namespace App\Http\Controllers;

use App\Models\HealthRecord;
use App\Models\HealthType;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class HealthMonitoringPdfController extends Controller
{
public function export(Request $request)
{
    $request->validate([
        'start_date' => 'required|date',
        'end_date'   => 'required|date|after_or_equal:start_date',
        'types'      => 'required|array',
    ]);

    $data = [];
    $healthTypes = HealthType::whereIn('id', $request->types)->get();

    foreach ($healthTypes as $type) {
        $records = HealthRecord::where('user_id', auth()->id())
            ->where('health_type_id', $type->id)
            ->whereBetween('recorded_at', [$request->start_date, $request->end_date])
            ->orderBy('recorded_at')
            ->get();

        $labels = $records->pluck('recorded_at')->map(function ($date) {
            return \Carbon\Carbon::parse($date)->format('d M');
        })->toArray();

        $values = $records->pluck('value')->map(function ($value) {
            return is_numeric($value) ? (float) $value : null;
        })->filter()->values()->toArray();

        // Default chart image
        $chartBase64 = null;

        if (count($labels) && count($values)) {
            $chartData = [
                'type' => 'line',
                'data' => [
                    'labels' => $labels,
                    'datasets' => [[
                        'label' => $type->name,
                        'data' => $values,
                        'borderColor' => '#2D805A',
                        'backgroundColor' => 'rgba(45, 128, 90, 0.2)',
                        'fill' => true,
                        'tension' => 0.4,
                    ]],
                ],
                'options' => [
                    'plugins' => [
                        'legend' => ['display' => false]
                    ],
                    'scales' => [
                        'y' => ['beginAtZero' => true]
                    ]
                ]
            ];

            $chartUrl = 'https://quickchart.io/chart?width=600&height=300&c=' . urlencode(json_encode($chartData));
            $imageContent = file_get_contents($chartUrl);
            $chartBase64 = 'data:image/png;base64,' . base64_encode($imageContent);
        }

        $data[] = [
            'type'         => $type,
            'records'      => $records,
            'chart_base64' => $chartBase64,
        ];
    }

    $pdf = Pdf::loadView('livewire.health-record.pdf', [
        'data'       => $data,
        'start_date' => $request->start_date,
        'end_date'   => $request->end_date,
    ]);

    return $pdf->download('health-record.pdf');
}
}
