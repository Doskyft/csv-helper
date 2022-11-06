<?php

declare(strict_types=1);

namespace Doskyft\CsvHelper\Converter;

abstract class AbstractConverter implements ConverterInterface
{
    protected static array $defaultOptions = [];

    private array $converterOptions = [];

    public function __construct()
    {
        $this->setConverterOptions(self::$defaultOptions);
    }

    public function getConverterOptions(): array
    {
        return $this->converterOptions;
    }

    public function setConverterOptions(array $converterOptions): self
    {
        $this->converterOptions = $converterOptions;

        return $this;
    }
}