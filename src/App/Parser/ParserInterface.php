<?php declare(strict_types=1);

namespace App\Parser;

use App\Util\OptionsBagInterface;
use Iterator;

interface ParserInterface
{

    /**
     * @param resource $inputStream
     * @return Iterator<mixed>
     */
    public function parse($inputStream): Iterator;

    /**
     * @param resource $inputStream
     * @param OptionsBagInterface $options Parser specific options
     * @return Iterator<mixed>
     */
    public function parseWithOptions($inputStream, OptionsBagInterface $options): Iterator;
}
