<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TreatmentTypeResource\Pages;
use App\Filament\Resources\TreatmentTypeResource\RelationManagers;
use App\Models\TreatmentType;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TreatmentTypeResource extends Resource
{
    protected static ?string $model = TreatmentType::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required()->label("Tindakan Medis"),
                TextInput::make('cost')->required()->label("Biaya Tindakan")->integer(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label("Tindakan Medis"),
                TextColumn::make('cost')->money('idr')->label("Biaya Tindakan"),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTreatmentTypes::route('/'),
        ];
    }
}
