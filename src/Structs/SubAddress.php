<?php
/**
 * ONE Developments
 */

namespace Monero\Structs;


class SubAddress
{
	/** @var string $address */
	private $address;

	/** @var string $label */
	private $label;

	/** @var int $addressIndex */
	private $addressIndex;

	/** @var bool $used */
	private $used;

	/**
	 * SubAddress constructor.
	 * @param string $address
	 * @param string $label
	 * @param int $addressIndex
	 * @param bool $used
	 */
	public function __construct(string $address, string $label, int $addressIndex, bool $used)
	{
		$this->address = $address;
		$this->label = $label;
		$this->addressIndex = $addressIndex;
		$this->used = $used;
	}

	/**
	 * @return string
	 */
	public function getAddress(): string
	{
		return $this->address;
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
	public function getAddressIndex(): int
	{
		return $this->addressIndex;
	}

	/**
	 * @return bool
	 */
	public function isUsed(): bool
	{
		return $this->used;
	}

}