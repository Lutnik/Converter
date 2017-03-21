<?php
/**
 * Created by PhpStorm.
 * User: mazury
 * Date: 24.03.15
 * Time: 18:29
 */

namespace Mazury\Converter;


abstract class ConverterAbstract
{
    private $content = array();

    /**
     * @return array
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param array $content
     * @return $this
     */
    public function setContent(array $content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * Tworzy katalogi z podanej ścieżki
     *  
     * @param $path
     */
    protected function prepareDir($path)
    {
        $dir = dirname($path);
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
    }

}