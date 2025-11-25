<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KosResource\Pages;
use App\Filament\Resources\KosResource\RelationManagers;
use App\Models\Kos;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KosResource extends Resource
{
    protected static ?string $model = Kos::class;
    protected static ?string $navigationIcon = 'heroicon-o-home';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('manager_id')
                    ->label('Manager')
                    ->relationship('manager', 'name')
                    ->searchable()
                    ->required(),

                TextInput::make('name')->required()->maxLength(255),
                RichEditor::make('description')->required(),
                TextInput::make('address')->required(),
                TextInput::make('city')->required(),
                TextInput::make('price_start')->numeric()->required(),

                Repeater::make('facilities')
                    ->label('Facilities')
                    ->schema([
                        TextInput::make('value')->label('Facility')->required(),
                    ])
                    ->columnSpan('full')
                    ->createItemButtonLabel('Add facility')
                    ->disableLabel(),

                FileUpload::make('thumbnail')
                    ->label('Thumbnail')
                    ->image()
                    ->directory('kos-thumbnails')
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable()->label('ID'),
                TextColumn::make('manager.name')->label('Manager')->searchable(),
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('city')->sortable(),
                TextColumn::make('price_start')->money('idr', true),
                ImageColumn::make('thumbnail')->rounded(),
                TextColumn::make('created_at')->dateTime(),
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
            'index' => Pages\ListKos::route('/'),
            'create' => Pages\CreateKos::route('/create'),
            'edit' => Pages\EditKos::route('/{record}/edit'),
        ];
    }
}