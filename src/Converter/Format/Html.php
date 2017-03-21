<?php
/**
 * Created by PhpStorm.
 * User: mazury
 * Date: 24.03.15
 * Time: 18:32
 */

namespace Mazury\Converter\Format;


use DOMDocument;
use Mazury\Converter\ConverterAbstract;
use Mazury\Converter\ConverterInterface;

final class Html extends ConverterAbstract implements ConverterInterface
{
    /**
     * Odczyt pliku HTML
     *
     * @param $inputFile
     */
    public function read($inputFile)
    {
        $source = file_get_contents($inputFile);
        $content = array();
        if (preg_match_all("#<tr[^>]*>(.*)</tr>#Us", $source, $trMatches) && isset($trMatches[1])) {
            $trInnerArray = $trMatches[1];
            foreach ($trInnerArray as $trMatch) {
                if (preg_match_all("#<td[^>]*>([^<]*)</td>#Us", $trMatch, $tdMatches) && isset($tdMatches[1])) {
                    $tdInnerArray = $tdMatches[1];
                    $rowArray = array();
                    foreach ($tdInnerArray as $tdInnerValue) {
                        $rowArray[] = $tdInnerValue;
                    }
                    $content[] = $rowArray;
                }
            }
        }
        $this->setContent($content);
    }

    /**
     * Zapis pliku HTML
     *
     * @param $outputFile
     */
    public function write($outputFile)
    {
        $this->prepareDir($outputFile);
        file_put_contents($outputFile, $this->prepareHtmlContent());
    }

    /**
     * Przygotowanie zawartości HTML
     *
     * @return string
     */
    private function prepareHtmlContent()
    {
        $doc = new DOMDocument('1.0', 'utf-8');
        $doc->formatOutput = true;
        $html = $doc->appendChild($doc->createElement('html'));
        $head = $html->appendChild($doc->createElement('head'));
        $meta = $head->appendChild($doc->createElement('meta'));
        $metaCharset = $doc->createAttribute('charset');
        $metaCharset->value = 'utf-8';
        $meta->appendChild($metaCharset);
        $title = $head->appendChild($doc->createElement('title'));
        $text = $title->appendChild($doc->createTextNode('Przykładowa tabela HTML'));
        $body = $html->appendChild($doc->createElement('body'));
        $table = $body->appendChild($doc->createElement('table'));
        foreach ($this->getContent() as $row) {
            $tr = $table->appendChild($doc->createElement('tr'));
            foreach ($row as $column) {
                $td = $tr->appendChild($doc->createElement('td'));
                $td->appendChild($doc->createTextNode($column));
            }
        }
        return html_entity_decode($doc->saveHTML(), ENT_QUOTES, "UTF-8");
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->prepareHtmlContent();
    }
}