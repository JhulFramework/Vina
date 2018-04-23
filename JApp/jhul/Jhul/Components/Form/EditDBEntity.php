<?php namespace Jhul\Components\Form;
/*----------------------------------------------------------------------------------------------------------------------
 *@author Manish Dhruw < 1D3N717Y12@gmail.com >
 *
 *
 *@created Saturday 10 January 2015 03:54:05 PM IST
 *--------------------------------------------------------------------------------------------------------------------*/

abstract class EditDBEntity extends _Class
{


	public function editItem()
	{
		return $this->context()->editItem();
	}

	public function restore( $key )
	{
		if( NULL != ( $oldValue = parent::restore( $key ) ) )
		{
			return $oldValue;
		}

		if( $this->editItem()->has( $key ) )
		{
			return $this->editItem()->read( $key ) ;
		}
	}
}
