<?php

namespace App\Filament\Kasir\Resources;

use App\Filament\Kasir\Resources\TreatmentResource\Pages;
use App\Filament\Kasir\Resources\TreatmentResource\RelationManagers;
use App\Models\Treatment;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
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
                TextInput::make('patient_name')->label('Nama Pasien')->readOnly(),
                Select::make('status')->label('Status Pendaftaran')->placeholder('Pilih Status Pembayaran')->required()->options([
                    '1' => 'Sudah Dibayar',
                    '0' => 'Belum Dibayar',
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('patient_name')->label("Nama Pasien")->searchable(),
                TextColumn::make('status')->label('Status Pembayaran')->formatStateUsing(fn ($state) => $state ? 'Belum Dibayar' : 'Sudah Dibayar'),
                TextColumn::make('cost')->label('Harga'),
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

    public static function getEloquentQuery(): Builder
    {
        $user = Filament::auth()->user();

        return parent::getEloquentQuery()
            ->where('cost', '>' ,0);
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
