<?php

namespace Monero\Components;

use Monero\Structs\Account;
use Monero\Structs\AccountAddress;
use Monero\Structs\AccountsResult;
use Monero\Structs\AccountTag;
use Monero\Structs\AddressIndex;
use Monero\Structs\Balance;
use Monero\Structs\CreateAddress;
use Monero\Structs\SubAddress;
use Monero\Structs\SubBalance;
use Monero\Structs\Transfer;

class MoneroConnection
{
	/** @var JsonRpcConnection $client */
	private $client;

	/** @var string $protocol */
	private $protocol;

	/** @var string $host */
	private $host;

	/** @var int $port */
	private $port;

	/** @var string $url */
	private $url;

	/** @var string $user */
	private $user;

	/** @var string $password */
	private $password;

	/**
	 *
	 * Start a connection with the the Monero daemon (monerod)
	 *
	 * @param  string  $host      Monero daemon IP hostname            (optional)
	 * @param  int     $port      Monero daemon port                   (optional)
	 * @param  string  $protocol  Monero daemon protocol (eg. 'http')  (optional)
	 * @param  string  $user      Monero daemon RPC username           (optional)
	 * @param  string  $password  Monero daemon RPC passphrase         (optional)
	 *
	 */
	function __construct(
		string $host = '127.0.0.1',
		int $port = 18081,
		string $protocol = 'http',
		string $user = null,
		string $password = null
	)
	{
		if (is_array($host)) { // Parameters passed in as object/dictionary
			$params = $host;

			if (array_key_exists('host', $params)) {
				$host = $params['host'];
			} else {
				$host = '127.0.0.1';
			}
			if (array_key_exists('port', $params)) {
				$port = $params['port'];
			}
			if (array_key_exists('protocol', $params)) {
				$protocol = $params['protocol'];
			}
			if (array_key_exists('user', $params)) {
				$user = $params['user'];
			}
			if (array_key_exists('password', $params)) {
				$password = $params['password'];
			}
		}

		$this->host = $host;
		$this->port = $port;
		$this->protocol = $protocol;
		$this->user = $user;
		$this->password = $password;

		$this->url = $protocol.'://'.$host.':'.$port.'/json_rpc';
		$this->client = new JsonRpcConnection($this->url, $this->user, $this->password);
	}

	/**
	 *
	 * Execute command via jsonRPCClient
	 *
	 * @param  string  $method  RPC method to call
	 * @param  string|array|null  $params  Parameters to pass  (optional)
	 *
	 * @return array
	 *
	 */
	public function _run(string $method, $params = null)
	{
		if (is_array($params)) {
			// unset null params
			foreach($params as $key => $value) {
				if (is_null($value) || (is_array($value) && count($value) == 0))
					unset($params[$key]);
			}
		}
		return $this->client->_run($method, $params);
	}

	/**
	 * @param int $accountIndex
	 * @param array $addressIndex
	 * @return AccountAddress
	 */
	public function getAddress(int $accountIndex, array $addressIndex = [])  : AccountAddress {
		$data = $this->client->_run('get_address',['account_index' => $accountIndex,'address_index' => $addressIndex]);
		$subAddresses = [];
		foreach($data['addresses'] as $addressArr)
			$subAddresses[] = new SubAddress(
				$addressArr['address'],
				$addressArr['label'],
				$addressArr['address_index'],
				$addressArr['used']
			);
		return new AccountAddress($data['address'],$subAddresses);
	}

	/**
	 * @param string $address
	 * @return AddressIndex
	 */
	public function getAddressIndex(string $address) : AddressIndex {
		$data = $this->client->_run('get_address_index',['address' => $address])['index'];
		return new AddressIndex($data['major'],$data['minor']);
	}

	/**
	 * @param int $accountIndex
	 * @param array $addressIndices
	 * @return Balance
	 */
	public function getBalance(int $accountIndex,array $addressIndices = []) : Balance {
		$data = $this->_run('get_balance',['account_index' => $accountIndex, 'address_indices' => $addressIndices]);
		$subAddressResults = [];
		foreach($data['per_subaddress'] as $subadressArr)
			$subAddressResults[] = new SubBalance(
				$subadressArr['address'],
				$subadressArr['address_index'],
				MoneroCalculator::AtomToMonero($subadressArr['balance']),
				$subadressArr['label'],
				$subadressArr['num_unspent_outputs'],
				MoneroCalculator::AtomToMonero($subadressArr['unlocked_balance']),
				$accountIndex
			);
		return new Balance(
			MoneroCalculator::AtomToMonero($data['balance']),
			false,
			$subAddressResults,
			MoneroCalculator::AtomToMonero($data['unlocked_balance'])
		);
	}

	/**
	 * @return int
	 */
	public function getVersion() : int {
		return (int)$this->_run('get_version')['version'];
	}

	/**
	 * @param string|null $label
	 * @return Account
	 */
	public function createAccount(?string $label = null) : Account {
		$data = $this->_run('create_account',['label' => $label]);
		return new Account($data['account_index'],(string)$label,$data['address']);
	}

	/**
	 * @param int $accountIndex
	 * @param string $label
	 * @return CreateAddress
	 */
	public function createAddress(int $accountIndex, ?string $label = null) : CreateAddress {
		$data = $this->_run('create_address',['account_index' => $accountIndex, 'label' => $label]);
		return new CreateAddress($data['address'],$data['address_index']);
	}

	/**
	 * @param int $accountIndex
	 * @param int $addressIndex
	 * @param string $label
	 */
	public function labelAddress(int $accountIndex, int $addressIndex, string $label) {
		$this->_run('label_address',['index' => [$accountIndex,$addressIndex], 'label' => $label]);
	}

	/**
	 * @param int $accountIndex
	 * @param string $label
	 */
	public function labelAccount(int $accountIndex, string $label) {
		$this->_run('label_account',['account_index' => $accountIndex,'label' => $label]);
	}

	/**
	 * @param string|null $tag
	 * @return AccountsResult
	 */
	public function getAccounts(?string $tag = null) {
		$data = $this->_run('get_accounts',['tag' => $tag]);
		$subAddressBalances = [];
		foreach($data['subaddress_accounts'] as $subArr)
			$subAddressBalances[] = new SubBalance(
				$subArr['base_address'],
				0,
				MoneroCalculator::AtomToMonero($subArr['balance']),
				$subArr['label'],
				0,
				MoneroCalculator::AtomToMonero($subArr['unlocked_balance']),
				$subArr['account_index']
			);
		return new AccountsResult(
			$subAddressBalances,
			MoneroCalculator::AtomToMonero($data['total_balance']),
			MoneroCalculator::AtomToMonero($data['total_unlocked_balance'])
		);
	}

	/**
	 * @param string $tag
	 * @param array $accountIndices
	 */
	public function tagAccounts(string $tag, array $accountIndices) {
		$this->_run('tag_accounts',['tag' => $tag, 'accounts' => $accountIndices]);
	}

	/**
	 * @return AccountTag[]
	 * TODO add 'label' in return
	 */
	public function getAccountTags() : array {
		$data = $this->_run('get_account_tags');
		$tags = [];
		foreach($data['account_tags'] as $tagArr)
			$tags[] = new AccountTag($tagArr['accounts'],$tagArr['tag']);
		return $tags;
	}

	/**
	 * @param array $accountIndices
	 */
	public function untagAccounts(array $accountIndices) {
		$this->_run('untag_accounts',['accounts' => $accountIndices]);
	}

	/**
	 * @param string $tag
	 * @param string $description
	 */
	public function setAccountTagDescription(string $tag, string $description) {
		$this->_run('set_account_tag_description',['tag' => $tag, 'description' => $description]);
	}

	/**
	 * @return int
	 */
	public function getHeight() : int {
		return (int)$this->_run('get_height')['height'];
	}

	/**
	 * @param array $destinations
	 * @param int|null $accountIndex
	 * @param int[]|null $subaddrIndices
	 * @param int|null $priority
	 * @param int|null $mixin
	 * @param int|null $ringSize
	 * @param int $unlockTime
	 * @param string|null $paymentId
	 * @return Transfer
	 */
	public function transfer(
		array $destinations,
		?int $accountIndex = null,
		?array $subaddrIndices = null,
		?int $priority = null,
		?int $mixin = null,
		?int $ringSize = null,
		?int $unlockTime = null,
		?string $paymentId = null
	) : Transfer {
		$data = $this->_run("transfer",[
			"destinations" => $destinations,
			"account_index" => $accountIndex,
			"subaddr_indices" => $subaddrIndices,
			"priority" => $priority,
			"mixin" => $mixin,
			"ring_size" => $ringSize,
			"unlock_time" => $unlockTime,
			"payment_id" => $paymentId,
			"get_tx_key" => true,
		]);
		return new Transfer(
			MoneroCalculator::AtomToMonero($data["amount"]),
			MoneroCalculator::AtomToMonero($data["fee"]),
			$data["tx_hash"],
			$data["tx_key"]
		);
	}
}
