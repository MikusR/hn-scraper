<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;

    protected $primaryKey = 'article_id';
    protected $casts = [
        'deleted' => 'boolean',
    ];
    protected $fillable = [
        'title',
        'url',
        'points',
        'date',
    ];
}
