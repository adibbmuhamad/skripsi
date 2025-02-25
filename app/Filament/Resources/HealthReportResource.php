<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HealthReportResource\Pages;
use App\Filament\Resources\HealthReportResource\RelationManagers;
use App\Models\HealthReport;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;

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
                TextColumn::make('student.class')
                ->sortable()
                ->label('Class'),
                TextColumn::make('student.nisn')
                ->sortable()
                ->label('NISN')
                ->searchable(),
                TextColumn::make('report')->limit(50),
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
            'index' => Pages\ListHealthReports::route('/'),
            'create' => Pages\CreateHealthReport::route('/create'),
            'edit' => Pages\EditHealthReport::route('/{record}/edit'),
        ];
    }
}
