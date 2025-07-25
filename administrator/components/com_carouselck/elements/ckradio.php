<?php

/**
 * @copyright	Copyright (C) 2011 Cedric KEIFLIN alias ced1870
 * https://www.joomlack.fr
 * @license		GNU/GPL
 * */
defined('JPATH_PLATFORM') or die;



class JFormFieldCkradio extends JFormFieldRadio {

	protected $type = 'ckradio';

	protected function getInput() {
		// Initialize some field attributes.
		$icon = $this->element['icon'];
		$suffix = $this->element['suffix'];

		$html = $icon ? '<div class="carouselck-field-icon" ' . ($suffix ? 'data-has-suffix="1"' : '') . '><img src="' . CAROUSELCK_MEDIA_URI . '/images/' . $icon . '" style="margin-right:5px;" /></div>' : '<div style="display:inline-block;width:20px;"></div>';

		$html .= parent::getInput();
		if ($suffix)
			$html .= '<span class="carouselck-field-suffix">' . $suffix . '</span>';
		return $html;
	}

	protected function getOptions()
	{
		$options = parent::getOptions();
		foreach ($options as $option) {
			if (stristr($option->text, "img:"))
				$option->text = '<img src="' . CAROUSELCK_MEDIA_URI . '/images/' . str_replace("img:", "", $option->text) . '" style="margin:0; float:none;" />';
		}
		return $options;
	}

}
