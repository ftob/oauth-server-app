<?php
namespace Ftob\OauthServerApp\Entity;

use League\OAuth2\Server\Entities\ScopeEntityInterface;

/**
 * Class Scope
 * @package Ftob\OauthServerApp\Entity
 */
class Scope implements ScopeEntityInterface
{
    protected $identifier;

    public function getIdentifier()
    {
        return $this->identifier;
    }

    function jsonSerialize()
    {
        return json_encode($this->identifier);
    }

}