<?php
namespace Ftob\OauthServerApp\Entity\Traits;
use Doctrine\ORM\Mapping as ORM;

trait AuthCodeTrait
{
    /**
     * @ORM\Column(type="string", length=1024)
     */
    protected $redirectUri;

    /**
     * @return string
     */
    public function getRedirectUri()
    {
        return $this->redirectUri;
    }

    /**
     * @param string $uri
     */
    public function setRedirectUri($uri)
    {
        $this->redirectUri = $uri;
    }
}
