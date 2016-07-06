<?php

namespace Ftob\OauthServerApp\Controller;

use Exception;
use Ftob\OauthServerApp\Controller\Contracts\Controller;
use Ftob\OauthServerApp\Entity\User;
use Ftob\OauthServerApp\Services\ServerService;
use League\OAuth2\Server\Exception\OAuthServerException;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response;
use Zend\Diactoros\Stream;

class AuthorizeController extends Controller
{
    /**
     * @return ServerService
     */
    protected function getServer()
    {
        return $this->get('service.server.ig');
    }

    /**
     * @param ServerRequestInterface $request
     * @return \Psr\Http\Message\MessageInterface|\Psr\Http\Message\ResponseInterface|static
     */
    public function indexAction(ServerRequestInterface $request) {

        $server = $this->getServer();
        $response = new Response();

        try {

            // Validate the HTTP request and return an AuthorizationRequest object.
            $authRequest = $server->validateAuthorizationRequest($request);

            // The auth request object can be serialized and saved into a user's session.
            // You will probably want to redirect the user at this point to a login endpoint.

            // Once the user has logged in set the user on the AuthorizationRequest
            $authRequest->setUser(new User()); // an instance of UserEntityInterface

            // At this point you should redirect the user to an authorization page.
            // This form will ask the user to approve the client and the scopes requested.

            // Once the user has approved or denied the client update the status
            // (true = approved, false = denied)
            $authRequest->setAuthorizationApproved(true);

            // Return the HTTP redirect response
            return $server->completeAuthorizationRequest($authRequest, $response);

        } catch (OAuthServerException $exception) {

            // All instances of OAuthServerException can be formatted into a HTTP response
            return $exception->generateHttpResponse($response);

        } catch (Exception $exception) {

            // Unknown exception
            $body = new Stream('php://temp', 'r+');
            $body->write($exception->getMessage());
            return $response->withStatus(500)->withBody($body);

        }
    }
}