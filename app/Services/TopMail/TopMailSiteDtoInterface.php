<?php

namespace App\Services\TopMail;


use App\Services\SiteDtoInterface;
use App\Services\SiteInfoDtoInterface;
use App\Services\SiteStatDtoInterface;

interface TopMailSiteDtoInterface extends SiteDtoInterface, SiteStatDtoInterface, SiteInfoDtoInterface
{
    /**
     * @return string
     */
    public function getSiteUrl(): string;
}
