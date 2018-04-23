<?php namespace _m\main\event\db\onItemDeleted;

class Listener extends \Jhul\Component\Event\_Listener
{
	public function handle( $deletedItem )
	{
		$this->updateTablemeta($deletedItem);
	}

	public function updateTablemeta( $deletedItem )
	{
		$tableMeta = tablemeta\DAO::D()->where( 'tableName', $deletedItem->_p()->tableName() )->fetch();

		if(empty($tableMeta))
		{
			$tableMeta = tablemeta\DOA::_create(['tableName' => $deletedItem->_p()->tableName()] );
		}

		$tableMeta
		->write('lastItemKey', $deletedItem->_p()->lastItemKey() )
		->write('itemsCount', $deletedItem->_p()->itemCounter()->count() )
		->commit()
		;

	}
}
