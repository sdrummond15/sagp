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

class CarouselckViewStyle extends CKView {

	function display($tpl = null) {
		$user = JFactory::getUser();
		$authorised = ($user->authorise('core.edit', 'com_carouselck') || (count($user->getAuthorisedCategories('com_carouselck', 'core.edit'))));

		if ($authorised !== true)
		{
			throw new Exception(JText::_('JERROR_ALERTNOAUTHOR'), 403);
			return false;
		}

		// dislay the page title
		JToolBarHelper::title(JText::_('COM_CAROUSELCK') . ' - ' . JText::_('CK_EDITION'), 'logo_carouselck_large.png');

		// load the styles helper and the interface
		require_once JPATH_SITE . '/administrator/components/com_carouselck/helpers/ckstyles.php';
		require_once(JPATH_SITE . '/administrator/components/com_carouselck/helpers/ckinterface.php');

		$this->interface = new \Carouselck\CKInterface();
		$this->item = $this->get('Item');

		$this->input->set('tmpl', 'component');
		$this->input->set('layout', 'modal');

		parent::display();
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @since	1.6
	 */
	protected function addToolbar() {
		CarouselckHelper::loadCkbox();

		JFactory::getApplication()->input->set('hidemainmenu', true);
		$user		= JFactory::getUser();
		$userId		= $user->get('id');
		$isNew		= ($this->item->id == 0);
		$checkedOut	= !($this->item->checked_out == 0 || $this->item->checked_out == $userId);
		$state = $this->get('State');
		$canDo = CarouselckHelper::getActions();

		// For new records, check the create permission.
		if ($isNew && $user->authorise('core.create', 'com_carouselck'))
		{
			JToolbarHelper::apply('style.apply');
			JToolbarHelper::save('style.save');
			// JToolbarHelper::save2new('page.save2new');
			JToolbarHelper::cancel('style.cancel');
		} else
		{
			// Can't save the record if it's checked out.
			if (!$checkedOut)
			{
				// Since it's an existing record, check the edit permission, or fall back to edit own if the owner.
				if ($canDo->get('core.edit') || ($canDo->get('core.edit.own') && $this->item->created_by == $userId))
				{
					JToolbarHelper::apply('style.apply');
					JToolbarHelper::save('style.save');
//					JToolbarHelper::custom('style.restore', 'archive', 'archive', 'CK_RESTORE', false);
					// We can save this record, but check the create permission to see if we can return to make a new one.
					if ($canDo->get('core.create'))
					{
						// JToolbarHelper::save2new('page.save2new');
					}
				}
			}

			// If checked out, we can still save
			if ($canDo->get('core.create'))
			{
				// JToolbarHelper::save2copy('page.save2copy');
			}

			JToolbarHelper::cancel('style.cancel', 'JTOOLBAR_CLOSE');
		}
	}
}
