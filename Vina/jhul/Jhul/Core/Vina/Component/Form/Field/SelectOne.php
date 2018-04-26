<?php namespace Jhul\Core\UI\Component\Form\Field;


class SelectOne extends \Jhul\Core\UI\Element
{
	use \Jhul\Core\UI\Component\Form\_Input;

	public function beforeCompile()
	{
		$this->setAttribute( 'name', $this->formFieldName() );
		parent::beforeCompile();
	}

	public function compileContent()
	{
		return

		'<?php foreach ($'.$this->name().'Options as $value => $label) : $selected = ($value == $'.$this->name().'SelectedValue) ? \'selected \' : NULL ; ?>
		<option value="<?= $value ?>" <?= $selected ?>><?= $label ?></option>
		<?php endforeach ; ?>
		';

	}

	public function wrapContent( $content )
	{
		return '<select '.$this->attributes().'>'.$content.'</select>';
	}

	public function viewType()
	{
		return 'selectOne' ;
	}
}
