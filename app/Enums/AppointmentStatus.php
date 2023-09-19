<?php

namespace App\Enums;

abstract class AppointmentStatus extends Enum
{
    public const PLANNED = 'planned';
    public const CASH = 'cash';
    public const PAYCONIQ = 'payconiq';
    public const BANK = 'bank';
    public const PRIVATE_CASH = 'private';
    public const PRIVATE_PAYCONIQ = 'private_payconiq';
    public const PRIVATE_BANK = 'private_bank';
    public const NOT_PAID = 'not_paid';
    public const CANCELLED = 'cancelled';
    public const NOT_COME = 'not_come';

    /**
     * Get the text of the type.
     *
     * @param string $status
     * @return string
     */
    public static function getText(string $status): string
    {
        switch ($status) {
            case self::PLANNED:
                return 'En attente';
            case self::CASH:
                return 'Cash';
            case self::PAYCONIQ:
                return 'Payconiq';
            case self::BANK:
                return 'Virement';
            case self::PRIVATE_CASH:
                return 'Cash privé';
            case self::PRIVATE_PAYCONIQ:
                return 'Payconiq privé';
            case self::PRIVATE_BANK:
                return 'Virement privé';
            case self::NOT_PAID:
                return 'Non payé';
            case self::CANCELLED:
                return 'Annulé';
            case self::NOT_COME:
                return 'Pas venu';
            default:
                return '';
        }
    }

    /**
     * Get color corresponding status.
     *
     * @return string
     */
    public static function getColor(string $status): string
    {
        return match ($status) {
            self::PLANNED => 'secondary',
            self::CANCELLED, self::NOT_COME => 'warning',
            self::NOT_PAID => 'danger',
            default => 'success',
        };
    }

    /**
     * Get all status where TVA is applicable.
     *
     * @return array
     */
    public static function tvaStatus(): array
    {
        return [
            self::CASH,
            self::PAYCONIQ,
            self::BANK,
        ];
    }

    /**
     * Get all bank status where TVA is applicable.
     *
     * @return array
     */
    public static function tvaBankStatus(): array
    {
        return [
            self::PAYCONIQ,
            self::BANK,
        ];
    }
}