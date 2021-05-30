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

    /**
     * @param int $id
     * @return bool
     * @throws \Exception
     */
    public function isValidId(int $id): bool
    {
        try {
            return json_decode($this->fetch("/user/$id/valid")->getBody()->getContents());
        } catch (\Throwable $exception) {
            throw new \Exception('Failed to lookup the user id', 500, $exception);
        }
    }
}
