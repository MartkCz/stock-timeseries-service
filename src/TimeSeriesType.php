<?php declare(strict_types = 1);

namespace Api\StockTimeSeries;

enum TimeSeriesType: string
{

    case Short = 'short';
    case Long = 'long';

}
