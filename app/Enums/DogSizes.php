<?php

namespace App\Enums;

abstract class DogSizes
{
    public const DWARF = 'dwarf';
    public const SMALL = 'small';
    public const MEDIUM = 'medium';
    public const BIG = 'big';
    public const GIANT = 'giant';

    /**
     * Get the text of the size.
     *
     * @param int $size
     * @return string
     */
    public static function getText(int $size): string
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

    /**
     * Get all sizes.
     *
     * @return array
     */
    public static function all(): array
    {
        return [
            self::DWARF,
            self::SMALL,
            self::MEDIUM,
            self::BIG,
            self::GIANT,
        ];
    }

    /**
     * Pluck size as text by id.
     *
     * @return array
     */
    public static function pluckAll(): array
    {
        $sizes = [];

        foreach (self::all() as $size) {
            $sizes[$size] = self::getText($size);
        }

        return $sizes;
    }
}