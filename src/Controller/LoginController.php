<?php

namespace App\Controller;

use App\DataSource\User\User;
use App\DataSource\User\UserRecord;
use App\Service\Authorization\Authorization;
use Atlas\Orm\Atlas;
use Moofik\Framework\Http\RedirectResponse;
use Moofik\Framework\Http\Request;
use Moofik\Framework\Http\Response;
use Moofik\Framework\Http\Session;
use Moofik\Framework\Template\ViewRenderer;

class LoginController
{
    /**
     * @param Authorization $authorization
     * @param ViewRenderer $renderer
     * @return RedirectResponse|Response
     */
    public function index(Authorization $authorization, ViewRenderer $renderer)
    {
        if ($authorization->isCurrentUserAdmin()) {
            return new RedirectResponse('/');
        }

        $content = $renderer->renderView('login.php');

        return new Response($content);
    }

    /**
     * @param Request $request
     * @param Session $session
     * @param Atlas $atlas
     * @param Authorization $authorization
     * @return RedirectResponse
     */
    public function login(Request $request, Session $session, Atlas $atlas, Authorization $authorization)
    {
        $username = $request->get('username');
        $password = $request->get('password');

        /** @var UserRecord $user */
        $user = $atlas
            ->select(User::class)
            ->where('username = ', $username)
            ->fetchRecord();

        if (password_verify($password, $user->password)) {
            $token = base64_encode(openssl_random_pseudo_bytes(32));
            $user->token = $token;
            $atlas->update($user);

            $session->setFlashData(['success' => 'Успешный вход']);
            $authorization->storeAuthToken($token);
        } else {
            $session->setFlashData(['error' => 'Не удалось войти. Проверьте данные']);
        }

        return new RedirectResponse('/');
    }

    /**
     * @param Authorization $authorization
     * @return RedirectResponse
     */
    public function logout(Authorization $authorization)
    {
        if ($authorization->isCurrentUserAdmin()) {
            $authorization->logout();
        }

        return new RedirectResponse('/');
    }
}