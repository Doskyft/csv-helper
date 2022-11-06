<?php

declare(strict_types=1);

namespace Doskyft\CsvHelper\Converter;

use Doskyft\CsvHelper\ColumnDefinition;
use Doskyft\CsvHelper\Types;

class IntegerConverter extends AbstractConverter
{
    public function convertValue(string $value): int
    {
        return (int) $value;
    }

    public function getType(): string
    {
        return Types::INTEGER;
    }
}