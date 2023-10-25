<?php


namespace App\Helpers;


use Illuminate\Http\Response;

class ResponseErrorHelper
{
    /** @var int */
    private int $status;

    /** @var string */
    private string $type;

    /** @var string */
    private string $errorMessage;

    /** @var string|array|null */
    private string|array|null $data;

    // Constants.
    const TYPE_EXCEPTION = 'exception';
    const TYPE_VALIDATION = 'validationException';

    const DEFAULT_ERROR_MESSAGE = 'There was an unexpected failure';

    /**
     * ResponseErrorHelper constructor.
     *
     * @param int               $status
     * @param string            $type
     * @param string            $errorMessage
     * @param array|string|null $data
     */
    public function __construct(
        int $status = Response::HTTP_INTERNAL_SERVER_ERROR,
        string $type = self::TYPE_EXCEPTION,
        string $errorMessage = self::DEFAULT_ERROR_MESSAGE,
        array|string|null $data = []
    ) {
        $this->status = $status;
        $this->type = $type;
        $this->errorMessage = $errorMessage;
        $this->data = $data;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }

    /**
     * @param string $errorMessage
     */
    public function setErrorMessage(string $errorMessage): void
    {
        $this->errorMessage = $errorMessage;
    }

    /**
     * @return array|string|null
     */
    public function getData(): array|string|null
    {
        return $this->data;
    }

    /**
     * @param array|string|null $data
     */
    public function setData(array|string|null $data): void
    {
        $this->data = $data;
    }

    /**
     * @return string[]
     */
    public function toArray(): array
    {
        return [
            'status'  => $this->getStatus(),
            'type'    => $this->getType(),
            'message' => $this->getErrorMessage(),
            'data'    => $this->getData(),
        ];
    }
}
