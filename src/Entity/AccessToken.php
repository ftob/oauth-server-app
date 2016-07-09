<?php
namespace Ftob\OauthServerApp\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use League\OAuth2\Server\Entities\AccessTokenEntityInterface;

use League\OAuth2\Server\Entities\ScopeEntityInterface;
use League\OAuth2\Server\Entities\Traits\AccessTokenTrait;
use Ftob\OauthServerApp\Entity\Traits\EntityTrait;
use League\OAuth2\Server\Entities\Traits\TokenEntityTrait;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="Ftob\OauthServerApp\Repositories\AccessTokenRepository")
 * @ORM\Table(name="access_tokens")
 */
class AccessToken implements AccessTokenEntityInterface
{
    use AccessTokenTrait, EntityTrait, TokenEntityTrait;


    /**
     * @var ScopeEntityInterface[]
     * @ORM\ManyToMany(targetEntity="Scope")
     * @ORM\JoinTable(name="access_tokens_scopes",
     *      joinColumns={@ORM\JoinColumn(name="access_token_identifier", referencedColumnName="identifier")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="scope_identifier", referencedColumnName="identifier")}
     *      )
     */
    protected $scopes = [];

    public function __construct()
    {
        $this->scopes = new ArrayCollection();
    }

}