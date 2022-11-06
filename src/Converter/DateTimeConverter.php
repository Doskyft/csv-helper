<?php

declare(strict_types=1);

namespace Doskyft\CsvHelper\Converter;

use DateTime;
use DateTimeInterface;
use Doskyft\CsvHelper\Types;

class DateTimeConverter extends AbstractConverter
{
    protected static array $defaultOptions = [
        'format' => DateTimeInterface::ATOM,
    ];

    public function convertValue(string $value): DateTime
    {
        return DateTime::createFromFormat($this->getConverterOptions()['format'], $value);
    }

    public function getType(): string
    {
        return Types::DATETIME;
    }
}