<?php

namespace App\Filament\Admin\Resources\DonationAgreementResource\Pages;

use App\Filament\Admin\Resources\DonationAgreementResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewDonationAgreement extends ViewRecord
{
    protected static string $resource = DonationAgreementResource::class;

    /**
     * Define the page actions.
     */

    // protected function getHeaderActions(): array
    // {
    //     return [
    //         Actions\Action::make('print')
    //             ->label('Print Preview')
    //             ->icon('heroicon-o-printer')
    //             ->color('primary')
    //             ->action(fn() => $this->dispatchBrowserEvent('print-document'))
    //             ->url(fn() => route('donation-agreements.print', ['record' => $this->record->id])),
    //     ];
    // }

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('print')
                ->label('Print')
                ->icon('heroicon-o-printer')
                ->action(fn () => $this->dispatchBrowserEvent('print-donation-agreement'))
                ->url(fn() => route('donation-agreements.print', ['record' => $this->record->id])),
            Actions\Action::make('view_pdf')
                ->label('View PDF')
                ->icon('heroicon-o-document')
                ->url(fn () => asset("storage/" . $this->record->signed_agreement_pdf))
                ->openUrlInNewTab(),
        ];
    }
    






}
