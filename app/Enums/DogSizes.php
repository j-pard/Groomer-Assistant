<?php

namespace App\Enums;

abstract class DogSizes extends Enum
{
    public const DWARF = 'dwarf';
    public const SMALL = 'small';
    public const MEDIUM = 'medium';
    public const BIG = 'big';
    public const GIANT = 'giant';

    /**
     * Get the text of the size.
     *
     * @param string $size
     * @return string
     */
    public static function getText(string $size): string
    {
        switch ($size) {
            case self::DWARF:
                return 'Nain';
            case self::SMALL:
                return 'Petit';
            case self::MEDIUM:
                return 'Moyen';
            case self::BIG:
                return 'Grand';
            case self::GIANT:
                return 'Géant';
            default:
                return '';
        }
    }
}
