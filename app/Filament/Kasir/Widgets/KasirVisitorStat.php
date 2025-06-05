<?php

namespace App\Filament\Kasir\Widgets;

use App\Models\Treatment;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class KasirVisitorStat extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Pasien hari ini', Treatment::where('created_at', 'like', date('Y-m-d') . "%%")->count()),
            Stat::make('Tindakan Terbanyak', DB::table('treatment_types')
                ->where('id', function ($query) {
                    $query->select('treatment_type')
                        ->from('treatments')
                        ->groupBy('treatment_type')
                        ->orderByRaw('COUNT(*) DESC')
                        ->limit(1);
                })
                ->value('name')),
        ];
    }
}
