<?php

namespace App\Models;

use App\Services\SiteInfoDtoInterface;
use Illuminate\Database\Eloquent\Model;

class SiteInfo extends Model
{
    public static function findOrCreateBySiteInfoDto(int $siteId, SiteInfoDtoInterface $siteInfoDto)
    {
        $model = self::findBySiteId($siteId);
        if (!$model) {
            $model = self::createBySiteInfoDto($siteId, $siteInfoDto);
        }
        return $model;
    }

    public static function findBySiteId(int $siteId)
    {
        return self::where('site_id', $siteId)->first();
    }

    public static function createBySiteInfoDto(int $siteId, SiteInfoDtoInterface $siteInfoDto)
    {
        $model = new self;
        $model->site_id = $siteId;
        $model->rating_site = $siteInfoDto->getRatingSite();
        $model->title = $siteInfoDto->getSiteTitle();
        $model->stats_url = $siteInfoDto->getStatsUrl();
        $model->stats_available = $siteInfoDto->isStatsAvailable();
        $model->save();
        return $model;
    }
}
