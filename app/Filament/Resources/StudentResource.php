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
            Select::make('class')
                ->label('Class')
                ->required()
                ->options([ // Menambahkan opsi kelas
                    '7A' => '7A',
                    '7B' => '7B',
                    '8A' => '8A',
                    '8B' => '8B',
                    '9A' => '9A',
                    '9B' => '9B',
                ]),
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
                TextColumn::make('name')->sortable(),
                TextColumn::make('class')->sortable(),
                TextColumn::make('parent_email')->sortable(),
                TextColumn::make('nisn')->sortable(),
                TextColumn::make('address')->limit(50),
            ])
            ->filters([
                SelectFilter::make('class') // Menambahkan filter berdasarkan kelas
                ->options([
                    '7A' => '7A',
                    '7B' => '7B',
                    '8A' => '8A',
                    '8B' => '8B',
                    '9A' => '9A',
                    '9B' => '9B',
                ]),
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
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }
}
