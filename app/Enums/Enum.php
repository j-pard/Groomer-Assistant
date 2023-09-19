<?php

namespace App\Enums;

abstract class Enum
{
    /**
     * Get the text of the constant.
     *
     * @param string $constant
     * @return string
     */
    abstract static function getText(string $constant): string;

    /**
     * Get all constants.
     *
     * @return array
     */
    public static function all(): array
    {
        $reflection = new \ReflectionClass(static::class);

        return array_values($reflection->getConstants());
    }

    /**
     * Pluck constants as text by id.
     *
     * @return array
     */
    public static function pluckAll(): array
    {
        $reflection = new \ReflectionClass(static::class);
        $constants = [];

        foreach (array_values($reflection->getConstants()) as $constant) {
            $constants[$constant] = static::getText($constant);
        }

        return $constants;
    }
}