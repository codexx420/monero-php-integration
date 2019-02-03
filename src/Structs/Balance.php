<?php

namespace Monero\Structs;


class Balance
{
	/** @var string $balance */
	private $balance;

	/** @var bool $multiSigImportNeeded TODO */
	private $multiSigImportNeeded;

	/** @var SubBalance[] $subaddressResult */
	private $subaddressResult;

	/** @var string $unlockedBalance */
	private $unlockedBalance;

	/**
	 * BalanceResult constructor.
	 * @param string $balance
	 * @param bool $multiSigImportNeeded
	 * @param SubBalance[] $subaddressResult
	 * @param string $unlockedBalance
	 */
	public function __construct(string $balance, bool $multiSigImportNeeded, array $subaddressResult, string $unlockedBalance)
	{
		$this->balance = $balance;
		$this->multiSigImportNeeded = $multiSigImportNeeded;
		$this->subaddressResult = $subaddressResult;
		$this->unlockedBalance = $unlockedBalance;
	}

	/**
	 * @return string
	 */
	public function getBalance(): string
	{
		return $this->balance;
	}

	/**
	 * @return bool
	 */
	public function isMultiSigImportNeeded(): bool
	{
		return $this->multiSigImportNeeded;
	}

	/**
	 * @return SubBalance[]
	 */
	public function getSubaddressResult(): array
	{
		return $this->subaddressResult;
	}

	/**
	 * @return string
	 */
	public function getUnlockedBalance(): string
	{
		return $this->unlockedBalance;
	}
}