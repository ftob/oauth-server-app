<?php
namespace Ftob\OauthServerApp\Repositories;

use Doctrine\ORM\EntityRepository;
use Ftob\OauthServerApp\Entity\Grant;
use Illuminate\Support\Collection;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Repositories\UserRepositoryInterface;

/**
 * Class UserRepository
 * @package Ftob\OauthServerApp\Repositories
 */
class UserRepository extends EntityRepository implements UserRepositoryInterface
{

    /**
     * @param string $username
     * @param string $password
     * @param string $grantType
     * @param ClientEntityInterface $clientEntity
     * @return null|ClientEntityInterface
     */
    public function getUserEntityByUserCredentials(
        $username,
        $password,
        $grantType,
        ClientEntityInterface $clientEntity
    )
    {

        $col = new Collection($clientEntity->getGrants());

        // Если мы не нашли не одного grant, то пропускаем данную проверку
        if (!$col->isEmpty()) {
            // flatter array ['name', 'name2' ...]
            $col = $col->map(function($grant){
                /** @var Grant $grant */
                return $grant->getName();
            })->toArray();
            //
            if (!in_array($grantType, $col)) {
                return null;
            }
        }


        return $this->findOneBy(['username' => $username, 'password' => $password]);
    }

}