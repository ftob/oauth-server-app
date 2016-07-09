<?php
namespace Ftob\OauthServerApp\Tests\Repositories;


use League\OAuth2\Server\Repositories\UserRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserRepositoryTest extends KernelTestCase
{
    /** @var  UserRepositoryInterface */
    protected $repository;
}