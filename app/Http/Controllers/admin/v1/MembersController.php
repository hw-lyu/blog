<?php

namespace App\Http\Controllers\admin\v1;

use App\Http\Controllers\Controller;
use Google\Exception;
use Google\Client;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http as FacadesHttp;
use JetBrains\PhpStorm\NoReturn;

class MembersController extends Controller
{
    protected object $client;
    protected const TOKEN_INFO_API_URL = "https://www.googleapis.com/oauth2/v1/tokeninfo";

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * 구글 로그인
     *
     * @return void
     * @throws Exception
     * @throws RequestException
     */
    public function index(): void
    {
        $this->client->setAuthConfig('/home/blog/client_secret.json');
        $this->client->addScope(['openid', 'https://www.googleapis.com/auth/userinfo.email']);
        $this->client->setAccessType('offline');
        $this->client->setPrompt('consent');
        $this->client->setIncludeGrantedScopes(true);

        if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
            $this->client->setAccessToken($_SESSION['access_token']);

            // 관리자 아이디가 아니면 로그인 금지
            $http = FacadesHttp::get(self::TOKEN_INFO_API_URL . "?id_token={$this->client->getAccessToken()['id_token']}")->throw()->json();
            if ($http['email'] !== env('ADMIN_EMAIL')) {
                abort(404);
            }

            $_SESSION['admin_email'] = $http['email'];
            $redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . '/';

            header('Location: ' . $redirect_uri);
        } else {
            $redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . '/api/admin/v1/members/oauth2';
            header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
        }
    }

    /**
     * 구글 로그인 콜백
     *
     * @throws Exception
     */
    public function oauth2callback(): void
    {
        $this->client->setAuthConfigFile('/home/blog/client_secret.json');
        $this->client->setRedirectUri('http://' . $_SERVER['HTTP_HOST'] . '/api/admin/v1/members/oauth2');
        $this->client->addScope(['openid', 'https://www.googleapis.com/auth/userinfo.email']);
        $this->client->setAccessType('offline');
        $this->client->setPrompt('consent');
        $this->client->setIncludeGrantedScopes(true);

        if (!isset($_GET['code'])) {
            $auth_url = $this->client->createAuthUrl();

            header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
        } else {
            $this->client->authenticate($_GET['code']);
            $_SESSION['access_token'] = $this->client->getAccessToken();
            $redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . '/';

            header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
        }
    }
}
