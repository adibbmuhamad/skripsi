<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\HealthReport;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\HealthReportResource\Pages;
use App\Filament\Resources\HealthReportResource\RelationManagers;

class HealthReportResource extends Resource
{
    protected static ?string $model = HealthReport::class;

    protected static ?string $navigationIcon = 'heroicon-o-heart';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Select::make('student_id')
                ->relationship('student', 'name')
                ->label('Student')
                ->required(),
            Textarea::make('report')
                ->label('Health Report')
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
                TextColumn::make('report')->limit(50),
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
            'index' => Pages\ListHealthReports::route('/'),
            'create' => Pages\CreateHealthReport::route('/create'),
            'edit' => Pages\EditHealthReport::route('/{record}/edit'),
        ];
    }
}
