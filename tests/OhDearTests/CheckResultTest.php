<?php

use OhDear\PhpSdk\Enums\CheckResult;

it('has all expected cases', function () {
    expect(CheckResult::cases())->toHaveCount(5);
    expect(CheckResult::Pending->value)->toBe('pending');
    expect(CheckResult::Succeeded->value)->toBe('succeeded');
    expect(CheckResult::Warning->value)->toBe('warning');
    expect(CheckResult::Failed->value)->toBe('failed');
    expect(CheckResult::ErroredOrTimedOut->value)->toBe('errored-or-timed-out');
});

it('can be created from string values', function () {
    expect(CheckResult::from('succeeded'))->toBe(CheckResult::Succeeded);
    expect(CheckResult::from('warning'))->toBe(CheckResult::Warning);
    expect(CheckResult::from('failed'))->toBe(CheckResult::Failed);
    expect(CheckResult::from('pending'))->toBe(CheckResult::Pending);
    expect(CheckResult::from('errored-or-timed-out'))->toBe(CheckResult::ErroredOrTimedOut);
});

it('returns null for unknown values with tryFrom', function () {
    expect(CheckResult::tryFrom('unknown'))->toBeNull();
    expect(CheckResult::tryFrom(''))->toBeNull();
});

it('correctly identifies up states', function () {
    expect(CheckResult::Succeeded->isUp())->toBeTrue();
    expect(CheckResult::Warning->isUp())->toBeTrue();
    expect(CheckResult::Pending->isUp())->toBeFalse();
    expect(CheckResult::Failed->isUp())->toBeFalse();
    expect(CheckResult::ErroredOrTimedOut->isUp())->toBeFalse();
});

it('correctly identifies down states', function () {
    expect(CheckResult::Failed->isDown())->toBeTrue();
    expect(CheckResult::ErroredOrTimedOut->isDown())->toBeTrue();
    expect(CheckResult::Succeeded->isDown())->toBeFalse();
    expect(CheckResult::Warning->isDown())->toBeFalse();
    expect(CheckResult::Pending->isDown())->toBeFalse();
});

it('correctly identifies pending state', function () {
    expect(CheckResult::Pending->isPending())->toBeTrue();
    expect(CheckResult::Succeeded->isPending())->toBeFalse();
    expect(CheckResult::Warning->isPending())->toBeFalse();
    expect(CheckResult::Failed->isPending())->toBeFalse();
    expect(CheckResult::ErroredOrTimedOut->isPending())->toBeFalse();
});

it('correctly identifies warning state', function () {
    expect(CheckResult::Warning->isWarning())->toBeTrue();
    expect(CheckResult::Succeeded->isWarning())->toBeFalse();
    expect(CheckResult::Failed->isWarning())->toBeFalse();
    expect(CheckResult::Pending->isWarning())->toBeFalse();
    expect(CheckResult::ErroredOrTimedOut->isWarning())->toBeFalse();
});
