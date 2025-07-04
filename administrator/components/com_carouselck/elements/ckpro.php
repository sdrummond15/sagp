<?php

/**
 * @copyright	Copyright (C) 2017 Cedric KEIFLIN alias ced1870
 * https://www.joomlack.fr
 * @license		GNU/GPL
 * */
// no direct access
defined('JPATH_PLATFORM') or die;



class JFormFieldCkpro extends JFormField {

	protected $type = 'ckpro';

	private $state;

	protected function getLabel() {
		return '';
	}

	protected function getInput() {
		$html = array();

		// Add the label text and closing tag.
		$html[] = '<div id="' . $this->id . '-lbl" class="ckinfo">';
		$html[] = '<i class="fas fa-info" style="color:green"></i>';
		$html[] = JText::_('CAROUSELCK_USE_PRO_VERSION');
		$html[] = ' <a href="https://www.joomlack.fr/en/documentation/miscellaneous/202-license-code" target="_blank">';
		$html[] = '<span class="cklabel cklabel-info"><i class="fas fa-link"></i> ' . JText::_('CAROUSELCK_GET_LICENCE_INFOS') . '</label>';
		$html[] = '</a>';
		$html[] = '</div>';

		return implode('', $html);
	}
}