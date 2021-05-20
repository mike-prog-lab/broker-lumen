<?php

namespace App\Exceptions\Fetch;

use Exception;
use Psr\Http\Message\ResponseInterface;
use Throwable;

/**
 * Class RequestFailed
 * @package App\Exceptions\Fetch
 */
class RequestFailed extends Exception
{
    /**
     * @var ResponseInterface
     */
    protected ResponseInterface $response;

    /**
     * RequestFailed constructor.
     * @param ResponseInterface $response
     * @param Throwable|null $previous
     */
    public function __construct(ResponseInterface $response, Throwable $previous = null)
    {
        $this->response = $response;

        parent::__construct($response->getReasonPhrase(), $response->getStatusCode(), $previous);
    }

    /**
     * @return ResponseInterface
     */
    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }
}
