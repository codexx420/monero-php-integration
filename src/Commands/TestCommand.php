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

		$data = $connection->_run("get_account_tags");
		print_r($data);

		//$connection->tagAccounts("day1",[0,1,2,3]);
		//$data = $connection->createAccount("acab");
		//$output->writeln("Index " . $data->getIndex() . " Address:" . $data->getAddress());

		/*
		foreach($data->getSubaddressAccounts() as $subAddressAccount) {
			$output->writeln("Balance: " . $subAddressAccount->getBalance() . " (address: " . $subAddressAccount->getAddress());
		}
		*/



		$output->writeln("");
		$output->writeln("END");
	}
}