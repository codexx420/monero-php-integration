<?php
/**
 * ONE Developments
 */

namespace Monero\Structs;


class SubBalance
{
	/** @var string$address */
	private $address;
	/** @var int $addressIndex */
	private $addressIndex;
	/** @var string $balance */
	private $balance;
	/** @var string $label */
	private $label;
	/** @var int $numUnspentOutputs */
	private $numUnspentOutputs;
	/** @var string $unlockedBalance */
	private $unlockedBalance;
	/** @var int $accountIndex */
	private $accountIndex;

	/**
	 * SubBalanceResult constructor.
	 * @param string $address
	 * @param int $addressIndex
	 * @param string $balance
	 * @param string $label
	 * @param int $numUnspentOutputs
	 * @param string $unlockedBalance
	 */
	public function __construct(string $address, int $addressIndex, string $balance, string $label, int $numUnspentOutputs, string $unlockedBalance, int $accountIndex)
	{
		$this->address = $address;
		$this->addressIndex = $addressIndex;
		$this->balance = $balance;
		$this->label = $label;
		$this->numUnspentOutputs = $numUnspentOutputs;
		$this->unlockedBalance = $unlockedBalance;
		$this->accountIndex = $accountIndex;
	}

	/**
	 * @return int
	 */
	public function getAccountIndex(): int
	{
		return $this->accountIndex;
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
	public function getAddressIndex(): int
	{
		return $this->addressIndex;
	}

	/**
	 * @return string
	 */
	public function getBalance(): string
	{
		return $this->balance;
	}

	/**
	 * @return string
	 */
	public function getLabel(): string
	{
		return $this->label;
	}

	/**
	 * @return int
	 */
	public function getNumUnspentOutputs(): int
	{
		return $this->numUnspentOutputs;
	}

	/**
	 * @return string
	 */
	public function getUnlockedBalance(): string
	{
		return $this->unlockedBalance;
	}

}