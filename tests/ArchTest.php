<?php

arch('debug functions are not used')
    ->expect(['dd', 'dump', 'var_dump', 'print_r', 'var_export', 'die', 'exit'])
    ->not->toBeUsed();
