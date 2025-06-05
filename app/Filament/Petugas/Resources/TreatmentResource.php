<?php

namespace App\Filament\Petugas\Resources;

use App\Filament\Petugas\Resources\TreatmentResource\Pages;
use App\Filament\Petugas\Resources\TreatmentResource\RelationManagers;
use App\Models\Treatment;
use App\Models\User;
use App\Models\VisitType;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
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
                TextInput::make('patient_name')->label('Nama Pasien')->placeholder('Masukkan Nama Pasien')->required(),
                TextInput::make('patient_address')->label('Alamat Pasien')->placeholder('Masukkan Alamat Pasien')->required(),
                TextInput::make('patient_email')->label('Email Pasien')->placeholder('Masukkan Email Pasien')->required()->email(),
                Select::make('visit_type')->label('Tipe Kunjungan')->placeholder('Pilih Tipe Kunjungan')->options(VisitType::all()->pluck('name', 'id'))->searchable()->required(),
                Select::make('doctor_id')->label('Dokter')->placeholder('Pilih Dokter')->options(User::where('role', 'doctor')->pluck('name', 'id'))->searchable()->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('patient_name')->label("Nama Pasien"),
                TextColumn::make('VisitType.name')->label("Tipe Kunjungan"),
                TextColumn::make('Doctor.name')->label("Nama Dokter"),
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
            'index' => Pages\ListTreatments::route('/'),
        ];
    }
}
