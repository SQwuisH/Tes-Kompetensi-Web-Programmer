<?php

namespace App\Filament\Dokter\Widgets;

use App\Models\Treatment;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class dokterVisitorStat extends BaseWidget
{
    protected function getStats(): array
    {
        for($i = 6; $i >=0; $i--)
        {
            $pasien[] = Treatment::where('created_at', 'like', date('Y-m-d', strtotime("-$i days")) . "%%")->count();
        }
        return [
            Stat::make('Pasien', Treatment::where('created_at', 'like', date('Y-m-d') . "%%")->count())
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->chart($pasien),
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
