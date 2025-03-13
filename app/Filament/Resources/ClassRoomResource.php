<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClassRoomResource\Pages;
use App\Models\ClassRoom;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Forms\Components\TextInput;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class ClassRoomResource extends Resource
{
    protected static ?string $model = ClassRoom::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            TextInput::make('name')
                ->label('Class Room Name')
                ->required()
                ->unique(ClassRoom::class, 'name'),
            TextInput::make('room_number') // Tambahkan nomor ruangan
                ->label('Room Number')
                ->required(),
            TextInput::make('capacity') // Tambahkan kapasitas
                ->label('Capacity')
                ->required()
                ->numeric(), // Pastikan input adalah angka
            TextInput::make('class_teacher') // Tambahkan wali kelas
                ->label('Class Teacher')
                ->required(),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('room_number') // Tampilkan nomor ruangan
                    ->sortable()
                    ->label('Room Number'),
                TextColumn::make('capacity') // Tampilkan kapasitas
                    ->sortable()
                    ->label('Capacity'),
                TextColumn::make('class_teacher') // Tampilkan wali kelas
                    ->sortable()
                    ->label('Class Teacher'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClassRooms::route('/'),
            'create' => Pages\CreateClassRoom::route('/create'),
            'edit' => Pages\EditClassRoom::route('/{record}/edit'),
        ];
    }
}
