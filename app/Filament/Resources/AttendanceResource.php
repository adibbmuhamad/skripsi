<?php

namespace App\Filament\Resources;

use Carbon\Carbon;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Attendance;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Exports\AttendancesExport;
use Filament\Tables\Actions\Action;
use Maatwebsite\Excel\Facades\Excel;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TimePicker;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\AttendanceResource\Pages;
use App\Filament\Resources\AttendanceResource\RelationManagers;


class AttendanceResource extends Resource
{
    protected static ?string $model = Attendance::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Select::make('student_id')
                ->relationship('student', 'name')
                ->label('Student')
                ->required()
                ->searchable() // Tambahkan pencarian
                ->preload(), // Load opsi lebih awal
            TimePicker::make('clock_in')
                ->label('Clock In')
                ->required(),
            TimePicker::make('clock_out')
                ->label('Clock Out')
                ->required(fn ($get) => $get('status') === 'present'), // Required only if status is 'present'
            DatePicker::make('date')
                ->label('Date')
                ->required()
                ->default(now()), // Tanggal default
            Select::make('status')
                ->options([
                    'present' => 'Present',
                    'absent' => 'Absent',
                    'permission' => 'Permission'
                ])
                ->label('Status')
                ->required()
                ->live(), // Auto-update form saat status berubah
            Textarea::make('permission_reason') // Alasan izin
                ->label('Permission Reason')
                ->visible(fn ($get) => $get('status') === 'permission') // Tampilkan hanya jika status = izin
                ->required(fn ($get) => $get('status') === 'permission') // Wajib diisi jika status izin
                ->columnSpanFull(), // Menggunakan full width
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            TextColumn::make('student.name')
                ->sortable()
                ->searchable()
                ->label('Student Name'),
            TextColumn::make('status')
                ->sortable()
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'present' => 'success',
                    'absent' => 'danger',
                    'permission' => 'warning',
                }),
            TextColumn::make('student.classRoom.name') // Perbaiki akses ke relasi classRoom
                    ->sortable()
                    ->label('Class Room'),
                    TextColumn::make('clock_in')
                    ->sortable()
                    ->label('Clock In')
                    ->time('H:i'),
                TextColumn::make('clock_out')
                    ->sortable()
                    ->label('Clock Out')
                    ->time('H:i'),
            TextColumn::make('date')
                ->sortable()
                ->date('d M Y'),
            TextColumn::make('student.address')
                ->label('Address')
                ->limit(30)
                ->tooltip(function ($record) {
                    return $record->student->address ?? '';
                }),

            TextColumn::make('permission_reason')
                ->label('Permission Reason')
                ->visible(fn ($record) => $record?->status === 'permission')
                ->limit(30)
                ->tooltip(function ($record) {
                    return $record->permission_reason ?? '';
                }),
            ])
            ->filters([
                Tables\Filters\Filter::make('today')
                ->label('Today')
                ->query(fn (Builder $query): Builder => $query->whereDate('date', Carbon::today())),

                Tables\Filters\Filter::make('this_week')
                ->label('This Week')
                ->query(fn (Builder $query): Builder => $query->whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])),
                SelectFilter::make('class_room_id') // Filter berdasarkan class room
                ->relationship('student.classRoom', 'name')
                ->label('Class Room'),
                SelectFilter::make('month')
                    ->label('Filter by Month')
                    ->options([
                        '01' => 'January',
                        '02' => 'February',
                        '03' => 'March',
                        '04' => 'April',
                        '05' => 'May',
                        '06' => 'June',
                        '07' => 'July',
                        '08' => 'August',
                        '09' => 'September',
                        '10' => 'October',
                        '11' => 'November',
                        '12' => 'December',
                    ])
                    ->query(function (Builder $query, $data) {
                        if ($data['value']) {
                            $query->whereMonth('date', $data['value']);
                        }
                    }),
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'present' => 'Present',
                        'absent' => 'Absent',
                        'permission' => 'Permission',
                    ]),

                    // Filter Tanggal Baru
            Tables\Filters\Filter::make('date')
            ->form([
                DatePicker::make('start_date'),
                DatePicker::make('end_date'),
            ])
            ->query(function (Builder $query, array $data): Builder {
                return $query
                    ->when(
                        $data['start_date'],
                        fn ($query) => $query->whereDate('date', '>=', $data['start_date'])
                    )
                    ->when(
                        $data['end_date'],
                        fn ($query) => $query->whereDate('date', '<=', $data['end_date'])
                    );
            })
            ->indicateUsing(function (array $data): array {
                $indicators = [];
                if ($data['start_date'] ?? null) {
                    $indicators[] = 'Start: ' . Carbon::parse($data['start_date'])->toFormattedDateString();
                }
                if ($data['end_date'] ?? null) {
                    $indicators[] = 'End: ' . Carbon::parse($data['end_date'])->toFormattedDateString();
                }
                return $indicators;
            }),
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
                        return Excel::download(new AttendancesExport($filteredData), 'filtered_attendances.xlsx');
                    })
                    ->requiresConfirmation(),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->with(['student']) // Eager loading untuk optimasi query
            ->latest('date'); // Urutkan berdasarkan tanggal terbaru
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
