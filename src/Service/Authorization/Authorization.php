<?php

namespace App\Service\Authorization;

use Moofik\Framework\Http\Session;
use Atlas\Orm\Atlas;
use App\DataSource\User\User;
use App\DataSource\User\UserRecord;

class Authorization
{
    /**
     * @var Atlas
     */
    private $atlas;

    /**
     * @var Session
     */
    private $session;

    /**
     * Authorization constructor.
     * @param Atlas $atlas
     * @param Session $session
     */
    public function __construct(Atlas $atlas, Session $session)
    {
        $this->atlas = $atlas;
        $this->session = $session;
    }

    /**
     * @param string $token
     * @return bool
     */
    public function isCurrentUserAdmin(): bool
    {
        /** @var UserRecord $user */
        $user = $this->atlas
            ->select(User::class)
            ->where('token = ', $this->session->get('token'))
            ->fetchRecord();

        return $user->is_admin ? true : false;
    }

    /**
     * @param string $token
     */
    public function storeAuthToken(string $token)
    {
        $this->session->set('token', $token);
    }

    public function logout()
    {
        $this->session->unset('token');
    }
}