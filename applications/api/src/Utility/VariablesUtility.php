<?php

declare(strict_types=1);

namespace App\Utility;

use DateTime;
use Exception;
use Ramsey\Uuid\Uuid;

class VariablesUtility
{
    /**
     * @param mixed $value
     */
    public static function getInt($value): int
    {
        return (int) $value;
    }

    /**
     * @param mixed $value
     */
    public static function getIntOrNull($value): ?int
    {
        if (null === $value || '' === $value) {
            return null;
        }

        return self::getInt($value);
    }

    /**
     * @param mixed $value
     */
    public static function getFloat($value): float
    {
        return (float) $value;
    }

    /**
     * @param mixed $value
     */
    public static function getFloatOrNull($value): ?float
    {
        if (null === $value) {
            return null;
        }

        return self::getFloat($value);
    }

    /**
     * @param mixed|null $input
     */
    public static function getStringOrNull($input): ?string
    {
        if (null === $input) {
            return null;
        }

        if (!\is_string($input)) {
            return null;
        }

        $input = trim($input);
        if ('' === $input) {
            return null;
        }

        return $input;
    }

    /**
     * @param mixed $value
     */
    public static function getUuid($value): string
    {
        try {
            return Uuid::fromString($value)->toString();
        } catch (Exception $exception) { // @phpstan-ignore-line
            return '';
        }
    }

    /**
     * @param mixed $value
     */
    public static function getUuidOrNull($value): ?string
    {
        if (null === $value || '' === $value) {
            return null;
        }

        try {
            return Uuid::fromString($value)->toString();
        } catch (Exception $exception) { // @phpstan-ignore-line
            return null;
        }
    }

    public static function getDateTimeOrNull(?string $input, bool $onlyDate = false): ?DateTime
    {
        if (null === $input = self::getStringOrNull($input)) {
            return null;
        }

        try {
            $dateTime = new DateTime($input);
        } catch (Exception $e) { // @phpstan-ignore-line
            return null;
        }

        if ($onlyDate) {
            $dateTime->setTime(0, 0, 0);
        }

        return $dateTime;
    }

    /**
     * @param mixed $input
     *
     * @return array<int|string, mixed>|null
     */
    public static function getArrayOrNull($input): ?array
    {
        if (null === $input || !\is_array($input)) {
            return null;
        }

        return $input;
    }

    /**
     * @param int|float|null $a
     * @param int|float|null $b
     */
    public static function eqNumbers($a, $b): bool
    {
        if (null === $a || null === $b) {
            return false;
        }

        return (float) $a === (float) $b;
    }
}
