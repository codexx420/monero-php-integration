<?php
/**
 * ONE Developments
 */

namespace Monero\Structs;


class Account
{
	/** @var int $index */
	private $index;

	/** @var string $label */
	private $label;

	/** @var string $address */
	private $address;

	/**
	 * Account constructor.
	 * @param int $index
	 * @param string $label
	 * @param string $address
	 */
	public function __construct(int $index, string $label, string $address)
	{
		$this->index = $index;
		$this->label = $label;
		$this->address = $address;
	}

	/**
	 * @return int
	 */
	public function getIndex(): int
	{
		return $this->index;
	}

	/**
	 * @return string
	 */
	public function getLabel(): string
	{
		return $this->label;
	}

	/**
	 * @return string
	 */
	public function getAddress(): string
	{
		return $this->address;
	}


}