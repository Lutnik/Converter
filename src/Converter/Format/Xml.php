<?php
/**
 * Created by PhpStorm.
 * User: mazury
 * Date: 24.03.15
 * Time: 19:22
 */

namespace Mazury\Converter\Format;


use Mazury\Converter\ConverterAbstract;
use Mazury\Converter\ConverterInterface;

final class Xml extends ConverterAbstract implements ConverterInterface
{
    /**
     * Odczyt pliku XML
     *
     * @param $inputFile
     */
    public function read($inputFile)
    {
        $content = array();
        $rows = simplexml_load_file($inputFile);
        foreach ($rows as $cols) {
            $temp = array();
            foreach ($cols as $col) {
                $temp[] = (string)$col;
            }
            $content[] = $temp;
        }
        $this->setContent($content);
    }

    /**
     * Zapis pliku XML
     *
     * @param $outputFile
     */
    public function write($outputFile)
    {
        $this->prepareDir($outputFile);
        file_put_contents($outputFile, $this->prepareXmlContent());
    }

    /**
     * Przygotowanie zawartości XML
     *
     * @return string
     */
    private function prepareXmlContent()
    {
        $xmlWriter = new \XMLWriter();
        $xmlWriter->openMemory();
        $xmlWriter->startDocument('1.0', 'UTF-8');
        $xmlWriter->setIndent(true);
        $xmlWriter->startElement('rows');
        foreach ($this->getContent() as $row) {
            $xmlWriter->startElement('row');
            foreach ($row as $column) {
                $xmlWriter->writeElement('col', $column);
            }
            $xmlWriter->endElement();
        }
        $xmlWriter->endElement();
        return $xmlWriter->outputMemory();
    }

    /**
     * @return string
     */
    public function __toString() {
        return $this->prepareXmlContent();
    }

}