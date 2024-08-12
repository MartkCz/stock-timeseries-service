<?php declare(strict_types = 1);

namespace Api\StockTimeSeries;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class StockTimeSeriesService
{

	public const TimeSeriesLink = '/api/timeseries-service/time-series';

	private HttpClientInterface $httpClient;

	public function __construct(
		private string $baseUrl,
		?HttpClientInterface $httpClient,
	)
	{
		$this->httpClient = $httpClient ?? HttpClient::create();
	}

	public function getTimeSeries(string $symbol, TimeSeriesRange $range): array
	{
		$response = $this->httpClient->request('GET', $this->buildUrl(self::TimeSeriesLink . '/' . $symbol, [
			'range' => $range->value,
		]));

		return $response->toArray();
	}

	/**
	 * @param array<string, scalar> $params
	 */
	private function buildUrl(string $path, array $params = []): string
	{
		$url = $this->baseUrl . $path;

		if (count($params) > 0) {
			$url .= '?' . http_build_query($params);
		}

		return $url;
	}

}
