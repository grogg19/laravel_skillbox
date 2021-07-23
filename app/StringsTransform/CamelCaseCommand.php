<?php

namespace App\StringsTransform;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class CamelCaseCommand extends Command
{
    protected $requireContent;

    /**
     * конфигурация
     */
    protected function configure()
    {
        $this
            ->setName('change_case')
            ->setDescription('Меняет нечетные символы на заглавные, а четные на прописные')
            ->addArgument('content', InputArgument::REQUIRED, 'Строка для трансформации')
            ->addOption('odd', null, InputOption::VALUE_NONE, 'сделать большими чётные буквы')
            ->addOption('even', null, InputOption::VALUE_NONE, 'сделать большими нечётные буквы')
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $flag = empty($input->getOption('odd'));

        $result = (new CamelCase($input->getArgument('content'), $flag))->transform();
        $output->writeln($result);

        return Command::SUCCESS;
    }
}
