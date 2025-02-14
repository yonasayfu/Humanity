<?php

namespace App\Filament\Admin\Resources\DonationAgreementResource\Pages;

use App\Filament\Admin\Resources\DonationAgreementResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDonationAgreement extends EditRecord
{
    protected static string $resource = DonationAgreementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
