<?php

declare(strict_types=1);

namespace Doskyft\CsvHelper\Converter;

use Doskyft\CsvHelper\ColumnDefinition;
use Doskyft\CsvHelper\Types;

class StringConverter extends AbstractConverter
{
    public function convertValue(string $value): string
    {
        return $value;
    }

    public function getType(): string
    {
        return Types::STRING;
    }
}