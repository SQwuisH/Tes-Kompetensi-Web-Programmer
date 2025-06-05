<?php

namespace App\Filament\Dokter\Resources;

use App\Filament\Dokter\Resources\TreatmentResource\Pages;
use App\Filament\Dokter\Resources\TreatmentResource\RelationManagers;
use App\Models\Medication;
use App\Models\Treatment;
use App\Models\TreatmentType;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TreatmentResource extends Resource
{
    protected static ?string $model = Treatment::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                TextInput::make('patient_name')
                    ->label('Nama Pasien')
                    ->readOnly(),

                Select::make('treatment_type')
                    ->label('Tindakan')
                    ->options(TreatmentType::all()->pluck('name', 'id'))
                    ->searchable()
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set, callable $get) {
                        $treatmentTypeId = $get('treatment_type');
                        $medicationIds = $get('medication') ?? [];

                        $treatmentCost = $treatmentTypeId
                            ? TreatmentType::find($treatmentTypeId)?->cost ?? 0
                            : 0;

                        $medicationCost = Medication::whereIn('id', $medicationIds)->sum('cost');

                        $set('cost', $treatmentCost + $medicationCost);
                    }),

                Select::make('medication')
                    ->label('Obat')
                    ->multiple()
                    ->options(Medication::all()->pluck('name', 'id'))
                    ->searchable()
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set, callable $get) {
                        $treatmentTypeId = $get('treatment_type');
                        $medicationIds = $get('medication') ?? [];

                        $treatmentCost = $treatmentTypeId
                            ? TreatmentType::find($treatmentTypeId)?->cost ?? 0
                            : 0;

                        $medicationCost = Medication::whereIn('id', $medicationIds)->sum('cost');

                        $set('cost', $treatmentCost + $medicationCost);
                    }),

                TextInput::make('cost')
                    ->label('Biaya Total')
                    ->numeric()
                    ->readOnly()
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('patient_name')->label("Nama Pasien")->searchable(),
                TextColumn::make('TreatmentType.name')->label("Tindakan Medis"),
                TextColumn::make('medication')->label("Obat")->formatStateUsing(function ($state) {
                    if (!is_array($state)) {
                        $state = json_decode($state, true); // ensure it's an array
                    }

                    if (empty($state)) {
                        return '-';
                    }

                    return Medication::whereIn('id', $state)->pluck('name')->join(', ');
                }),
            ])
            ->filters([
                Filter::make('Selesai')->query(fn(Builder $query): Builder => $query->where('treatment_type', true)),
                Filter::make('Belum Selesai')->query(fn(Builder $query): Builder => $query->where('treatment_type', false))->default(),
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

    public static function getEloquentQuery(): Builder
    {
        $user = Filament::auth()->user();

        return parent::getEloquentQuery()
            ->where('doctor_id', $user->id);
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
            'index' => Pages\ListTreatments::route('/'),
        ];
    }
}
