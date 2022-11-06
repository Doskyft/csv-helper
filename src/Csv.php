<?php

declare(strict_types=1);

namespace Doskyft\CsvHelper;

use Doskyft\CsvHelper\Exception\NotCorrectColumnsException;

class Csv
{
    private bool $allColumnsIsNeeded = true;
    private bool $trim = true;

    /**
     * @param array<ColumnDefinition> $columns
     */
    public function __construct(
        private string $rowSeparator = "\n",
        private string $columnSeparator = ',',
        private array $columns = []
    ) {
    }

    public function getRowSeparator(): string
    {
        return $this->rowSeparator;
    }

    public function setRowSeparator(string $rowSeparator): self
    {
        $this->rowSeparator = $rowSeparator;

        return $this;
    }

    public function getColumnSeparator(): string
    {
        return $this->columnSeparator;
    }

    public function setColumnSeparator(string $columnSeparator): self
    {
        $this->columnSeparator = $columnSeparator;

        return $this;
    }

    public function getColumns(): array
    {
        return $this->columns;
    }

    public function setColumns(array $columns): self
    {
        $this->columns = $columns;

        return $this;
    }

    public function isAllColumnsIsNeeded(): bool
    {
        return $this->allColumnsIsNeeded;
    }

    public function setAllColumnsIsNeeded(bool $allColumnsIsNeeded): self
    {
        $this->allColumnsIsNeeded = $allColumnsIsNeeded;

        return $this;
    }

    public function isTrim(): bool
    {
        return $this->trim;
    }

    public function setTrim(bool $trim): void
    {
        $this->trim = $trim;
    }

    /**
     * @throws NotCorrectColumnsException
     */
    public function readFromString(string $data): array
    {
        $results = [];
        $rows = explode("\n", $data);

        foreach ($rows as $rowNumber => $row) {
            $cells = explode($this->getColumnSeparator(), $row);

            if (array_key_first($rows) === $rowNumber) {
                $this->setPositionColumns($cells);
            } else {
                $columns = array_filter(
                    $this->getColumns(),
                    static fn (ColumnDefinition $columnDefinition) => null !== $columnDefinition->getPosition()
                );

                $result = [];

                foreach ($columns as $column) {
                    $cell = trim($cells[$column->getPosition()]);

                    $result[$column->getName()] = $column->getConvertedValue($cell);
                }

                $results[] = $result;
            }
        }

        return $results;
    }

    /**
     * @throws NotCorrectColumnsException
     */
    private function setPositionColumns(array $data): void
    {
        foreach ($this->getColumns() as $column) {
            foreach ($data as $key => $cell) {
                if ($column->getName() === trim($cell)) {
                    $column->setPosition($key);
                }
            }

            if ($this->isAllColumnsIsNeeded() && $column->getPosition() === null) {
                throw new NotCorrectColumnsException(sprintf('"%s" not found in data', $column->getName()));
            }
        }
    }
}
