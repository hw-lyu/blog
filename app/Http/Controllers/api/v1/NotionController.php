<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class NotionController extends Controller
{
    public const API_URL = "https://api.notion.com/v1/";
    private const MAIN_NOTION_ID = "88b7cafc-ae4e-4ccb-ada3-d4ead7fe8ae2";

    /**
     * 메인 API
     *
     * @return array|null
     */
    public function index(): array|null
    {
        $response = Http::withHeaders([
            'Authorization' => "Bearer " . config('app.notion_key'),
            "Notion-Version" => "2022-06-28"
        ])->get(self::API_URL . 'pages/' . self::MAIN_NOTION_ID);

        return $response->json();
    }
}
