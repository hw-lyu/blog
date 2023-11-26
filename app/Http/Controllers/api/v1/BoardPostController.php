<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\BoardRequest;
use App\Models\Board;
use App\Models\BoardPost;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Spatie\Ray;

class BoardPostController extends Controller
{
    public function __construct(
        protected Board     $board,
        protected BoardPost $boardPost,
        public int          $limit = 5,
    )
    {
    }

    /**
     * 게시물 포스트 리스트
     *
     * @param string $boardName
     * @return JsonResponse
     */
    public function index(string $boardName): JsonResponse
    {
        /**
         * SELECT post.*, post_tag.tag_id, post_tag.board_id, tag.name, tag.name_ko
         * FROM laravel.board_post as post
         * LEFT JOIN laravel.board_post_tag as post_tag
         * ON post.board_id = post_tag.board_id
         * LEFT JOIN board_tag_list tag
         * ON post_tag.tag_id = tag.id
         * where post.`use` = true
         * order by post.id desc
         */

        if ($boardName == 'all') {
            $post = $this
                ->boardPost
                ->select('board_post.*', 'board_post_tag.tag_id as tag_id', 'board_tag_list.name as tag_name', 'board_tag_list.name_ko as tag_name_ko')
                ->leftJoin('board_post_tag', fn(JoinClause $join) => $join->on('board_post_tag.board_id', '=', 'board_post.board_id'))
                ->leftJoin('board_tag_list', fn(JoinClause $join) => $join->on('board_tag_list.id', '=', 'board_post_tag.tag_id'))
                ->where(['board_post.use' => true])
                ->orderBy('id', 'desc')
                ->paginate($this->limit);
        } else {
            $board = $this->board->where('name', Str::headline($boardName))->first();

            $post = $this
                ->boardPost
                ->select('board_post.*', 'board_post_tag.tag_id as tag_id', 'board_tag_list.name as tag_name', 'board_tag_list.name_ko as tag_name_ko')
                ->leftJoin('board_post_tag', fn(JoinClause $join) => $join->on('board_post_tag.board_id', '=', 'board_post.board_id'))
                ->leftJoin('board_tag_list', fn(JoinClause $join) => $join->on('board_tag_list.id', '=', 'board_post_tag.tag_id'))
                ->where(['board_post.use' => true, 'board_post.board_id' => $board->id])
                ->orderBy('id', 'desc')
                ->paginate($this->limit);
        }

        return response()->json(['post' => $post, 'code' => Response::HTTP_OK]);
    }

    public function store(string $boardName, BoardRequest $request) {
        $param = $request->all();

        BoardPost::created([

        ]);
    }

    /**
     * 게시물 보기
     *
     * @param string $boardName
     * @param int $postId
     * @return JsonResponse
     */
    public function show(string $boardName, int $postId): JsonResponse
    {
        if ($boardName == 'all') {
            $post = $this
                ->boardPost
                ->select('board_post.*', 'board_post_tag.tag_id as tag_id', 'board_tag_list.name as tag_name', 'board_tag_list.name_ko as tag_name_ko')
                ->leftJoin('board_post_tag', fn(JoinClause $join) => $join->on('board_post_tag.board_id', '=', 'board_post.board_id'))
                ->leftJoin('board_tag_list', fn(JoinClause $join) => $join->on('board_tag_list.id', '=', 'board_post_tag.tag_id'))
                ->where(['board_post.use' => true])
                ->findOrFail($postId);
        } else {
            $board = $this->board->where('name', Str::headline($boardName))->first();
            $post = $this
                ->boardPost
                ->select('board_post.*', 'board_post_tag.tag_id as tag_id', 'board_tag_list.name as tag_name', 'board_tag_list.name_ko as tag_name_ko')
                ->leftJoin('board_post_tag', fn(JoinClause $join) => $join->on('board_post_tag.board_id', '=', 'board_post.board_id'))
                ->leftJoin('board_tag_list', fn(JoinClause $join) => $join->on('board_tag_list.id', '=', 'board_post_tag.tag_id'))
                ->where(['board_post.use' => true, 'board_post.board_id' => $board->id])
                ->orderBy('id', 'desc')
                ->findOrFail($postId);
        }

        return response()->json(['post' => $post, 'code' => Response::HTTP_OK]);
    }

    /**
     * 게시물 업데이트
     *
     * @param string $boardName
     * @param int $postId
     * @param BoardRequest $request
     * @return JsonResponse
     */
    public function update(string $boardName, int $postId, BoardRequest $request) : JsonResponse
    {
        try {
            $param = $request->all();

            $update = BoardPost::where('id', $postId)
                ->update([
                    'subject' => $param['subject'],
                    'content' => $param['content'],
                    'strip_content' => strip_tags($param['content']),
                    'file_data' => $param['file_data'],
                    'board_id' => $param['board_id'],
                    'writer' => $param['writer'],
                    'use' => $param['use'],
                    'updated_at' => now()
                ]);

            return response()->json(['data' => $param, 'updated' => $update], ResponseAlias::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['msg' => $e->getMessage()], ResponseAlias::HTTP_FORBIDDEN);
        }
    }
}
