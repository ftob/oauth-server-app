<?php

namespace Ftob\OauthServerApp\Entity\Traits;
use Doctrine\ORM\Mapping as ORM;

trait EntityTrait
{
    /**
     * @ORM\Column(name="identifier", type="string", nullable=false)
     * @ORM\Id
     */
    protected $identifier;

    /**
     * @return mixed
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * @param mixed $identifier
     */
    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;
    }
}