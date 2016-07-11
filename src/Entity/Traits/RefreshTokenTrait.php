<?php

namespace Ftob\OauthServerApp\Entity\Traits;

use DateTime;
use League\OAuth2\Server\Entities\AccessTokenEntityInterface;
use Doctrine\ORM\Mapping as ORM;

trait RefreshTokenTrait
{
    /**
     * @var AccessTokenEntityInterface
     * @ORM\OneToOne(targetEntity="AccessToken")
     * @ORM\JoinColumn(name="access_tokens", referencedColumnName="identifier")
     */
    protected $accessToken;

    /**
     * @ORM\Column(type="datetime")
     * @var DateTime
     */
    protected $expiryDateTime;

    /**
     * {@inheritdoc}
     */
    public function setAccessToken(AccessTokenEntityInterface $accessToken)
    {
        $this->accessToken = $accessToken;
    }

    /**
     * {@inheritdoc}
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * Get the token's expiry date time.
     *
     * @return DateTime
     */
    public function getExpiryDateTime()
    {
        return $this->expiryDateTime;
    }

    /**
     * Set the date time when the token expires.
     *
     * @param DateTime $dateTime
     */
    public function setExpiryDateTime(DateTime $dateTime)
    {
        $this->expiryDateTime = $dateTime;
    }
}
