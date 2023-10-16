<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NrcResource\Pages;
use App\Filament\Resources\NrcResource\RelationManagers;
use App\Models\Nrc;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;

class NrcResource extends Resource
{
    protected static ?string $model = Nrc::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('nrc_code')
                            ->label('NRC')
                            ->options(nrc::all()->pluck( 'nrc_code'))
                            ->searchable()->required(),
                Select::make('status')
                            ->options([
                                '/' => '/',

                            ]),
                Select::make('name_mm')
                            ->label('NRC_ENGLISH_NAME')
                            ->options(nrc::all()->pluck( 'name_en'))
                            ->searchable()->required(),
                Select::make('name_en')
                            ->label('NRC_MYANMAR_NAME')
                            ->options(nrc::all()->pluck('name_mm'))
                            ->searchable()->required(),

                Select::make('naing')
                            ->options([
                                '(N)' => '(N)',]),
                TextInput::make('nrc_date')->required(),

            ])->columns(6);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nrc_code'),
                TextColumn::make('name_en'),
                TextColumn::make('name_mm'),
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
            'index' => Pages\ListNrcs::route('/'),
            'create' => Pages\CreateNrc::route('/create'),
            'edit' => Pages\EditNrc::route('/{record}/edit'),
        ];
    }
}
