<?php

namespace Mazury\Console\Command;

use Mazury\Converter\Format\Html;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\DescriptorHelper;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;


class ConvertCommand extends Command
{

    /**
     *
     */
    protected function configure()
    {
        $this
            ->setName('convert')
            ->setDefinition(
                new InputDefinition(array(
                    new InputOption('input', 'i', InputOption::VALUE_REQUIRED, 'Input format'),
                    new InputOption('output', 'o', InputOption::VALUE_REQUIRED, 'Output format')
                ))
            )
            ->setDescription('Converts into selected output format')
            ->setHelp('Helper...');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $inputClass = "\\Mazury\\Converter\\Format\\" . ucfirst(strtolower($input->getOption('input')));
        if (class_exists($inputClass)) {
            $inputObj = new $inputClass();
            $inputObj->read("input/example." . strtolower($input->getOption('input')));
            $content = $inputObj->getContent();
            $outputClass = "\\Mazury\\Converter\\Format\\" . ucfirst(strtolower($input->getOption('output')));
            if (class_exists($outputClass)) {
                $outputObj = new $outputClass();
                $outputFile = "output/" . date("Ymd_His") . "." . strtolower($input->getOption('output'));
                $outputObj->setContent($content)->write($outputFile);
                $output->writeln("Converting {$input->getOption('input')} into {$input->getOption('output')} ({$outputFile}).");
                return;
            }
        }
        $helper = new DescriptorHelper();
        $helper->describe($output, $this->getApplication(), array(
            'input' => $input->getOption('input'),
            'output' => $input->getOption('output')
        ));
    }

}
