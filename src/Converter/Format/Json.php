<?php
/**
 * Created by PhpStorm.
 * User: mazury
 * Date: 24.03.15
 * Time: 18:42
 */

namespace Mazury\Converter\Format;


use Mazury\Converter\ConverterAbstract;
use Mazury\Converter\ConverterInterface;

final class Json extends ConverterAbstract implements ConverterInterface
{
    /**
     * Odczyt pliku json
     *
     * @param $inputFile
     */
    public function read($inputFile)
    {
        $this->setContent(json_decode(file_get_contents($inputFile), true));
    }

    /**
     * Zapis pliku json
     *
     * @param $outputFile
     */
    public function write($outputFile)
    {
        $this->prepareDir($outputFile);
        file_put_contents($outputFile, json_encode($this->getContent()));
    }

    /**
     * @return string
     */
    public function __toString() {
        return json_encode($this->getContent());
    }
}