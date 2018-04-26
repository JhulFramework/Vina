<?php namespace Jhul\Components\Database\Adapter\MariaDB\Statement\Types;

class Count extends _Abstract
{
	use \Jhul\Components\Database\Adapter\MariaDB\Statement\Traits\Where;
	use \Jhul\Components\Database\Adapter\MariaDB\Statement\Traits\RowQueryParams;

	public function make()
	{
		return 'SELECT COUNT(*) FROM '.$this->p('table_name').$this->makeWhere().$this->makeRowQueryParams();
	}

}
