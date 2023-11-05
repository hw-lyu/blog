<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BoardPostTag extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'board_post_tag';
    protected $fillable = [
        'tag_id',
        'board_id',
        'use'
    ];
    protected $attributes = [
        'use' => false,
    ];
}
