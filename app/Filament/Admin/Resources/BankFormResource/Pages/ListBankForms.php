<?php

namespace App\Filament\Admin\Resources\BankFormResource\Pages;

use App\Filament\Admin\Resources\BankFormResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBankForms extends ListRecords
{
    protected static string $resource = BankFormResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
