<?php

namespace App\Filament\Resources\TreatmentTypeResource\Pages;

use App\Filament\Resources\TreatmentTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTreatmentType extends EditRecord
{
    protected static string $resource = TreatmentTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
