<?php
/**
 * ONE Developments
 */

namespace Monero\Structs;


class Transfer
{
	/** @var string $amount */
	private $amount;

	/** @var string $fee */
	private $fee;

	/** @var string $txHash */
	private $txHash;

	/** @var string $txKey */
	private $txKey;

	/**
	 * Transfer constructor.
	 * @param string $amount
	 * @param string $fee
	 * @param string $txHash
	 * @param string $txKey
	 */
	public function __construct(string $amount, string $fee, string $txHash, string $txKey)
	{
		$this->amount = $amount;
		$this->fee = $fee;
		$this->txHash = $txHash;
		$this->txKey = $txKey;
	}

	/**
	 * @return string
	 */
	public function getAmount(): string
	{
		return $this->amount;
	}

	/**
	 * @return string
	 */
	public function getFee(): string
	{
		return $this->fee;
	}

	/**
	 * @return string
	 */
	public function getTxHash(): string
	{
		return $this->txHash;
	}

	/**
	 * @return string
	 */
	public function getTxKey(): string
	{
		return $this->txKey;
	}


}