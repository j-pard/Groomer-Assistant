<?php

namespace App\Enums;

abstract class DogStatus extends Enum
{
    public const ACTIVE = 'active';
    public const PRIVATE = 'private';
    public const NOT_COMING = 'not_coming';
    public const DEAD = 'dead';

    /**
     * Get the text of the type.
     *
     * @param string $status
     * @return string
     */
    public static function getText(string $status): string
    {
        switch ($status) {
            case self::ACTIVE:
                return 'Actif';
            case self::PRIVATE:
                return 'Privé';
            case self::NOT_COMING:
                return 'Ne vient plus';
            case self::DEAD:
                return 'Décédé';
            default:
                return '';
        }
    }

    /**
     * Get color corresponding status.
     *
     * @param string $status
     * @return string
     */
    public static function getColor(string $status): string
    {
        return match ($status) {
            self::NOT_COMING => 'secondary',
            self::PRIVATE => 'warning',
            self::DEAD => 'danger',
            default => 'success',
        };
    }
}