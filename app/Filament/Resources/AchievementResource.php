<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\ClassRoom;
use Filament\Tables\Table;
use App\Models\Achievement;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\AchievementResource\Pages;
use App\Filament\Resources\AchievementResource\RelationManagers;

class AchievementResource extends Resource
{
    protected static ?string $model = Achievement::class;

    protected static ?string $navigationIcon = 'heroicon-o-trophy';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Select::make('student_id')
                ->relationship('student', 'name')
                ->label('Student')
                ->required(),
            TextInput::make('achievement_name')
                ->label('Category')
                ->required(),
            Textarea::make('description')
                ->label('Description')
                ->required(),
            DatePicker::make('date') // Tambahkan kolom tanggal
                ->label('Date')
                ->required()
                ->default(now()), // Tanggal default
            FileUpload::make('photo') // Menambahkan kolom foto
                ->label('Photo')
                ->image() // Tipe file gambar
                ->disk('public') // Tentukan disk untuk penyimpanan (pastikan konfigurasi sudah ada di `config/filesystems.php`)
                ->directory('achievements') // Folder tempat foto disimpan
                ->required(), // Pastikan foto diupload
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
                TextColumn::make('achievement_name')
                    ->label('Category')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('description')
                ->limit(50)
                ->searchable(),
                TextColumn::make('date') // Tambahkan kolom tanggal
                ->sortable()
                ->date('d M Y'), // Format tanggal
                TextColumn::make('photo')->formatStateUsing(fn ($state) => $state ? "<img src='/storage/{$state}' alt='Photo' class='w-20 h-20'>" : 'No photo')
                ->html() // Menampilkan foto pada kolom tabel
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
            'index' => Pages\ListAchievements::route('/'),
            'create' => Pages\CreateAchievement::route('/create'),
            'edit' => Pages\EditAchievement::route('/{record}/edit'),
        ];
    }
}
