<?php
namespace Ftob\OauthServerApp\Services;

use League\OAuth2\Server\AuthorizationServer;
use League\OAuth2\Server\Grant\AbstractAuthorizeGrant;
use League\OAuth2\Server\RequestTypes\AuthorizationRequest;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class ServerService - wrapper AuthorizationServer
 * @package Ftob\OauthServerApp\Services
 */
class ServerService implements ServiceInterface
{
    /** @var AuthorizationServer  */
    protected $server;

    /**
     * ServerService constructor.
     * @param AuthorizationServer $server
     * @param AbstractAuthorizeGrant $grant
     */
    public function __construct(AuthorizationServer $server, AbstractAuthorizeGrant $grant)
    {
        $server->enableGrantType($grant, new \DateInterval('PT1H'));
        $this->server = $server;
    }

    /**
     * @param ServerRequestInterface $request
     * @return AuthorizationRequest|null
     * @throws \League\OAuth2\Server\Exception\OAuthServerException
     */
    public function validateAuthorizationRequest(ServerRequestInterface $request)
    {
        return $this->server->validateAuthorizationRequest($request);
    }

    /**
     * @param AuthorizationRequest $authRequest
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    public function completeAuthorizationRequest(AuthorizationRequest $authRequest, ResponseInterface $response)
    {
        return $this->server->completeAuthorizationRequest($authRequest, $response);
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @return mixed|ResponseInterface
     */
    public function respondToAccessTokenRequest(ServerRequestInterface $request, ResponseInterface $response)
    {
        return $this->respondToAccessTokenRequest($request, $response);
    }


}