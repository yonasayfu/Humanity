<?php
namespace App\Filament\Actions;

use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Builder;
use Barryvdh\DomPDF\Facade\Pdf;

class ExportToPdfAction extends Action
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->label('Export to PDF')
            ->action(function (Builder $query) {
                $this->exportToPdf($query);
            });
    }

    protected function exportToPdf(Builder $query): mixed
    {
        // Fetch the data to export
        $data = $query->get();

        // Generate the PDF
        $pdf = Pdf::loadView('exports.supporters', ['data' => $data]);

        // Download the PDF
        return $pdf->download('supporters_export.pdf');
    }
}
