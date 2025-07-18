<?php
/**
 * @name		Carousel CK
 * @package		com_carouselck
 * @copyright	Copyright (C) 2019. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 * @author		Cedric Keiflin - https://www.template-creator.com - https://www.joomlack.fr
 */
 
 
// No direct access
defined('_JEXEC') or die;

use \Carouselck\CKView;
use \Carouselck\CKFof;

class CarouselckViewBrowse extends CKView {

	function display($tpl = 'default') {
		$input = JFactory::getApplication()->input;

		$user = JFactory::getUser();
		$authorised = ($user->authorise('core.edit', 'com_carouselck') || (count($user->getAuthorisedCategories('com_carouselck', 'core.create'))));

		if ($authorised !== true)
		{
			throw new Exception(JText::_('JERROR_ALERTNOAUTHOR'), 403);
			return false;
		}

		// load the items
		require_once JPATH_ADMINISTRATOR . '/components/com_carouselck/helpers/ckbrowse.php';
		$this->items = CKBrowse::getItemsList();

		parent::display($tpl);
	}
}
