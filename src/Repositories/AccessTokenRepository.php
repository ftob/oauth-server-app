<?php
namespace Ftob\OauthServerApp\Repositories;

use Doctrine\ORM\EntityRepository;
use Ftob\OauthServerApp\Entity\AccessToken;
use League\OAuth2\Server\Entities\AccessTokenEntityInterface;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Entities\Traits\AccessTokenTrait;
use League\OAuth2\Server\Repositories\AccessTokenRepositoryInterface;
use Symfony\Component\Validator\Tests\Fixtures\EntityInterface;

/**
 * Class AccessTokenRepository
 * @package Ftob\OauthServerApp\Repositories
 */
class AccessTokenRepository extends EntityRepository implements AccessTokenRepositoryInterface
{
    /**
     * @param ClientEntityInterface $clientEntity
     * @param array $scopes
     * @param null $userIdentifier
     * @return AccessToken
     */
    public function getNewToken(ClientEntityInterface $clientEntity, array $scopes, $userIdentifier = null)
    {
        $accessToken = new AccessToken();
        $accessToken->setClient($clientEntity);

        foreach($scopes as $scope) {
            $accessToken->addScope($scope);
        }

        $accessToken->setUserIdentifier($userIdentifier);

        return $accessToken;
    }


    /**
     * @param AccessTokenEntityInterface $accessTokenEntity
     * @return AccessTokenEntityInterface
     */
    public function persistNewAccessToken(AccessTokenEntityInterface $accessTokenEntity)
    {
        $this->_em->persist($accessTokenEntity);
        $this->_em->flush($accessTokenEntity);

        return $accessTokenEntity;
    }

    /**
     * @param string $tokenId
     */
    public function revokeAccessToken($tokenId)
    {
        $accessToken = $this->find($tokenId);
        $this->getEntityManager()->remove($accessToken);
    }

    /**
     * @param string $tokenId
     * @return bool
     */
    public function isAccessTokenRevoked($tokenId)
    {
         return boolval($this->find($tokenId));
    }

}