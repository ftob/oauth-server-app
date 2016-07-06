<?php
namespace Ftob\OauthServerApp\Repositories;


use Doctrine\ORM\EntityRepository;
use League\OAuth2\Server\Repositories\ClientRepositoryInterface;

class ClientRepository extends EntityRepository implements ClientRepositoryInterface
{
    public function getClientEntity($clientIdentifier, $grantType, $clientSecret = null, $mustValidateSecret = true)
    {
        // TODO: Implement getClientEntity() method.
    }

}