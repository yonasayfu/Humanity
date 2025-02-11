<?php 
namespace App\Filament\Exports;

use Filament\Tables\Actions\ExportAction as Exporter;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Supporter;

class SupporterExporter extends Exporter
{
    protected static ?string $model = Supporter::class;

    /**
     * Define the columns to export.
     */
    public function getDefaultColumns(): array
    {
        return [
            'id' => 'ID',
            'name' => 'Full Name',
            'type' => 'Supporter Type',
            'phone_number' => 'Phone Number',
            'email' => 'Email',
            'contribution_amount' => 'Contribution Amount',
            'created_at' => 'Joined Date',
        ];
    }

    /**
     * Define the query for exporting.
     */
    public function getQuery(): Builder
    {
        return parent::getQuery()->orderBy('created_at', 'desc');
    }
}
