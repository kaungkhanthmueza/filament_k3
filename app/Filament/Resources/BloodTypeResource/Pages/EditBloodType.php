<?php

namespace App\Filament\Resources\BloodTypeResource\Pages;

use App\Filament\Resources\BloodTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBloodType extends EditRecord
{
    protected static string $resource = BloodTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
