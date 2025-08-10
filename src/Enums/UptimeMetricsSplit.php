<?php

namespace OhDear\PhpSdk\Enums;

enum UptimeMetricsSplit: string
{
    case Minute = 'minute';
    case Hour = 'hour';
    case Day = 'day';
    case Week = 'week';
    case Month = 'month';
}
