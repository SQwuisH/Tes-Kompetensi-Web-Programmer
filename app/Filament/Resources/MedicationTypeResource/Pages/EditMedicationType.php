<?php

namespace App\Filament\Resources\MedicationTypeResource\Pages;

use App\Filament\Resources\MedicationTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMedicationType extends EditRecord
{
    protected static string $resource = MedicationTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
