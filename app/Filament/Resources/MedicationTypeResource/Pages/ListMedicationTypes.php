<?php

namespace App\Filament\Resources\MedicationTypeResource\Pages;

use App\Filament\Resources\MedicationTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMedicationTypes extends ListRecords
{
    protected static string $resource = MedicationTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
