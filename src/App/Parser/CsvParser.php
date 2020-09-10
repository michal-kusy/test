<?php declare(strict_types=1);

namespace App\Parser;

use App\Util\OptionsBag;
use App\Util\OptionsBagInterface;
use Iterator;

class CsvParser implements ParserInterface
{

    protected const DEFAULT_BUFFER = 65535;
    protected const DEFAULT_DELIMITER = ',';
    protected const DEFAULT_ESCAPE = '\\';
    protected const DEFAULT_ENCLOSURE = '"';


    /**
     * @param resource $inputStream
     * @return Iterator<string[]>
     */
    public function parse($inputStream): Iterator
    {
        return $this->parseWithOptions($inputStream, new OptionsBag());
    }

    public function parseWithOptions($inputStream, OptionsBagInterface $options): Iterator
    {
        while ($line = $this->readCsvLine($inputStream, $options)) {
            yield $line;
        }
    }

    /**
     * @param resource $inputStream
     * @return string[]
     */
    private function readCsvLine($inputStream, OptionsBagInterface $options): array
    {
        $line = fgetcsv(
            $inputStream,
            $options->getInt(CsvParserOptionsEnum::BUFFER, self::DEFAULT_BUFFER),
            $options->getString(CsvParserOptionsEnum::DELIMITER, self::DEFAULT_DELIMITER),
            $options->getString(CsvParserOptionsEnum::ENCLOSURE, self::DEFAULT_ENCLOSURE),
            $options->getString(CsvParserOptionsEnum::ESCAPE, self::DEFAULT_ESCAPE)
        );

        // TODO handle errors and empty lines

        return ($line === false || $line === null) ? [] : $line;
    }
}
