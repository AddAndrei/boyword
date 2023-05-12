<?php

namespace App\Http\Extensions;

trait ResourceAsResponseTrait
{
    /**
     * @var int
     */
    protected int $statusCode = 200;

    /**
     * Ответ для ресурса.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Http\Response  $response
     * @return void
     */
    public function withResponse($request, $response)
    {
        $response->setStatusCode($this->statusCode);
    }

    /**
     * @param int $statusCode
     * @return $this
     */
    public function setStatusCode(int $statusCode): self
    {
        $this->statusCode = $statusCode;
        return $this;
    }
}
