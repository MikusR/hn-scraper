<?php

namespace App\Models;

use Carbon\Carbon;
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
        'date' => 'datetime',
    ];
    protected $fillable = [
        'title',
        'url',
        'points',
        'date',
    ];

//    public function delete(): void
//    {
//        $this->deleted_at = now();
//        $this->deleted_by = Auth::user()->id;
//        $this->save();
//    }

    public function scopeSearch($query, $keywords)
    {
        return $query->where('title', 'LIKE', '%' . $keywords . '%');
    }


}
