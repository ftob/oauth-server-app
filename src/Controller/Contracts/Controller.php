<?php
namespace Ftob\OauthServerApp\Controller\Contracts;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Bridge\PsrHttpMessage\Factory\HttpFoundationFactory;
use Symfony\Bundle\FrameworkBundle\Controller\Controller as HttpController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bridge\PsrHttpMessage\Factory\DiactorosFactory;
use Symfony\Component\HttpFoundation\Response;

/**
 * Abstract controller
 * Class Controller
 * @package Ftob\OauthServerApp\Controller\Contracts
 */
abstract class Controller extends HttpController
{
    /**
     * @var DiactorosFactory
     */
    protected $psr7Factory;

    protected $httpFoundationFactory;

    public function __construct()
    {
        $this->psr7Factory =  new DiactorosFactory();
        $this->httpFoundationFactory = new HttpFoundationFactory();

    }

    /**
     * @param Request $request
     * @return \Psr\Http\Message\ServerRequestInterface|\Zend\Diactoros\ServerRequest
     */
    protected function convertRequestToPsr7(Request $request)
    {
        // convert a Request
        return $this->psr7Factory->createRequest($request);
    }

    /**
     * @param Response $response
     * @return \Psr\Http\Message\ResponseInterface|\Zend\Diactoros\Response
     */
    protected function convertResponseToPsr7(Response $response)
    {
        // convert a Response
        return $this->psr7Factory->createResponse($response);
    }

    /**
     * @param ServerRequestInterface $requestInterface
     * @return Request
     */
    protected function convertPsr7ToRequest(ServerRequestInterface $requestInterface)
    {
        // convert a Request
        // $psrRequest is an instance of Psr\Http\Message\ServerRequestInterface
        return $this->httpFoundationFactory->createRequest($requestInterface);
    }

    /**
     * @param ResponseInterface $responseInterface
     * @return Response
     */
    protected function convertPsr7ToResponse(ResponseInterface $responseInterface)
    {
        // convert a Response
        // $psrResponse is an instance of Psr\Http\Message\ResponseInterface
        return $this->httpFoundationFactory->createResponse($responseInterface);
    }
}