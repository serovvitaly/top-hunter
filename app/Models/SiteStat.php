<?php

namespace App\Models;

use App\Services\SiteStatDtoInterface;
use Illuminate\Database\Eloquent\Model;

class SiteStat extends Model
{
    public static function createBySiteDto(int $siteId, SiteStatDtoInterface $siteDto)
    {
        $stat = new self;
        $stat->site_id = $siteId;
        $stat->visitors = $siteDto->getVisitors();
        $stat->hits = $siteDto->getHits();
        $stat->save();
        return $stat;
    }
}
