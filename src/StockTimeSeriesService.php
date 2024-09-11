<?php declare(strict_types = 1);

namespace Api\StockTimeSeries;

use Api\Core\Service;
use Api\Core\ServiceRequest;

final class StockTimeSeriesService extends Service
{

	public const TimeSeriesLink = '/api/timeseries-service/time-series';

	public function timeSeries(string $symbol, TimeSeriesRange $range): ServiceRequest
	{
		return $this->requestGet(self::TimeSeriesLink . '/' . $symbol, [
			'range' => $range->value,
		]);
	}

}
