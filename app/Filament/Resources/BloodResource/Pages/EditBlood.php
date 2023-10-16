<?php

namespace App\Filament\Resources\BloodResource\Pages;

use App\Filament\Resources\BloodResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBlood extends EditRecord
{
    protected static string $resource = BloodResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
