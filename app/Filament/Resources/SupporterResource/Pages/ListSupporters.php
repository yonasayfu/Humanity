<?php
namespace App\Filament\Resources\SupporterResource\Pages;

use App\Filament\Resources\SupporterResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Pages\Actions;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables;
//use Filament\Pages\Action;

class ListSupporters extends ListRecords
{
    protected static string $resource = SupporterResource::class;

    // protected function getHeaderActions(): array
    // {
    //     return [
    //         Actions\Action::make('Export CSV')
    //             ->url('/admin/export-supporters') // Example export route
    //             ->openUrlInNewTab(),
    //     ];
    // }
    
    
}
