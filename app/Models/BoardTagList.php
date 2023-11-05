<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class BoardTagList extends Model
{
    use SoftDeletes;

    protected $table = 'board_tag_list';
    protected $fillable = [
        'name',
        'name_ko',
        'use'
    ];
    protected $attributes = [
        'use' => false,
    ];
}
