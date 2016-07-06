<?php
namespace Ftob\OauthServerApp\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class IndexController
 * @package Ftob\OauthServerApp\Controllers
 */
class IndexController extends Controller
{

    public function indexAction()
    {
        return new Response('Index');
    }
}