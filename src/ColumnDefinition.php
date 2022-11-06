<?php

declare(strict_types=1);

namespace Doskyft\CsvHelper;

use Doskyft\CsvHelper\Converter\ConverterInterface;

class ColumnDefinition
{
    private ?int $position = null;
    private ConverterInterface $converter;

    public function __construct(
        private readonly string $name,
        private readonly ?string $type = null,
    ) {
        $typeConverterClassName = 'Doskyft\\CsvHelper\\Converter\\'.ucfirst($type).'Converter';
        $this->converter = new $typeConverterClassName();
    }

    public static function new(string $name, $type = Types::STRING): self
    {
        return new self($name, $type);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(?int $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getConverter(): ConverterInterface
    {
        return $this->converter;
    }

    public function setConverter(ConverterInterface $converter): self
    {
        $this->converter = $converter;

        return $this;
    }

    public function getConvertedValue(mixed $value): mixed
    {
        return $this->getConverter()->convertValue($value);
    }

    public function setConverterOptions(array $converterOptions): self
    {
        $this->getConverter()->setConverterOptions($converterOptions);

        return $this;
    }
}