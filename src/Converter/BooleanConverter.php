<?php

declare(strict_types=1);

namespace Doskyft\CsvHelper\Converter;

use Doskyft\CsvHelper\ColumnDefinition;
use Doskyft\CsvHelper\Types;

class BooleanConverter extends AbstractConverter
{
    protected static array $defaultOptions = [
        'falseValues' => [false, 'false', 'no', 'No', 0, '0', null, 'null'],
    ];

    public function convertValue(string $value): bool
    {
        return !(!$value || in_array($value, $this->getConverterOptions()['falseValues'], true));
    }

    public function getType(): string
    {
        return Types::BOOLEAN;
    }
}