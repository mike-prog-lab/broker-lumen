<?php


namespace App\Rules;


use App\Services\UserService;
use Illuminate\Contracts\Validation\ImplicitRule;
use Illuminate\Contracts\Validation\Rule;

/**
 * Class ValidUserId
 * @package App\Rules
 */
class ValidUserId implements Rule
{
    /**
     * @var UserService
     */
    private UserService $userService;

    /**
     * ValidUserId constructor.
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        try {
            return $this->userService->isIdValid((int) $value);
        } catch (\Throwable $exception) {
            return false;
        }
    }

    /**
     * @return string
     */
    public function message(): string
    {
        return 'The :attribute must be a valid id.';
    }
}
