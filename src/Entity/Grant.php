<?php
namespace Ftob\OauthServerApp\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use League\OAuth2\Server\Entities\ScopeEntityInterface;

/**
 * @ORM\Entity(repositoryClass="Ftob\OauthServerApp\Repositories\GrantRepository")
 * @ORM\Table(name="grants")
 */
class Grant
{

    /**
     * @ORM\Column(type="int")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $Id;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @var Scope[]
     *
     * @var ScopeEntityInterface[]
     * @ORM\ManyToMany(targetEntity="Scope")
     * @ORM\JoinTable(name="grants_scopes",
     *      joinColumns={@ORM\JoinColumn(name="grant_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="scope_identifier", referencedColumnName="identifier")}
     *      )
     */
    protected $scopes = [];

    /**
     * Grant constructor.
     */
    public function __construct()
    {
        $this->scopes = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->Id;
    }

    /**
     * @param mixed $Id
     */
    public function setId($Id)
    {
        $this->Id = $Id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getScopes()
    {
        return $this->scopes;
    }

    /**
     * @param mixed $scopes
     */
    public function setScopes($scopes)
    {
        $this->scopes = $scopes;
    }


}