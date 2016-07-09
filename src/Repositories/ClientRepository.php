<?php
namespace Ftob\OauthServerApp\Repositories;


use Doctrine\ORM\EntityRepository;
use Ftob\OauthServerApp\Entity\Client;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Repositories\ClientRepositoryInterface;

class ClientRepository extends EntityRepository implements ClientRepositoryInterface
{
    /**
     * @param string $clientIdentifier
     * @param string $grantType
     * @param null $clientSecret
     * @param bool $mustValidateSecret
     * @return Client|null
     */
    public function getClientEntity($clientIdentifier, $grantType, $clientSecret = null, $mustValidateSecret = false)
    {
        /** @var Client $client */
        $client = $this->find($clientIdentifier);
        if ($client) {
            if ($mustValidateSecret) {
                // @TODO Validate secret
            }

            foreach ($client->getGrants() as $grant) {
                if ($grant->getName() === $grantType) {
                    return $client;
                }
            }
        }

        return null;
    }

}