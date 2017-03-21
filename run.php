<?php
require "vendor/autoload.php";
use Symfony\Component\Console\Application;
use Mazury\Console\Command\ConvertCommand;

$application = new Application();
$application->add(new ConvertCommand());
$application->run();

exit;

$html = new \Mazury\Converter\Format\Html();
$json = new \Mazury\Converter\Format\Json();
$xml = new \Mazury\Converter\Format\Xml();
$csv = new \Mazury\Converter\Format\Csv();

$html->read("input/example.html");
//$json->read("input/example.json");
//$xml->read("input/example.xml");
//$csv->read("input/example.csv");

$content = $html->getContent();
//$content = $json->getContent();
//$content = $xml->getContent();
//$content = $csv->getContent();

$output = "output/" . date("Ymd_His");

//$html->setContent($content)->write($output . ".html");
$json->setContent($content)->write($output . ".json");
//$xml->setContent($content)->write($output . ".xml");
//$csv->setContent($content)->write($output . ".csv");