<?php

declare(strict_types=1);

namespace App\Enums;

enum ExpireDate: string
{
    case TEN_MINUTES = '10m';
    case HOUR = '1h';
    case THREE_HOURS ='3h';
    case DAY = '1d';
    case MONTH = '1m';
    case NEVER = 'n';

    /**
     * Get timestamp.
     *
     * @return string|null
     */
    public function date(): ?string
    {
        $timestamp = match($this)
        {
            self::TEN_MINUTES => strtotime('+10 minutes'),
            self::HOUR => strtotime('+1 hour'),
            self::THREE_HOURS => strtotime('+3 hour'),
            self::DAY => strtotime('+1 day'),
            self::MONTH => strtotime('+3 month'),
            self::NEVER => NULL,
        };

        return $timestamp ? date('Y-m-d H:i:s', $timestamp) : $timestamp;
    }
}
