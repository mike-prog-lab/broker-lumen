<?php


namespace App\Repositories\Outer;


use App\Helpers\Fetchable;
use GuzzleHttp\ClientInterface;

/**
 * Class OuterRepository
 * @package App\Repositories\Outer
 */
abstract class OuterRepository
{
    use Fetchable;

    /**
     * OuterRepository constructor.
     * @param string $root
     * @param ClientInterface $client
     */
    public function __construct(string $root, ClientInterface $client)
    {
        $this->client = $client;
        $this->root = $root;
    }
}
