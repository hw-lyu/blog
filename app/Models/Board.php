<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Board extends Model
{
    use SoftDeletes;

    protected $table = 'board';
    protected $fillable = [
        'name',
        'name_ko',
        'parent_id',
        'depth',
        'order',
        'use'
    ];
    protected $attributes = [
        'use' => false,
    ];
}
