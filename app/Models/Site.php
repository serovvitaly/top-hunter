<?php

namespace App\Models;

use App\Services\SiteDtoInterface;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    public static function findOrCreateBySiteDto(SiteDtoInterface $siteDto)
    {
        $siteModel = self::findBySiteDto($siteDto);
        if (!$siteModel) {
            $siteModel = self::createBySiteDto($siteDto);
        }
        return $siteModel;
    }

    public static function findBySiteDto(SiteDtoInterface $siteDto)
    {
        return self::where([
            ['schema', '=', $siteDto->getSchema()],
            ['host', '=', $siteDto->getHost()],
        ])->first();
    }

    public static function createBySiteDto(SiteDtoInterface $siteDto)
    {
        $site = new self;
        $site->schema = $siteDto->getSchema();
        $site->host = $siteDto->getHost();
        $site->save();
        return $site;
    }
}
