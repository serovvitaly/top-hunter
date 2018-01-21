<?php

namespace App\Services\TopMail;


use App\Models\Site;
use Symfony\Component\DomCrawler\Crawler;

class TopMailService
{
    /**
     * @param string $url
     * @return TopMailDtoInterface
     * @throws \Exception
     */
    public function getDtoByUrl(string $url): TopMailDtoInterface
    {
        $crawler = new Crawler(file_get_contents($url));

        $rows = $crawler->filter('form#select table.Rating tr');

        if (!$rows->count()) {
            throw new \Exception('На стрнаице не найдено записей рейтинка, ' . $url);
        }

        $dto = new TopMailDto();

        $rows->each(function (Crawler $rowCrawler) use ($dto) {
            $tds = $rowCrawler->filter('td');
            if (!$tds->count()) {
                return;
            }
            $rating = (int)$tds->eq(0)->text();
            if (!$rating) {
                return;
            }
            $statContent = $tds->eq(0)->filter('img')->attr('src');
            $stat = (bool)strstr($statContent, 'stat');
            $lock = (bool)strstr($statContent, 'lock');
            if ($stat === $lock) {
                throw new \Exception('Не определен статус доступности статистики');
            }

            $headAnchors = $tds->eq(1)->filter('a');

            $statsUrl = 'https://top.mail.ru' . $headAnchors->eq(0)->attr('href');

            $visitors = (int)str_replace([',',' '], '', $tds->eq(2)->filter('b')->text());
            $hits = (int)str_replace([',',' '], '', $tds->eq(3)->html());

            $dto->appendSite(new TopMailSiteDto(
                'top.mail.ru',
                $rating,
                $statsUrl,
                $headAnchors->eq(1)->attr('href'),
                $headAnchors->eq(0)->text(),
                $stat,
                $visitors,
                $hits,
                $headAnchors->eq(2)->text()
            ));
        });

        return $dto;
    }

    public function storeDto(TopMailDtoInterface $dto)
    {
        /** @var TopMailSiteDtoInterface $site */
        foreach ($dto->getSites() as $site) {
            $siteModel = Site::findOrCreateBySiteDto($site);
            \App\Models\SiteInfo::findOrCreateBySiteInfoDto($siteModel->id, $site);
            \App\Models\SiteStat::createBySiteDto($siteModel->id, $site);
        }
    }
}
