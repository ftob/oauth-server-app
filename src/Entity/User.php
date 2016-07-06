<?php
namespace Ftob\OauthServerApp\Entity;

use League\OAuth2\Server\Entities\Traits\EntityTrait;
use League\OAuth2\Server\Entities\UserEntityInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserEntityInterface, UserInterface
{
    use EntityTrait;


}