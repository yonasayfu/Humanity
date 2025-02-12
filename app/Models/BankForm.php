<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankForm extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * This protects against mass-assignment vulnerabilities and defines which fields can be bulk-assigned.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'bank_name', // The name of the bank
        'form_name', // The name or title of the form
        'form_file', // The file path or filename of the form
        // Add additional fields here if you create more columns in your migration
    ];

    // If you need to add relationships or custom methods, you can add them here.
}
