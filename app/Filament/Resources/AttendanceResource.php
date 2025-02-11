<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AttendanceResource\Pages;
use App\Filament\Resources\AttendanceResource\RelationManagers;
use App\Models\Attendance;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;

class AttendanceResource extends Resource
{
    protected static ?string $model = Attendance::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Select::make('student_id')
                ->relationship('student', 'name')
                ->label('Student')
                ->required(),
            DatePicker::make('date')
                ->label('Date')
                ->required(),
            Select::make('status')
                ->options([
                    'present' => 'Present',
                    'absent' => 'Absent',
                    'permission' => 'Permission'
                ])
                ->label('Status')
                ->required(),
            Textarea::make('permission_reason') // Alasan izin
                ->label('Permission Reason')
                ->visible(fn ($get) => $get('status') === 'permission') // Tampilkan hanya jika status = izin
                ->required(fn ($get) => $get('status') === 'permission'), // Wajib diisi jika status izin
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('student.name')->sortable(),
                TextColumn::make('status')->sortable(),
                TextColumn::make('date')->sortable(),
                TextColumn::make('permission_reason') // Menampilkan alasan izin di tabel
                ->visible(fn ($record) => optional($record)->status === 'permission'), // Menggunakan optional untuk mencegah error null
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
            'index' => Pages\ListAttendances::route('/'),
            'create' => Pages\CreateAttendance::route('/create'),
            'edit' => Pages\EditAttendance::route('/{record}/edit'),
        ];
    }
}
