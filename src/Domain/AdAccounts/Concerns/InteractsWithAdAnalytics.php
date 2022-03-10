<?php

namespace EolabsIo\PinterestApi\Domain\AdAccounts\Concerns;

use Illuminate\Support\Carbon;

trait InteractsWithAdAnalytics
{
    /** @var array */
    private $adAnalyticParameters = [];


    public function withStartDate(Carbon $date): self
    {
        //  YYYY-MM-DD
        $this->adAnalyticParameters['start_date'] = $date->format('Y-m-d');

        return $this;
    }


    public function withEndDate(Carbon $date): self
    {
        //  YYYY-MM-DD
        $this->adAnalyticParameters['end_date'] = $date->format('Y-m-d');

        return $this;
    }

    public function withAdIds(array $ids): self
    {
        $this->adAnalyticParameters['ad_ids'] = implode(',', $ids);

        return $this;
    }


    public function withColumns(array $columns): self
    {
        $this->adAnalyticParameters['columns'] = implode(',', $columns);

        return $this;
    }


    public function withGranularity(string $granularity): self
    {
        $this->adAnalyticParameters['granularity'] = $granularity;

        return $this;
    }

    public function withClickWindowDays(int $clickWindowDays): self
    {
        $this->adAnalyticParameters['click_window_days'] = $clickWindowDays;

        return $this;
    }

    public function withEngagementWindowDays(int $engagementWindowDays): self
    {
        $this->adAnalyticParameters['engagement_window_days'] = $engagementWindowDays;

        return $this;
    }

    public function withViewWindowDays(int $viewWindowDays): self
    {
        $this->adAnalyticParameters['view_window_days'] = $viewWindowDays;

        return $this;
    }

    public function withConversionReportTime(string $conversionReportTime): self
    {
        $this->adAnalyticParameters['conversion_report_time'] = $conversionReportTime;

        return $this;
    }

    public function getAdAnalyticParameters(): array
    {
        return $this->adAnalyticParameters;
    }
}
