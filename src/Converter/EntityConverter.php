<?php

declare(strict_types=1);

namespace Doskyft\CsvHelper\Converter;

use Doskyft\CsvHelper\Exception\ConverterOptionNotSetException;
use Doskyft\CsvHelper\Types;

class EntityConverter extends AbstractConverter
{
    protected static array $defaultOptions = [
        'find' => null, // a callable
    ];

    /**
     * @throws ConverterOptionNotSetException
     */
    public function convertValue(string $value): ?object
    {
        if (!$find = $this->getConverterOptions()['find']) {
            throw new ConverterOptionNotSetException('find option is required');
        }

        return $find($value);
    }

    public function getType(): string
    {
        return Types::ENTITY;
    }
}