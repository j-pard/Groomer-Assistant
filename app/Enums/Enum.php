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
    abstract public static function getText(string $constant): string;

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

    /**
     * Get constants as options.
     *
     * @return array
     */
    public static function getAsOptions(): array
    {
        $reflection = new \ReflectionClass(static::class);
        $constants = [];

        foreach (array_values($reflection->getConstants()) as $constant) {
            $constants[] = [
                'value' => $constant,
                'label' => static::getText($constant),
            ];
        }

        return $constants;
    }

    /**
     * Return a string of all constants imploded for validation rule "in".
     *
     * @return string
     */
    public static function getValidationInRuleValues(): string
    {
        $reflection = new \ReflectionClass(static::class);
        $constants = array_values($reflection->getConstants());

        return implode(',', $constants);
    }
}
