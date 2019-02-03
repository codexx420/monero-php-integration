<?php

namespace Monero\Exceptions;

use Throwable;

class RpcException extends \Exception
{
	/** @var string $_rpcError */
	private $_rpcError;

	/**
	 * RpcException constructor.
	 * @param string $message
	 * @param int $code
	 * @param Throwable|null $previous
	 * @param string $rpcError
	 */
	public function __construct(
		string $rpcError,
		string $message = "",
		int $code = 0,
		Throwable $previous = null
	)
	{
		$this->_rpcError = $rpcError;
		parent::__construct($message, $code, $previous);
	}

	/**
	 * @return string
	 */
	public function getRpcError(): string
	{
		return $this->_rpcError;
	}
}