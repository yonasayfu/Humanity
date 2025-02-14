<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonationAgreement extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * This ensures that these fields can be mass-assigned.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'supporter_id',
        'bank_id',
        'donation_type',
        'donation_amount',
        'recurring_interval',
        'signed_agreement_pdf',
    ];

    /**
     * Get the supporter associated with this donation agreement.
     */
    public function supporter()
    {
        return $this->belongsTo(Supporter::class);
    }

    /**
     * Get the bank form associated with this donation agreement.
     */
    public function bankForm()
    {
        return $this->belongsTo(BankForm::class, 'bank_id');
    }
}
