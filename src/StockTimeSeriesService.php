<?php declare(strict_types = 1);

namespace Api\StockTimeSeries;

use Api\Core\Service;
use Api\Core\ServiceRequest;

final class StockTimeSeriesService extends Service
{

	public const TimeSeriesLink = '/api/timeseries-service/time-series';
	public const MultipleTimeSeriesLink = '/api/timeseries-service/time-series/multiple';

	public function timeSeries(string $symbol, TimeSeriesRange $range): ServiceRequest
	{
		return $this->requestGet(self::TimeSeriesLink . '/' . $symbol, [
			'range' => $range->value,
		]);
	}

	/**
	 * @param string[] $symbols
	 */
	public function multipleTimeSeries(array $symbols, TimeSeriesRange $range): ServiceRequest
	{
		return $this->requestGet(self::MultipleTimeSeriesLink, [
			'symbols' => implode(',', $symbols),
			'range' => $range->value,
		]);
	}

}
