<?php

namespace App\Filament\Petugas\Resources\TreatmentResource\Pages;

use App\Filament\Petugas\Resources\TreatmentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTreatment extends EditRecord
{
    protected static string $resource = TreatmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
