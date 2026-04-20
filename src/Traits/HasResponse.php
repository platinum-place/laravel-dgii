<?php

namespace PlatinumPlace\LaravelDgii\Traits;

/**
 * Trait to handle and wrap HTTP responses from DGII.
 */
trait HasResponse
{
    use HandlesDgiiResponse;

    /**
     * Execute a callback and wrap its response into an array.
     *
     * @param  \Closure  $callback  The HTTP request logic to execute.
     * @return array The wrapped DGII response.
     */
    public function catchResponse(\Closure $callback): array
    {
        return $this->handleResponse($callback)[0];
    }
}
