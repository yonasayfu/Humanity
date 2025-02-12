<?php
namespace App\Filament\Resources;

use App\Filament\Exports\SupporterExporter;
use App\Filament\Resources\SupporterResource\Pages; // ✅ Import the exporter
use App\Models\Supporter;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;

class SupporterResource extends Resource
{
    protected static ?string $model = Supporter::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'Supporters';
    protected static ?string $navigationGroup = 'Supporters Management';
   
    //protected static ?string $navigationLabel = 'Supporters';
    protected static ?int $navigationSort = 1; // Controls order in sidebar

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            TextInput::make('name')->required()->maxLength(255),

            Select::make('type')
                ->options([
                    'government' => 'Government',
                    'NGO' => 'NGO',
                    'private' => 'Private',
                    'individual' => 'Individual',
                ])
                ->required(),

            TextInput::make('phone_number')->maxLength(20),
            TextInput::make('email')->email()->maxLength(255),
            Textarea::make('address'),

            TextInput::make('contribution_amount')->numeric()->default(0),
            TextInput::make('photo_url')->url()->label('Profile Photo URL'),
            Textarea::make('testimonial_content')->label('Testimonial'),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        // return $table
        //     ->columns([
        //         TextColumn::make('name')->sortable()->searchable(),
        //         TextColumn::make('type')->sortable(),
        //         TextColumn::make('phone_number'),
        //         TextColumn::make('email'),
        //         TextColumn::make('contribution_amount')->sortable(),
        //         TextColumn::make('created_at')->label('Joined')->dateTime(),
        //     ])
            return $table
        ->query(\App\Models\Supporter::query()) // Ensure this is fetching data
        ->columns([
            TextColumn::make('name')->sortable()->searchable(),
            TextColumn::make('type')->sortable(),
            TextColumn::make('phone_number'),
            TextColumn::make('email'),
            TextColumn::make('contribution_amount')->sortable(),
            TextColumn::make('created_at')->label('Joined')->dateTime(),
        ])->filters([
                SelectFilter::make('type')
                    ->options([
                        'government' => 'Government',
                        'NGO' => 'NGO',
                        'private' => 'Private',
                        'individual' => 'Individual',
                    ]),
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->headerActions([
                ExportAction::make('export_csv')
                    ->label('Export CSV')
                    ->exporter(SupporterExporter::class), // ✅ Uses the custom exporter
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSupporters::route('/'),
            'create' => Pages\CreateSupporter::route('/create'),
            'edit' => Pages\EditSupporter::route('/{record}/edit'),
        ];
    }
}
