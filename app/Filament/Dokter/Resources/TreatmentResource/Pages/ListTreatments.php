<?php

namespace App\Filament\Dokter\Resources\TreatmentResource\Pages;

use App\Filament\Dokter\Resources\TreatmentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTreatments extends ListRecords
{
    protected static string $resource = TreatmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
        ];
    }
}
