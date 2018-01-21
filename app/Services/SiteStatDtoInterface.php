<?php

namespace App\Services;


interface SiteStatDtoInterface
{
    /**
     * @return int
     */
    public function getVisitors(): int;

    /**
     * @return int
     */
    public function getHits(): int;
}
