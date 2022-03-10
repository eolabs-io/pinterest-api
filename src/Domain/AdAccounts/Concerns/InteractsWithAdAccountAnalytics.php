<?php

namespace EolabsIo\PinterestApi\Domain\AdAccounts\Concerns;

use Illuminate\Support\Carbon;

trait InteractsWithAdAccountAnalytics
{
    /** @var array */
    private $adAccountAnalyticParameters = [];


    public function withStartDate(Carbon $date): self
    {
        //  YYYY-MM-DD
        $this->adAccountAnalyticParameters['start_date'] = $date->format('Y-m-d');

        return $this;
    }


    public function withEndDate(Carbon $date): self
    {
        //  YYYY-MM-DD
        $this->adAccountAnalyticParameters['end_date'] = $date->format('Y-m-d');

        return $this;
    }

    public function withColumns(array $columns): self
    {
        $this->adAccountAnalyticParameters['columns'] = implode(',', $columns);

        return $this;
    }


    public function withGranularity(string $granularity): self
    {
        $this->adAccountAnalyticParameters['granularity'] = $granularity;

        return $this;
    }

    public function withClickWindowDays(int $clickWindowDays): self
    {
        $this->adAccountAnalyticParameters['click_window_days'] = $clickWindowDays;

        return $this;
    }

    public function withEngagementWindowDays(int $engagementWindowDays): self
    {
        $this->adAccountAnalyticParameters['engagement_window_days'] = $engagementWindowDays;

        return $this;
    }

    public function withViewWindowDays(int $viewWindowDays): self
    {
        $this->adAccountAnalyticParameters['view_window_days'] = $viewWindowDays;

        return $this;
    }

    public function withConversionReportTime(string $conversionReportTime): self
    {
        $this->adAccountAnalyticParameters['conversion_report_time'] = $conversionReportTime;

        return $this;
    }

    public function getAdAccountAnalyticParameters(): array
    {
        return $this->adAccountAnalyticParameters;
    }
}
