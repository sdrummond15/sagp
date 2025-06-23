<?php

/**
 * @copyright	Copyright (C) 2011 Cedric KEIFLIN alias ced1870
 * https://www.joomlack.fr
 * @license		GNU/GPL
 * */
// no direct access
defined('_JEXEC') or die('Restricted access');

require_once JPATH_ADMINISTRATOR . '/components/com_carouselck/helpers/ckframework.php';
require_once JPATH_ADMINISTRATOR . '/components/com_carouselck/helpers/helper.php';

Carouselck\CKFramework::load();
CarouselckHelper::loadCkbox();

JText::script('CAROUSELCK_ADDSLIDE');
JText::script('CAROUSELCK_SELECTIMAGE');
JText::script('CAROUSELCK_SELECT_LINK');
JText::script('CAROUSELCK_REMOVE2');
JText::script('CAROUSELCK_SELECT');
JText::script('CAROUSELCK_CAPTION');
JText::script('CAROUSELCK_USETOSHOW');
JText::script('CAROUSELCK_IMAGE');
JText::script('CAROUSELCK_VIDEO');
JText::script('CAROUSELCK_TEXTOPTIONS');
JText::script('CAROUSELCK_IMAGEOPTIONS');
JText::script('CAROUSELCK_LINKOPTIONS');
JText::script('CAROUSELCK_VIDEOOPTIONS');
JText::script('CAROUSELCK_ALIGNEMENT_LABEL');
JText::script('CAROUSELCK_TOPLEFT');
JText::script('CAROUSELCK_TOPCENTER');
JText::script('CAROUSELCK_TOPRIGHT');
JText::script('CAROUSELCK_MIDDLELEFT');
JText::script('CAROUSELCK_CENTER');
JText::script('CAROUSELCK_MIDDLERIGHT');
JText::script('CAROUSELCK_BOTTOMLEFT');
JText::script('CAROUSELCK_BOTTOMCENTER');
JText::script('CAROUSELCK_BOTTOMRIGHT');
JText::script('CAROUSELCK_LINK');
JText::script('CAROUSELCK_TARGET');
JText::script('CAROUSELCK_SAMEWINDOW');
JText::script('CAROUSELCK_NEWWINDOW');
JText::script('CAROUSELCK_VIDEOURL');
JText::script('CAROUSELCK_REMOVE');
JText::script('CAROUSELCK_IMPORTFROMFOLDER');
JText::script('CAROUSELCK_ARTICLEOPTIONS');
JText::script('CAROUSELCK_SLIDETIME');
JText::script('CAROUSELCK_CLEAR');
JText::script('CAROUSELCK_SELECT');
JText::script('CAROUSELCK_TITLE');
JText::script('CAROUSELCK_STARTDATE');
JText::script('CAROUSELCK_ENDDATE');
JText::script('CAROUSELCK_SAVE');
JText::script('CAROUSELCK_TEXT_CUSTOM');
JText::script('CAROUSELCK_ARTICLE');
JText::script('CAROUSELCK_TEXT');




class JFormFieldCkslidesmanager extends JFormField {

	protected $type = 'ckslidesmanager';

	protected function getInput() {

		// loads the language files from the frontend
		$lang	= JFactory::getLanguage();
		$lang->load('com_carouselck', JPATH_SITE . '/components/com_carouselck', $lang->getTag(), false);
		$lang->load('com_carouselck', JPATH_SITE, $lang->getTag(), false);

		require_once(JPATH_ROOT . '/administrator/components/com_carouselck/helpers/defines.js.php');
		$path = 'media/com_carouselck/assets/elements/ckslidesmanager/';
		JHtml::_('jquery.framework');
		// JHtml::_('jquery.ui', array('core', 'sortable'));
		JHTML::_('script', 'media/com_carouselck/assets/jquery-uick-custom.js');
		JHTML::_('script', 'media/com_carouselck/assets/admin.js');
		JHTML::_('script', $path . 'ckslidesmanager.js');
		if (\Carouselck\CKFof::isSite()) {
			JHTML::_('stylesheet', 'media/com_carouselck/assets/front-edition.css');
		}
		
		JHTML::_('stylesheet', 'media/com_carouselck/assets/jquery-ui.min.css');
		JHTML::_('stylesheet', $path . 'ckslidesmanager.css');

		$html = '<input name="' . $this->name . '" id="ckslides" type="hidden" value="' . $this->value . '" />'
				. '<div class="ckaddslide ckbutton ckbutton-success" onclick="javascript:ckAddSlide();"><i class="far fa-plus-square"></i> ' . JText::_('CAROUSELCK_ADDSLIDE') . '</div>'
				. '<ul id="ckslideslist" class="ckinterface" style="clear:both;"></ul>'
				. '<div class="ckaddslide ckbutton ckbutton-success" onclick="javascript:ckAddSlide();"><i class="far fa-plus-square"></i> ' . JText::_('CAROUSELCK_ADDSLIDE') . '</div>';

		return $html;
	}

	protected function getLabel() {

		return '';
	}

//	protected function getArticlesList() {
//		$db = & JFactory::getDBO();
//
//		$query = "SELECT id, title FROM #__content WHERE state = 1 LIMIT 2;";
//		$db->setQuery($query);
//		$row = $db->loadObjectList('id');
//		var_dump($row);
//		return json_encode($row);
//	}

}

