<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentResource\Pages;
use App\Filament\Resources\StudentResource\RelationManagers;
use App\Models\Student;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Filters\SelectFilter;
use App\Exports\StudentsExport;
use Maatwebsite\Excel\Facades\Excel;
use Filament\Tables\Actions\Action;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')
                ->label('Name')
                ->required(),
            Select::make('gender') // Tambahkan jenis kelamin
                ->label('Gender')
                ->options([
                    'male' => 'Male',
                    'female' => 'Female',
                ])
                ->required(),
            TextInput::make('parent_name') // Tambahkan nama orang tua
                ->label('Parent Name')
                ->required(),
            TextInput::make('phone_number') // Tambahkan nomor handphone
                ->label('Phone Number')
                ->required()
                ->maxLength(15), // Batasi panjang nomor handphone
            Select::make('class_room_id')
                ->label('Class Room')
                ->relationship('classRoom', 'name')
                ->required(),
            TextInput::make('parent_email')
                ->label('Parent Email')
                ->required()
                ->email(),
            TextInput::make('nisn')
                ->label('NISN')
                ->required()
                ->maxLength(10),
            Textarea::make('address')
                ->label('Address')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->sortable()
                    ->searchable(), // Aktifkan search untuk kolom name
                TextColumn::make('gender') // Tampilkan jenis kelamin
                    ->sortable()
                    ->searchable(),
                TextColumn::make('classRoom.name')
                    ->sortable()
                    ->label('Class Room'),
                TextColumn::make('parent_name') // Tampilkan nama orang tua
                    ->sortable()
                    ->searchable(),
                TextColumn::make('phone_number') // Tampilkan nomor handphone
                    ->sortable()
                    ->searchable(),
                TextColumn::make('parent_email')
                    ->sortable()
                    ->searchable(), // Aktifkan search untuk kolom parent_email
                TextColumn::make('nisn')
                    ->sortable()
                    ->searchable(), // Aktifkan search untuk kolom nisn
                TextColumn::make('address')
                    ->limit(50)
                    ->searchable(), // Aktifkan search untuk kolom address
            ])
            ->filters([
                SelectFilter::make('class_room_id')
                    ->relationship('classRoom', 'name')
                    ->label('Class Room'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->headerActions([
                Action::make('export')
                    ->label('Export Excel')
                    ->icon('heroicon-o-document-arrow-down')
                    ->action(function ($livewire) {
                        $filteredData = $livewire->getFilteredTableQuery()->get();
                        return Excel::download(new StudentsExport($filteredData), 'filtered_attendances.xlsx');
                    })
                    ->requiresConfirmation(),
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
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }
}
