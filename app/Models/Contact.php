<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = ['company_id', 'name', 'tel', 'email'];

    /**
     * Get the contacts for the company.
     */
    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
