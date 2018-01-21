<?php

namespace App\Services\TopMail;


class TopMailSiteDto implements TopMailSiteDtoInterface
{
    protected $ratingSite;
    protected $rating;
    protected $statsUrl;
    protected $siteUrl;
    protected $siteTitle;
    protected $statsAvailable;
    protected $visitors;
    protected $hits;
    protected $category;
    protected $schema;
    protected $host;

    public function __construct(
        string $ratingSite,
        int $rating,
        string $statsUrl,
        string $siteUrl,
        string $siteTitle,
        bool $statsAvailable,
        int $visitors,
        int $hits,
        string $category
    )
    {
        $this->ratingSite = trim($ratingSite);
        $this->rating = $rating;
        $this->statsUrl = trim($statsUrl);
        $this->siteUrl = trim($siteUrl);
        $this->siteTitle = trim($siteTitle);
        $this->statsAvailable = $statsAvailable;
        $this->visitors = $visitors;
        $this->hits = $hits;
        $this->category = trim($category);

        $this->schema = trim(strtolower(parse_url($this->siteUrl, PHP_URL_SCHEME)));
        $this->host = trim(strtolower(parse_url($this->siteUrl, PHP_URL_HOST)));
    }

    /**
     * @return string
     */
    public function getRatingSite(): string
    {
        return $this->ratingSite;
    }

    /**
     * @return int
     */
    public function getRating(): int
    {
        return $this->rating;
    }

    /**
     * @return string
     */
    public function getStatsUrl(): string
    {
        return $this->statsUrl;
    }

    /**
     * @return string
     */
    public function getSiteUrl(): string
    {
        return $this->siteUrl;
    }

    /**
     * @return string
     */
    public function getSiteTitle(): string
    {
        return $this->siteTitle;
    }

    /**
     * @return bool
     */
    public function isStatsAvailable(): bool
    {
        return $this->statsAvailable;
    }

    /**
     * @return int
     */
    public function getVisitors(): int
    {
        return $this->visitors;
    }

    /**
     * @return int
     */
    public function getHits(): int
    {
        return $this->hits;
    }

    /**
     * @return string
     */
    public function getCategory(): string
    {
        return $this->category;
    }

    public function getSchema(): string
    {
        return $this->schema;
    }

    public function getHost(): string
    {
        return $this->host;
    }
}
