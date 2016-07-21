<?php 

namespace App\Helpers;

class MenuSelect {

	protected $select = '';

	protected $option = '';

	public function getMenu($data, $name = '', $selected = 0, $option = [] , $text = '') {
		$this->select .= '<select name="'.$name.'" ';
		if(!empty($option)){
			foreach ($option as $key => $value) {
				$this->select .= $key.'="'.$value.'"';
			}
		}
		$this->select .= '>';
		$this->select .= $this->tree($data, $selected, $text='');
		$this->select .= '</select>';
		return $this->select;
	}

	public function tree($data, $selected = 0, $text = '') {
		
		foreach ($data as $value) {
			if($value->id == $selected){
				$select = 'selected="selected"';
			}else{
				$select = '';
			}
			$this->option .=  '<option '.$select.' value = "'.$value->id.'">'.$text.' '.$value->name_category.'</option>';
			if(!empty($value->children)) {
				$this->tree($value->children, $selected,$text.'--');
			}
		}
		return $this->option;
	}

}