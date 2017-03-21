<?php
/**
 * Created by PhpStorm.
 * User: mazury
 * Date: 24.03.15
 * Time: 18:21
 */

namespace Mazury\Converter;


interface ConverterInterface
{
    public function read($inputFile);

    public function write($outputFile);

}