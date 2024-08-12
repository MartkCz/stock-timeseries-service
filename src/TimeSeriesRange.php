<?php declare(strict_types = 1);

namespace Api\StockTimeSeries;

use Api\StockTimeSeries\TimeSeriesType;
use DateTimeInterface;

enum TimeSeriesRange: string
{

    case Day = '1D';
    case FiveDays = '5D';
    case Month = '1M';
    case SixMonths = '6M';
    case Year = '1Y';
    case YTD = 'YTD';
    case FiveYears = '5Y';
    case Max = 'MAX';

    private const Config = [
        '1M' => [
            'min' => '- 1 month',
            'step' => 1,
        ],
        '6M' => [
            'min' => '- 6 months',
            'step' => 1,
        ],
        '1Y' => [
            'min' => '- 1 year',
            'step' => 1,
        ],
        '5Y' => [
            'min' => '- 5 years',
            'step' => 7,
        ],
        'MAX' => [
            'min' => '- 30 years',
            'step' => 7,
        ],
    ];

    public function isShort(): bool
    {
        return self::Day === $this || self::FiveDays === $this;
    }

    /**
     * @return array{ min: string, step: int }|null
     */
    public function getConfig(): ?array
    {
        if ($this === self::YTD) {
            return [
                'min' => sprintf('first day of January %s', date('Y')),
                'step' => 1,
            ];
        }

        return self::Config[$this->value] ?? null;
    }

    public function getType(): TimeSeriesType
    {
        return $this->isShort() ? TimeSeriesType::Short : TimeSeriesType::Long;
    }

	public function getFormat(): string
	{
		return $this->isShort() ? DateTimeInterface::ATOM : 'Y-m-d\TH:i:s';
	}

}
