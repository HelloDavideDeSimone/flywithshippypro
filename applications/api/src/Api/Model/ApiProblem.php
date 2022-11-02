<?php

namespace App\Api\Model;

use Symfony\Component\HttpFoundation\Response;

class ApiProblem
{
    public const TYPE_VALIDATION_ERROR = 'validation_error';
    public const TYPE_INVALID_REQUEST_BODY_FORMAT = 'invalid_body_format';

    private const TITLES = [
        self::TYPE_VALIDATION_ERROR => 'There was a validation error',
        self::TYPE_INVALID_REQUEST_BODY_FORMAT => 'Invalid JSON format sent',
    ];

    private int $statusCode;

    private ?string $type;

    private string $title;

    /**
     * @var array<string, mixed>
     */
    private array $extraData = [];

    public function __construct(int $statusCode = 500, ?string $type = null)
    {
        $this->statusCode = $statusCode;

        if (null === $type) {
            $type = 'about:blank';
            $title = Response::$statusTexts[$statusCode] ?? 'Unknown status code :(';
        } else {
            $title = self::TITLES[$type] ?? 'Unknown type error';
        }

        $this->type = $type;
        $this->title = $title;
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return array_merge(
            $this->extraData,
            [
                'status' => $this->statusCode,
                'type' => $this->type,
                'title' => $this->title,
            ]
        );
    }

    /**
     * @param mixed $value
     */
    public function set(string $name, $value): self
    {
        $this->extraData[$name] = $value;

        return $this;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getTitle(): string
    {
        return $this->title;
    }
}
