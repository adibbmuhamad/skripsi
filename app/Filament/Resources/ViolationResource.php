<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Violation;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ViolationResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ViolationResource\RelationManagers;

class ViolationResource extends Resource
{
    protected static ?string $model = Violation::class;

    protected static ?string $navigationIcon = 'heroicon-o-x-circle';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Select::make('student_id')
                ->relationship('student', 'name')
                ->label('Student')
                ->required(),
            TextInput::make('violation_type')
                ->label('Violation Type')
                ->required(),
            Textarea::make('description')
                ->label('Description')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('student.name')
                ->sortable()
                ->searchable(),
                TextColumn::make('student.classRoom.name') // Perbaiki akses ke relasi classRoom
                ->sortable()
                ->label('Class Room'),
                TextColumn::make('student.nisn')
                ->sortable()
                ->label('NISN')
                ->searchable(),
                TextColumn::make('violation_type')->sortable(),
                TextColumn::make('description')->limit(50),
            ])
            ->filters([
            SelectFilter::make('class_room_id') // Filter berdasarkan class room
                ->relationship('student.classRoom', 'name')
                ->label('Class Room'),
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
            'index' => Pages\ListViolations::route('/'),
            'create' => Pages\CreateViolation::route('/create'),
            'edit' => Pages\EditViolation::route('/{record}/edit'),
        ];
    }
}
