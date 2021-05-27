<?php


namespace App\Services;


use App\Exceptions\Repository\ModelNotFoundException;
use App\Repositories\Outer\UserRepository;
use App\Representation\User;

/**
 * Class UserService
 * @package App\Services
 */
final class UserService
{
    /**
     * @var UserRepository
     */
    private UserRepository $repository;

    /**
     * UserService constructor.
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @throws ModelNotFoundException
     */
    public function getUser(string $token): User
    {
        return new User($this->repository->getUser($token));
    }
}
