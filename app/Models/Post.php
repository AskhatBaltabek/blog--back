<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'content',
    ];

    public function category()
    {
        return $this->belongsTo('Category');
    }

    public function contents()
    {
        return $this->hasMany('App\Models\PostContent');
    }

    public function methodContents()
    {
        return $this->hasMany('App\Models\PostContent')->where('post_content_type_id', '=', 2);
    }

}
