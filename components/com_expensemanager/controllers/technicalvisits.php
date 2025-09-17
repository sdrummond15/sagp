<?php
/**
 * @package      ExpenseManager
 * @subpackage   Site
 * @version      1.0.1
 * @author       Pedro Inácio Rodrigues Pontes
 * @copyright    Copyright (C) 2025. Todos os direitos reservados.
 * @license      GNU General Public License version 2
 */

defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.controller');

class ExpenseManagerControllerTechnicalvisits extends JControllerLegacy
{
    public function delete()
    {
        JSession::checkToken('get') or die(JText::_('JINVALID_TOKEN'));

        $app = JFactory::getApplication();
        
        $id = $app->input->getInt('visit_id', 0);

        if (!$id)
        {
            $app->enqueueMessage(JText::_('COM_EXPENSEMANAGER_ERROR_NO_ID_PROVIDED'), 'error');
            $this->setRedirect(JRoute::_('index.php?option=com_expensemanager&view=technicalvisits', false));
            return;
        }
        
        $model = $this->getModel('Technicalvisit');

        $cid = array($id);

        if (!$model->delete($cid))
        {
            $app->enqueueMessage($model->getError(), 'error');
        }

        $this->setRedirect(JRoute::_('index.php?option=com_expensemanager&view=technicalvisits', false));
    }
}
