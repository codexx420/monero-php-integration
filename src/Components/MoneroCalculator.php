<?php
/**
 * ONE Developments
 */

namespace Monero\Components;


class MoneroCalculator
{
	CONST ATOMSIZE = 12;
	CONST FULLATOM = 1000000000000;

	public static function AtomToMonero(string $atom) : string {
		return \bcdiv($atom,self::FULLATOM,self::ATOMSIZE);
	}
}