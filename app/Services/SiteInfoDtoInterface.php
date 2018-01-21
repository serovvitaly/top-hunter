<?php

namespace App\Services;


interface SiteInfoDtoInterface
{
    /**
     * @return string
     */
    public function getRatingSite(): string;
    /**
     * @return int
     */
    public function getRating(): int;

    /**
     * @return string
     */
    public function getStatsUrl(): string;

    /**
     * @return string
     */
    public function getSiteTitle(): string;

    /**
     * @return bool
     */
    public function isStatsAvailable(): bool;

    /**
     * @return string
     */
    public function getCategory(): string;
}
