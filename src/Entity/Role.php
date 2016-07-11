<?php
namespace Ftob\OauthServerApp\Entity;

use Symfony\Component\Security\Core\Role\RoleInterface;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="Ftob\OauthServerApp\Repositories\RoleRepository")
 * @ORM\Table(name="roles")
 */
class Role implements RoleInterface
{
    /**
     * @var string
     * @ORM\Column(type="string", length=32)
     */
    protected $role;

    /**
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

}