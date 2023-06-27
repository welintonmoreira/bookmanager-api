<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'original_title',
        'subtitle',
        'original_subtitle',
        'publication_year',
        'number_pages',
        'edition_number',
        'synopsis',
        'height',
        'width',
        'thickness',
        'weight',
    ];
}
