<?php
namespace Ftob\OauthServerApp\Controller;

use Ftob\OauthServerApp\Entity\User;
use Ftob\OauthServerApp\Repositories\RoleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class RoleController
 * @package Ftob\OauthServerApp\Controller
 */
class RoleController extends Controller
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function indexAction(Request $request)
    {
        /** @var RoleRepository $repository */
        $repository = $this->get('repository.role');

        /** @var User $user */
        $user = $repository->find($request->get('id'));

        if ($user) {
            return $this->json($user->getRoles());
        } else {
            throw new NotFoundHttpException();
        }
    }
}