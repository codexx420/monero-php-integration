<?php
/**
 * ONE Developments
 */

namespace Monero\Structs;


class AccountTag
{
	/** @var $accountIndices int[] */
	private $accountIndices;

	/** @var string $tag */
	private $tag;

	/**
	 * AccountTag constructor.
	 * @param int[] $accountIndices
	 * @param string $tag
	 */
	public function __construct(array $accountIndices, string $tag)
	{
		$this->accountIndices = $accountIndices;
		$this->tag = $tag;
	}

	/**
	 * @return int[]
	 */
	public function getAccountIndices(): array
	{
		return $this->accountIndices;
	}

	/**
	 * @return string
	 */
	public function getTag(): string
	{
		return $this->tag;
	}
}