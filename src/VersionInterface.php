<?php

namespace Jean85;

interface VersionInterface
{
    public function getPrettyVersion(): string;

    public function getFullVersion(): string;

    public function getVersionWithShortCommit(): string;

    public function getPackageName(): string;

    public function getShortVersion(): string;

    public function getCommitHash(): string;

    public function getShortCommitHash(): string;
}
