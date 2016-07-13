<?php
namespace Ftob\OauthServerApp\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use  Ftob\OauthServerApp\Entity\Traits\EntityTrait;
use League\OAuth2\Server\Entities\UserEntityInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="Ftob\OauthServerApp\Repositories\UserRepository")
 * @ORM\Table(name="users")
 */
class User implements UserEntityInterface, UserInterface
{
    use EntityTrait;

    /**
     * @ORM\Column(type="string", length=72)
     */
    protected $password;

    /**
     * @ORM\Column(type="string", length=64)
     */
    protected $salt;

    /**
     * @ORM\Column(type="string", length=32)
     */
    protected $username;

    /**
     * @var Role[]
     * @ORM\ManyToMany(targetEntity="Role")
     * @ORM\JoinTable(name="users_roles",
     *      joinColumns={@ORM\JoinColumn(name="user_identifier", referencedColumnName="identifier")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="role_id", referencedColumnName="id")}
     *      )
     */
    protected $roles;

    public function __construct()
    {
        $this->roles = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * @param mixed $salt
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }


    /**
     * @return ArrayCollection|Role[]
     */
    public function getRoles()
    {
        return $this->roles;
    }


    public function eraseCredentials()
    {
        //
    }
}