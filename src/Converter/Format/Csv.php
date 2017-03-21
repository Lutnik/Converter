<?php
/**
 * Created by PhpStorm.
 * User: mazury
 * Date: 24.03.15
 * Time: 20:29
 */

namespace Mazury\Converter\Format;


use League\Csv\Reader;
use League\Csv\Writer;
use Mazury\Converter\ConverterAbstract;
use Mazury\Converter\ConverterInterface;
use SplTempFileObject;


final class Csv extends ConverterAbstract implements ConverterInterface
{
    /**
     * Odczyt pliku CSV
     *
     * @param $inputFile
     */
    public function read($inputFile)
    {
        $csv = Reader::createFromPath($inputFile);
        $content = $csv
            ->addFilter(
                function ($row) {
                    return count($row) == 3;
                }
            )
            ->fetchAll();
        $this->setContent($content);
    }

    /**
     * Zapis do pliku CSV
     *
     * @param $outputFile
     */
    public function write($outputFile)
    {
        $this->prepareDir($outputFile);
        $csv = Writer::createFromFileObject(new SplTempFileObject());
        $csv->insertAll($this->getContent());
        file_put_contents($outputFile, $csv);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $csv = Writer::createFromFileObject(new SplTempFileObject());
        $csv->insertAll($this->getContent());
        return (string)$csv;
    }
}