<?php
/**
 * ONE Developments
 */

namespace Monero\Structs;


class AccountAddress
{
	/** @var string $address */
	private $address;

	/** @var SubAddress[] $subaddresses */
	private $subaddresses;

	/**
	 * Address constructor.
	 * @param string $address
	 * @param SubAddress[] $subaddresses
	 */
	public function __construct(string $address, array $subaddresses)
	{
		$this->address = $address;
		$this->subaddresses = $subaddresses;
	}

	/**
	 * @return string
	 */
	public function getAddress(): string
	{
		return $this->address;
	}

	/**
	 * @return SubAddress[]
	 */
	public function getSubaddresses(): array
	{
		return $this->subaddresses;
	}


}