<?php

namespace OhDear\PhpSdk\Enums;

enum CheckResult: string
{
    case Pending = 'pending';
    case Succeeded = 'succeeded';
    case Warning = 'warning';
    case Failed = 'failed';
    case ErroredOrTimedOut = 'errored-or-timed-out';

    public function isUp(): bool
    {
        return match ($this) {
            self::Succeeded, self::Warning => true,
            default => false,
        };
    }

    public function isDown(): bool
    {
        return match ($this) {
            self::Failed, self::ErroredOrTimedOut => true,
            default => false,
        };
    }

    public function isPending(): bool
    {
        return $this === self::Pending;
    }

    public function isWarning(): bool
    {
        return $this === self::Warning;
    }
}
