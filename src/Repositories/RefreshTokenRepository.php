<?php
namespace Ftob\OauthServerApp\Repositories;

use Doctrine\ORM\EntityRepository;
use Ftob\OauthServerApp\Entity\RefreshToken;
use League\OAuth2\Server\Entities\RefreshTokenEntityInterface;
use League\OAuth2\Server\Repositories\RefreshTokenRepositoryInterface;

class RefreshTokenRepository extends EntityRepository implements RefreshTokenRepositoryInterface
{
    /**
     * @return mixed
     */
    public function getNewRefreshToken()
    {
        /** @var RefreshToken $entity */
        $entity = $this->getEntityName();

        return new $entity;
    }

    /**
     * @param RefreshTokenEntityInterface $refreshTokenEntity
     * @return RefreshTokenEntityInterface
     */
    public function persistNewRefreshToken(RefreshTokenEntityInterface $refreshTokenEntity)
    {
        $this->getEntityManager()->persist($refreshTokenEntity);
        $this->getEntityManager()->flush($refreshTokenEntity);
        return $refreshTokenEntity;
    }

    /**
     * @param string $tokenId
     */
    public function revokeRefreshToken($tokenId)
    {
        $entity = $this->find($tokenId);
        $this->getEntityManager()->remove($entity);
    }

    /**
     * @param string $tokenId
     * @return bool
     */
    public function isRefreshTokenRevoked($tokenId)
    {
        return boolval($this->find($tokenId));
    }

}