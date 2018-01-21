<?php

namespace App\Services\TopMail;


class TopMailDto implements TopMailDtoInterface
{
    protected $sites = [];

    public function getSites(): array
    {
        return $this->sites;
    }

    public function sitesCount(): int
    {
        return count($this->sites);
    }

    public function appendSite(TopMailSiteDtoInterface $siteDto)
    {
        $this->sites[] = $siteDto;
        return $this;
    }
}
