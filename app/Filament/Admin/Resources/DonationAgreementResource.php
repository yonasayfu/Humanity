<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\DonationAgreementResource\Pages;
use App\Models\DonationAgreement;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class DonationAgreementResource extends Resource
{
    // Specify the Eloquent model used for this resource
    protected static ?string $model = DonationAgreement::class;

    // Navigation settings for the Filament admin panel
    protected static ?string $navigationIcon = 'heroicon-o-document';
    protected static ?string $navigationLabel = 'Donation Agreements';

    /**
     * Define the form for creating and editing donation agreements.
     */
    public static function form(Form $form): Form
    {
        return $form->schema([
            // Supporter selection (via relationship)
            Forms\Components\Select::make('supporter_id')
                ->label('Supporter')
                ->relationship('supporter', 'name')
                ->required(),

            // Bank form selection (via relationship)
            Forms\Components\Select::make('bank_id')
                ->label('Bank Form')
                ->relationship('bankForm', 'form_name')
                ->required(),

            // Donation type selection as a dropdown
            Forms\Components\Select::make('donation_type')
                ->label('Donation Type')
                ->options([
                    'one-time' => 'One-Time',
                    'recurring' => 'Recurring',
                ])
                ->reactive() // update form state when changed
                ->required(),

            // Recurring interval selection as a dropdown, visible only if donation type is recurring
            Forms\Components\Select::make('recurring_interval')
                ->label('Recurring Interval')
                ->options([
                    'monthly' => 'Monthly',
                    'yearly' => 'Yearly',
                ])
                ->visible(fn($get) => $get('donation_type') === 'recurring')
                ->nullable(),

            // Donation amount (numeric field)
            Forms\Components\TextInput::make('donation_amount')
                ->label('Donation Amount')
                ->numeric()
                ->required(),

            // File upload for the signed agreement PDF
            // Forms\Components\FileUpload::make('signed_agreement_pdf')
            //     ->label('Signed Agreement PDF')
            //     ->required()
            //     ->disk('public')
            //     ->directory('donation_agreements')
            //     ->acceptedFileTypes(['application/pdf']),

            Forms\Components\FileUpload::make('signed_agreement_pdf')
                ->label('Signed Agreement PDF')
                ->disk('public') // Ensure it saves to the public disk
                ->directory('donation_agreements') // Store in storage/app/public/donation_agreements/
                ->acceptedFileTypes(['application/pdf'])
                ->required(),

        ]);

    }

    /**
     * Define the table that lists donation agreements.
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),
                Tables\Columns\TextColumn::make('supporter.name')
                    ->label('Supporter')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('bankForm.form_name')
                    ->label('Bank Form')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('donation_type')
                    ->label('Type')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('donation_amount')
                    ->label('Amount')
                    ->sortable(),
                Tables\Columns\TextColumn::make('recurring_interval')
                    ->label('Recurring Interval'),

                // Tables\Columns\TextColumn::make('signed_agreement_pdf')
                //     ->label('Agreement File')
                //     ->limit(30)
                //     ->tooltip(fn(DonationAgreement $record): ?string => $record->signed_agreement_pdf),

                Tables\Columns\TextColumn::make('signed_agreement_pdf')
                    ->label('Agreement File')
                    ->formatStateUsing(fn($state) => asset("storage/$state")) // 👈 Fix URL
                    ->limit(30)
                    ->tooltip(fn(DonationAgreement $record): ?string => $record->signed_agreement_pdf),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime('M d, Y')
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(), // 👈 Ensure the "View" button is included
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    /**
     * Define the pages associated with this resource.
     */
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDonationAgreements::route('/'),
            'create' => Pages\CreateDonationAgreement::route('/create'),
            'edit' => Pages\EditDonationAgreement::route('/{record}/edit'),
            'view' => Pages\ViewDonationAgreement::route('/{record}'), // New View Page
        ];
    }

}
