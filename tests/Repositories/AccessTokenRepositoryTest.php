<?php
namespace Ftob\OauthServerApp\Tests\Repositories;


use Ftob\OauthServerApp\Entity\AccessToken;
use Ftob\OauthServerApp\Entity\Client;
use Ftob\OauthServerApp\Repositories\AccessTokenRepository;
use League\OAuth2\Server\Repositories\AccessTokenRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Class AccessTokenRepositoryTest
 * @package Ftob\OauthServerApp\Tests\Repositories
 */
class AccessTokenRepositoryTest extends KernelTestCase
{
    /** @var  AccessTokenRepository */
    protected $repository;

    protected $token;

    public function setUp()
    {
        $this->bootKernel();
        $this->repository = self::$kernel->getContainer()->get('repository.access_token');

        $token = $this->repository->getNewToken(new Client(), [], 'testUserIdentifier');
        $this->assertInstanceOf(AccessToken::class, $token);

        $token = $this->repository->persistNewAccessToken($token);
        $this->assertInstanceOf(AccessToken::class, $token);
        $this->setToken($token);

    }

    /**
     * @param AccessToken $token
     */
    protected function setToken(AccessToken $token)
    {
        $this->token = $token;
    }

    /**
     * @return array
     */
    public function getToken()
    {
        return [
            [
                $this->token
            ]
        ];
    }

    public function testDi()
    {
        $em = self::$kernel->getContainer()->get('doctrine.orm.entity_manager');
        $this->assertInstanceOf(AccessTokenRepository::class, $em->getRepository(AccessToken::class));
        $this->assertInstanceOf( AccessTokenRepository::class, $this->repository);
    }


    public function testGetNewToken()
    {
        $token = $this->repository->getNewToken(new Client(), [], 'testUserIdentifier');
        $this->assertInstanceOf(AccessToken::class, $token);
        $this->setToken($token);

    }

    /**
     * @param AccessToken $payload
     * @dataProvider getToken
     * @return AccessToken $token
     */
    public function testPersistNewAccessToken($payload)
    {
        $token = $this->repository->persistNewAccessToken($payload);
        $this->assertInstanceOf(AccessToken::class, $token);
        $this->setToken($token);

    }

    /**
     * @param AccessToken $payload
     * @return array
     * @dataProvider getToken
     */
    public function testRevokeAccessToken($payload)
    {
        $this->repository->revokeAccessToken($payload->getIdentifier());
        $result = $this->repository->find($payload->getIdentifier());
        $this->assertNull($result);
        return [$payload];
    }

    /**
     * @dataProvider getToken
     * @param $payload
     */
    public function testIsAccessTokenRevoked($payload)
    {
        $this->assertTrue($this->repository->isAccessTokenRevoked($payload));
    }

}