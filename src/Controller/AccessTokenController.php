<?php
namespace Ftob\OauthServerApp\Controller;

use Ftob\OauthServerApp\Controller\Contracts\Controller;
use Ftob\OauthServerApp\Services\ServerService;
use League\OAuth2\Server\Exception\OAuthServerException;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response;
use Zend\Diactoros\Stream;

class AccessTokenController extends Controller
{
    /**
     * @return ServerService
     */
    protected function getServer()
    {
        return $this->get('service.server.ccg');
    }

    /**
     * @param ServerRequestInterface $request
     * @return mixed|\Psr\Http\Message\MessageInterface|\Psr\Http\Message\ResponseInterface|static
     */
    public function indexAction(ServerRequestInterface $request)
    {
        $server = $this->getServer();
        $response = new Response();


        try {
            // Try to respond to the request
            return $server->respondToAccessTokenRequest($request, $response);
        } catch (OAuthServerException $exception) {

            // All instances of OAuthServerException can be formatted into a HTTP response
            return $exception->generateHttpResponse($response);

        } catch (\Exception $exception) {

            // Unknown exception
            $body = new Stream('php://temp', 'r+');
            $body->write($exception->getMessage());
            return $response->withStatus(500)->withBody($body);

        }
    }
}