<?php

declare(strict_types=1);

namespace Doskyft\CsvHelper\Converter;

use Doskyft\CsvHelper\ColumnDefinition;
use Doskyft\CsvHelper\Types;

class EnumConverter extends AbstractConverter
{
    protected static array $defaultOptions = [
        'enum' => null,
        'internalConvertFunction' => null,
    ];

    public function convertValue(string $value): ?object
    {
        $enum = $this->getConverterOptions()['enum'];

        if ($enum::tryFrom($value)) {
            return $enum::tryFrom($value);
        }

        if (!$internalConvertFunction = $this->getConverterOptions()['internalConvertFunction']) {
            return null;
        }

        return $enum::$internalConvertFunction($value);
    }

    public function getType(): string
    {
        return Types::ENUM;
    }
}