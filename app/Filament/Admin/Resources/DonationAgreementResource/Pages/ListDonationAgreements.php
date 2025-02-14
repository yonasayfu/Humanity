<?php

namespace App\Filament\Admin\Resources\DonationAgreementResource\Pages;

use App\Filament\Admin\Resources\DonationAgreementResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDonationAgreements extends ListRecords
{
    protected static string $resource = DonationAgreementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
