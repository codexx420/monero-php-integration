<?php
/**
 * ONE Developments
 */

namespace Monero\Components;


class MoneroCalculator
{
	CONST ATOMSIZE = 12;
	CONST FULLATOM = 1000000000000;

	/**
	 * @param string $atom
	 * @return string
	 */
	public static function AtomToMonero(string $atom) : string {
		return \bcdiv($atom,self::FULLATOM,self::ATOMSIZE);
	}

	/**
	 * @param string $monero
	 * @return string
	 */
	public static function MoneroToAtom(string $monero) : string {
		return \bcmul($monero, self::FULLATOM,0);
	}
}