<?php

declare(strict_types=1);

namespace Doskyft\CsvHelper\Converter;

use Doskyft\CsvHelper\ColumnDefinition;
use Doskyft\CsvHelper\Types;

class ArrayConverter extends AbstractConverter
{
    public function convertValue(string $value): array
    {
        return (array) $value;
    }

    public function getType(): string
    {
        return Types::ARRAY;
    }
}