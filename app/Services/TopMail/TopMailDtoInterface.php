<?php

namespace App\Services\TopMail;


interface TopMailDtoInterface
{
    public function getSites(): array;

    public function sitesCount(): int;

    public function appendSite(TopMailSiteDtoInterface $siteDto);
}
