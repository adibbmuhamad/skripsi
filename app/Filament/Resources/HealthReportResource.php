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
use Filament\Tables\Columns\DateColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
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
            DatePicker::make('report_date')
                ->label('Report Date')
                ->required(),
            Select::make('health_status')
                ->options([
                    'healthy' => 'Sehat',
                    'sick' => 'Sakit',
                    'recovering' => 'Dalam Pemulihan',
                ])
                ->label('Health Status')
                ->required(),
            Textarea::make('report')
                ->label('Health Report')
                ->required(),
            Textarea::make('symptoms')
                ->label('Symptoms'),
            Textarea::make('doctors_notes')
                ->label('Doctor\'s Notes'),
            FileUpload::make('attachments')
                ->label('Attachments'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            TextColumn::make('student.name')
                ->sortable()
                ->searchable(),
            TextColumn::make('student.classRoom.name')
                ->sortable()
                ->label('Class Room'),
            TextColumn::make('student.nisn')
                ->sortable()
                ->label('NISN')
                ->searchable(),
                TextColumn::make('report_date')
                ->label('Report Date')
                ->sortable()
                ->formatStateUsing(fn ($state) => \Carbon\Carbon::parse($state)->format('d-m-Y')), // Format tanggal
            TextColumn::make('health_status')
                ->label('Health Status')
                ->sortable(),
            TextColumn::make('report')->limit(50),
            TextColumn::make('symptoms')->limit(50),
            TextColumn::make('doctors_notes')->limit(50),
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
