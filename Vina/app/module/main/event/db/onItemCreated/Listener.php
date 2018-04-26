<?php namespace _m\main\event\db\onItemCreated;

class Listener extends \Jhul\Component\Event\_Listener
{
	public function handle( $createdItem )
	{
		$this->updateTableMeta($createdItem);
	}

	public function updateTableMeta( $createdItem )
	{
		$tableMeta = tablemeta\DAO::D()->where( 'tableName', $createdItem->_p()->tableName() )->fetch();

		if(empty($tableMeta))
		{
			$tableMeta = tablemeta\DAO::_create(['tableName' => $createdItem->_p()->tableName()] );
		}

		$tableMeta
		->write('lastItemKey', 	$createdItem->_p()->lastItemKey() )
		->write('itemsCount', 	$createdItem->_p()->itemCounter()->count() )
		->commit()
		;

	}
}
