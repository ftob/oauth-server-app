<?php
namespace Ftob\OauthServerApp\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use  Ftob\OauthServerApp\Entity\Traits\ClientTrait;
use  Ftob\OauthServerApp\Entity\Traits\EntityTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Ftob\OauthServerApp\Repositories\ClientRepository")
 * @ORM\Table(name="clients")
 */
class Client implements ClientEntityInterface
{
    use ClientTrait, EntityTrait;

    /**
     *
     * @var Grant[]
     * @ORM\ManyToMany(targetEntity="Grant")
     * @ORM\JoinTable(name="client_grants",
     *      joinColumns={@ORM\JoinColumn(name="client_identifier", referencedColumnName="identifier")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="grant_id", referencedColumnName="id")}
     *      )
     */
    protected $grants;

    public function __construct()
    {
        $this->grants = new ArrayCollection();
    }

    /**
     * @return Grant[]
     */
    public function getGrants()
    {
        return $this->grants;
    }

    /**
     * @param Grant $grant
     */
    public function addGrant(Grant $grant)
    {
        $this->grants[] = $grant;
    }

}