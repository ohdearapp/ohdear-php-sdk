<?php

arch('debug functions are not used')
    ->expect(['dd', 'dump', 'var_dump', 'print_r', 'var_export', 'die', 'exit'])
    ->not->toBeUsed();

arch('Enums')
    ->expect('OhDear\PhpSdk\Enums')
    ->toBeEnums();

arch('Exceptions')
    ->expect('OhDear\PhpSdk\Exceptions')
    ->toExtend(Exception::class)
    ->toHaveSuffix('Exception');

arch('Requests')
    ->expect('OhDear\PhpSdk\Requests')
    ->toExtend('Saloon\Http\Request');

arch('Concerns')
    ->expect('OhDear\PhpSdk\Concerns')
    ->toBeTraits()
    ->toHavePrefix('Supports');
