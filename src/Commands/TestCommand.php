<?php

namespace Monero\Commands;

use Monero\Components\MoneroConnection;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TestCommand extends Command
{
	protected function configure()
	{
		$this
			->setName("mo:test")
		;
	}

	/**
	 * @param InputInterface $input
	 * @param OutputInterface $output
	 * @return int|void|null
	 */
	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$output->writeln("Starting command");
		$connection = new MoneroConnection("localhost",18001,"http","demo","demo");

		//$data = $connection->_run("get_accounts");
		//print_r($data);

		//$connection->labelAddress(393,0,"test1111");
		$data = $connection->getAccounts();
		$output->writeln("Total Balance" . $data->getTotalBalance());


		foreach($data->getSubaddressAccounts() as $subAddressAccount) {
			$output->writeln("Balance: " . $subAddressAccount->getBalance() . " (address: " . $subAddressAccount->getAddress());
		}



		$output->writeln("");
		$output->writeln("END");
	}
}