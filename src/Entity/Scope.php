<?php
namespace Ftob\OauthServerApp\Entity;

use Ftob\OauthServerApp\Entity\Traits\EntityTrait;
use League\OAuth2\Server\Entities\ScopeEntityInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Ftob\OauthServerApp\Repositories\AccessTokenRepository")
 * @ORM\Table(name="scopes")
 */
class Scope implements ScopeEntityInterface
{
    use EntityTrait;


    function jsonSerialize()
    {
        return json_encode($this->identifier);
    }

}