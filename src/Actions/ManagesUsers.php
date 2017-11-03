<?php

namespace OhDear\PhpSdk\Actions;

use OhDear\PhpSdk\Resources\User;

trait ManagesUsers
{
    public function me(): User
    {
        $userAttributes = $this->get('me');

        return new User($userAttributes, $this);
    }
}
