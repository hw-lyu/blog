<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BoardPost extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'board_post';
    protected $fillable = [
        'subject',
        'content',
        'file_data',
        'board_id',
        'tag_id',
        'writer',
        'use'
    ];
    protected $attributes = [
        'use' => false,
    ];
}
