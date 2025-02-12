<?php

namespace App\Filament\Admin\Resources\BankFormResource\Pages;

use App\Filament\Admin\Resources\BankFormResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBankForm extends EditRecord
{
    protected static string $resource = BankFormResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
