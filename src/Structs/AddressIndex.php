<?php
/**
 * ONE Developments
 */

namespace Monero\Structs;


class AddressIndex
{
	/** @var int $accountIndex */
	private $accountIndex;

	/** @var int $addressIndex */
	private $addressIndex;

	/**
	 * AddressIndex constructor.
	 * @param int $accountIndex
	 * @param int $addressIndex
	 */
	public function __construct(int $accountIndex, int $addressIndex)
	{
		$this->accountIndex = $accountIndex;
		$this->addressIndex = $addressIndex;
	}

	/**
	 * @return int
	 */
	public function getAccountIndex(): int
	{
		return $this->accountIndex;
	}

	/**
	 * @return int
	 */
	public function getAddressIndex(): int
	{
		return $this->addressIndex;
	}

}