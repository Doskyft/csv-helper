# csv-helper

## Installation
```bash
composer require doskyft/csv-helper
```

## Usage
```php
use Doskyft\CsvHelper\ColumnDefinition;
use Doskyft\CsvHelper\Csv;
use Doskyft\CsvHelper\Types;

$csv = new Csv();

$csv
    ->setColumnSeparator(',')
    ->setColumns([
        ColumnDefinition::new('a_string_columns', Types::STRING),
        ColumnDefinition::new('a_bool_columns', Types::BOOLEAN)
            ->setConverterOptions([
                'falseValues' => ['false', 'not true', '...'],
            ]),
    ])
    ->setAllColumnsIsNeeded(false)
    ->setTrim(false)
;

$results = $csv->readFromString('
    a_string_columns,a_bool_columns
    value,not true
    value 2,true        
');
```