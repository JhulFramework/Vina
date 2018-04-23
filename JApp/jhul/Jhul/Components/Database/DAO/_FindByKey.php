<?php namespace Jhul\Components\Database\DAO;

trait _FindByKey
{
	public static function find( $identity_key )
	{
		return static::D()->byKey( $identity_key )->fetch();
	}

	public static function findAll( $keys )
	{
		return static::D()->whereIN( static::I()->_p()->keyName(), $keys )->fetchAll();
	}
}
