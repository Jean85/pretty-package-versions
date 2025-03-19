<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;

return RectorConfig::configure()
    ->withPaths([
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ])
    ->withPhpSets()
    ->withTypeCoverageLevel(0)
    ->withDeadCodeLevel(0)
    ->withCodeQualityLevel(0);
