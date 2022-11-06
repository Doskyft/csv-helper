<?php

declare(strict_types=1);

namespace Doskyft\CsvHelper\Converter;

use Doskyft\CsvHelper\ColumnDefinition;
use Doskyft\CsvHelper\Types;

class FloatConverter extends AbstractConverter
{
    public function convertValue(string $value): float
    {
        return (float) $value;
    }

    public function getType(): string
    {
        return Types::FLOAT;
    }
}