<?php

namespace App\Services;


interface SiteDtoInterface
{
    public function getSchema(): string;
    public function getHost(): string;
}