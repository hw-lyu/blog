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

    /**
     * 태그 아이디에 해당하는 포스트 게시물들을 가져온다. (1:N)
     *
     * @return HasMany
     */
    public function post(): HasMany
    {
        return $this->hasMany(BoardPost::class, 'tag_id');
    }
}
