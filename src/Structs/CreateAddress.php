<?php

namespace Monero\Structs;

class CreateAddress
{
	/** @var string $address */
	private $address;

	/** @var int $accountIndex */
	private $accountIndex;

	/**
	 * CreateAddressResult constructor.
	 * @param string $address
	 * @param int $accountIndex
	 */
	public function __construct(string $address, int $accountIndex)
	{
		$this->address = $address;
		$this->accountIndex = $accountIndex;
	}

	/**
	 * @return string
	 */
	public function getAddress(): string
	{
		return $this->address;
	}

	/**
	 * @return int
	 */
	public function getAccountIndex(): int
	{
		return $this->accountIndex;
	}


}