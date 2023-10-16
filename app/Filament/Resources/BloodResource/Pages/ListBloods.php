<?php

namespace App\Filament\Resources\BloodResource\Pages;

use App\Filament\Resources\BloodResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBloods extends ListRecords
{
    protected static string $resource = BloodResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
