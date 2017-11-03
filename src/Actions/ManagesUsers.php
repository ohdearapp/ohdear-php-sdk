<?php

namespace OhDear\PhpSdk\Actions;

use OhDear\PhpSdk\Resources\User;

trait ManagesUsers
{
    public function me(): User
    {
        $userAttributes = $this->post("me");

        return new User($userAttributes, $this);
    }
}
