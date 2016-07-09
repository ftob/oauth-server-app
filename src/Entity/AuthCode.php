<?php
namespace Ftob\OauthServerApp\Entity;


use League\OAuth2\Server\Entities\AuthCodeEntityInterface;

use League\OAuth2\Server\Entities\Traits\AuthCodeTrait;
use League\OAuth2\Server\Entities\Traits\EntityTrait;
use League\OAuth2\Server\Entities\Traits\TokenEntityTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Ftob\OauthServerApp\Repositories\AuthCodeRepository")
 * @ORM\Table(name="auth_codes")
 */
class AuthCode implements AuthCodeEntityInterface
{
    use EntityTrait, TokenEntityTrait, AuthCodeTrait;

}