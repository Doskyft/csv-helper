<?php

declare(strict_types=1);

namespace Doskyft\CsvHelper\Converter;

interface ConverterInterface
{
    public function convertValue(string $value): mixed;

    public function getType(): string;
}