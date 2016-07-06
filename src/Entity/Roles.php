<?php
namespace Ftob\OauthServerApp\Entity;

use Symfony\Component\Security\Core\Role\RoleInterface;

class Roles implements RoleInterface
{
    protected $role;

    public function getRole()
    {
        return $this->role;
    }

}