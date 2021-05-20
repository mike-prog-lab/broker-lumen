<?php


namespace App\Repositories\Outer;


use App\Exceptions\Repository\ModelNotFoundException;

/**
 * Class UserRepository
 * @package App\Repositories\Outer
 */
final class UserRepository extends OuterRepository
{
    /**
     * @throws ModelNotFoundException
     */
    public function getUser(string $token): array
    {
        try {
            return $this->getJsonBodyArray($this->fetch('/user', 'GET', [
                'Authorization' => $token,
            ]));
        } catch (\Throwable $exception) {
            throw new ModelNotFoundException('User not found.', 404, $exception);
        }
    }
}
