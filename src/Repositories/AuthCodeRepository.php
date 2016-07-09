<?php
namespace Ftob\OauthServerApp\Repositories;

use Doctrine\ORM\EntityRepository;
use Ftob\OauthServerApp\Entity\AuthCode;
use League\OAuth2\Server\Entities\AuthCodeEntityInterface;
use League\OAuth2\Server\Repositories\AuthCodeRepositoryInterface;

/**
 * Class AuthCodeRepository
 * @package Ftob\OauthServerApp\Repositories
 */
class AuthCodeRepository extends EntityRepository implements AuthCodeRepositoryInterface
{
    /**
     * @return AuthCodeEntityInterface
     */
    public function getNewAuthCode()
    {
        $entity = $this->getEntityName();
        return new $entity;
    }

    /**
     * @param AuthCodeEntityInterface $authCodeEntity
     * @return AuthCodeEntityInterface
     */
    public function persistNewAuthCode(AuthCodeEntityInterface $authCodeEntity)
    {
        $this->getEntityManager()->persist($authCodeEntity);
        $this->getEntityManager()->flush($authCodeEntity);

        return $authCodeEntity;
    }

    /**
     * @param string $codeId
     */
    public function revokeAuthCode($codeId)
    {
        $authCode = $this->find($codeId);

        $this->getEntityManager()->remove($authCode);
    }

    /**
     * @param string $codeId
     * @return bool
     */
    public function isAuthCodeRevoked($codeId)
    {
        return boolval($this->find($codeId));
    }

}