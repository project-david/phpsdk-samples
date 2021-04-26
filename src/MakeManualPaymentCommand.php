<?php namespace Console;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Console\Command;

class MakeManualPaymentCommand extends Command
{
    
    public function configure()
    {
        $this -> setName('makemanualpayment')
            -> setDescription('It records a manual payment made into the Gravity Legal system.')
            -> setHelp('This command allows you to submit a manual payment to Gravity Legal');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this -> makeManualPayment($input, $output);
        return 0;
    }
}
