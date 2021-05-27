<?php


namespace App\Representation;


use App\Helpers\Constructable;

/**
 * Class User
 * @package App\Representation
 */
class User
{
    use Constructable;

    /**
     * @var int
     */
    protected int $id;
    /**
     * @var string
     */
    protected string $name;
    /**
     * @var string
     */
    protected string $email;
    /**
     * @var string
     */
    protected string $createdAt;
    /**
     * @var string
     */
    protected string $updatedAt;

    /**
     * User constructor.
     * @param array $args
     */
    public function __construct(array $args)
    {
        $this->useSetters = false;

        $this->constructArgs($args);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }
}
