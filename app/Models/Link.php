<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;

    protected $primaryKey = 'article_id';
    protected $casts = [
        'deleted' => 'boolean',
        'date' => 'datetime',
    ];
    protected $fillable = [
        'title',
        'url',
        'points',
        'date',
    ];

    public function scopeSearch($query, $keywords)
    {
        return $query->where('title', 'LIKE', '%' . $keywords . '%');
    }


}
