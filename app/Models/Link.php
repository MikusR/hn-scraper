<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Link extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'article_id';
    protected $casts = [
        'deleted' => 'boolean',
        'date' => 'datetime:Y-m-d H:i',
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
