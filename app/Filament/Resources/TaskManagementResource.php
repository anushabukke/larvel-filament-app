<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TaskManagementResource\Pages;
use App\Filament\Resources\TaskManagementResource\RelationManagers;
use App\Models\TaskManagement;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TaskManagementResource extends Resource
{
    protected static ?string $model = TaskManagement::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                TextInput::make('task')
                    ->required(),
                Select::make('priority')
                    ->options([
                        'low' => 'Low',
                        'medium' => 'Medium',
                        'high' => 'High',
                    ])
                    ->nullable(),
                DatePicker::make('deadline')
                    ->nullable(),
                Select::make('status')
                    ->options([
                        'not completed' => 'Not Completed',
                        'in progress' => 'In Progress',
                        'completed' => 'Completed',
                    ])
                    ->default('not completed'),
            ]);
    }
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('task'),
                TextColumn::make('priority')->sortable(),
                TextColumn::make('deadline')->date(),
                TextColumn::make('status')->sortable(),
                TextColumn::make('created_at')->dateTime(),
                TextColumn::make('updated_at')->dateTime(),
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
            'index' => Pages\ListTaskManagement::route('/'),
            'create' => Pages\CreateTaskManagement::route('/create'),
            'edit' => Pages\EditTaskManagement::route('/{record}/edit'),
        ];
    }
}
