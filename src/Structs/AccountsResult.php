<?php
/**
 * ONE Developments
 */

namespace Monero\Structs;


class AccountsResult
{
	/** @var SubBalance[] $subaddressAccounts */
	private $subaddressAccounts;

	/** @var string $totalBalance */
	private $totalBalance;

	/** @var string $totalUnlockedBalance */
	private $totalUnlockedBalance;

	/**
	 * AccountsResult constructor.
	 * @param SubBalance[] $subaddressAccounts
	 * @param string $totalBalance
	 * @param string $totalUnlockedBalance
	 */
	public function __construct(array $subaddressAccounts, string $totalBalance, string $totalUnlockedBalance)
	{
		$this->subaddressAccounts = $subaddressAccounts;
		$this->totalBalance = $totalBalance;
		$this->totalUnlockedBalance = $totalUnlockedBalance;
	}

	/**
	 * @return SubBalance[]
	 */
	public function getSubaddressAccounts(): array
	{
		return $this->subaddressAccounts;
	}

	/**
	 * @return string
	 */
	public function getTotalBalance(): string
	{
		return $this->totalBalance;
	}

	/**
	 * @return string
	 */
	public function getTotalUnlockedBalance(): string
	{
		return $this->totalUnlockedBalance;
	}


}