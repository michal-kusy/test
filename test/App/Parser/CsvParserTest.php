<?php declare(strict_types=1);

namespace App\Parser;

use App\Util\OptionsBag;
use PHPUnit\Framework\TestCase;
use RuntimeException;

class CsvParserTest extends TestCase
{

    public function testParseSimpleDefaultCsv(): void
    {
        $expected = [["1","2","3"],["4","5","6"],["7","8","9"]];

        $parser = new CsvParser();
        $stream = fopen($this->getFixtureFile('simple.csv'), 'rb');
        if ($stream === false) {
            throw new RuntimeException("Cannot read fixture simple.csv!");
        }

        $iterator = $parser->parse($stream);
        $result = iterator_to_array($iterator);

        $this->assertEquals($expected, $result);

        fclose($stream);
    }

    public function testParseSimpleSemicolonCsv(): void
    {
        $expected = [["1","2","3"],["4","5","6"],["7","8","9"]];

        $parser = new CsvParser();
        $stream = fopen($this->getFixtureFile('simple_semicolon.csv'), 'rb');
        if ($stream === false) {
            throw new RuntimeException("Cannot read fixture simple.csv!");
        }

        $iterator = $parser->parseWithOptions($stream, new OptionsBag([CsvParserOptionsEnum::DELIMITER => ';']));
        $result = iterator_to_array($iterator);

        $this->assertEquals($expected, $result);

        fclose($stream);
    }

    // TODO error test cases


    private function getFixtureFile(string $name): string
    {
        return __DIR__  . '/_fixtures/' . $name;
    }
}
