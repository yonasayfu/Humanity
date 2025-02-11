<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supporter extends Model
{
    use HasFactory, SoftDeletes; // Enable soft deletes

    protected $fillable = [
        'name',
        'type',
        'phone_number',
        'email',
        'address',
        'contribution_amount',
        'photo_url',
        'testimonial_content'
    ];

    /**
     * Define possible types of supporters as a constant array.
     */
    public const SUPPORTER_TYPES = ['government', 'NGO', 'private', 'individual'];

    /**
     * Scope to filter by valuable supporters (e.g., based on contribution).
     */
    public function scopeMostValuable($query)
    {
        return $query->where('contribution_amount', '>', 1000);
    }
}
