<?php

declare(strict_types=1);

namespace OhDear\PhpSdk\Enums;

enum UptimeSplit: string
{
    case Hour = 'hour';
    case Day = 'day';
    case Month = 'month';
}
