<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\BankFormResource\Pages;
use App\Models\BankForm;
use Filament\Forms;
// use App\Filament\Admin\Resources\BankFormResource\ExportToPdfAction;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BankFormResource extends Resource
{
    // Specify the Eloquent model that this resource represents.
    protected static ?string $model = BankForm::class;

    // Define the navigation icon in the Filament admin sidebar.
    protected static ?string $navigationIcon = 'heroicon-o-document'; // You can change this as needed

    // Optionally, define a label for navigation.
    protected static ?string $navigationLabel = 'Bank Forms';

    /**
     * Configure the form used for creating and editing BankForm records.
     *
     * @param  \Filament\Resources\Form  $form
     * @return \Filament\Resources\Form
     */
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Field for entering the bank name.
                Forms\Components\TextInput::make('bank_name')
                    ->label('Bank Name')
                    ->required()
                    ->maxLength(255),

                // Field for entering the form name.
                Forms\Components\TextInput::make('form_name')
                    ->label('Form Name')
                    ->required()
                    ->maxLength(255),

                // Field for uploading the form file.
                // Here we use a FileUpload component. Adjust disk and directory as needed.
                Forms\Components\FileUpload::make('form_file')
                    ->label('Form File')
                    ->required()
                    ->disk('public') // Specify the storage disk (e.g., public)
                    ->directory('bank_forms') // Specify the folder to store files
                    ->acceptedFileTypes(['application/pdf']), // Accept only PDF files
            ]);
    }

    /**
     * Configure the table used to list BankForm records.
     *
     * @param  \Filament\Resources\Table  $table
     * @return \Filament\Resources\Table
     */


public static function table(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\TextColumn::make('id')->sortable(),

            Tables\Columns\TextColumn::make('bank_name')->sortable()->searchable(),

            Tables\Columns\TextColumn::make('form_name')->sortable()->searchable(),

            Tables\Columns\TextColumn::make('form_file')
                ->label('File')
                ->limit(30)
                ->tooltip(fn(BankForm $record): ?string => $record->form_file),

            Tables\Columns\ViewColumn::make('pdf_preview')
                ->label('PDF Preview')
                ->extraAttributes(['pdfUrl' => fn($record) => asset('storage/' . $record->form_file)])
                ->view('filament.resources.bank-form-resource.columns.pdf-preview')
                ->disableClick(),

            Tables\Columns\TextColumn::make('created_at')
                ->label('Created')
                ->dateTime('M d, Y')
                ->sortable(),
        ])
        ->filters([
            // Add filters if needed.
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
        ])
        ->headerActions([
            // ExportToPdfAction::make()
        ]);

        }

    /**
     * Define the pages associated with this resource.
     *
     * @return array
     */
    public static function getPages(): array
    {
        return [
            // The list page for bank forms.
            'index' => Pages\ListBankForms::route('/'),
            // The create page for a new bank form.
            'create' => Pages\CreateBankForm::route('/create'),
            // The edit page for an existing bank form.
            'edit' => Pages\EditBankForm::route('/{record}/edit'),
        ];
    }
}
