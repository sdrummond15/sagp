<?php

/**
 * @package     ExpenseManager
 * @subpackage  Site
 * @version     1.0.0
 * @author      Pedro Inácio Rodrigues Pontes
 * @copyright   Copyright (C) 2025. Todos os direitos reservados.
 * @license     GNU General Public License version 2
 */

defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.controllerform');

class ExpenseManagerControllerTechnicalvisit extends JControllerForm
{

    public function save($key = null, $urlVar = 'id')
    {
        JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

        $app   = JFactory::getApplication();
        $model = $this->getModel();
        $form  = $model->getForm();
        
        $data = $app->input->get('jform', array(), 'array');

        $validData = $model->validate($form, $data);

        if ($validData === false) {
            $this->setMessage($model->getError(), 'error');
            $this->setRedirect(
                JRoute::_('index.php?option=com_expensemanager&view=technicalvisit&id=' . (int)$data['id'], false)
            );
            return false;
        }

        if (isset($data['consultant_id'])) {
            $validData['consultant_id'] = $data['consultant_id'];
        }

        if (!$model->save($validData)) {
            $app->enqueueMessage('Erro ao salvar no Model: ' . $model->getError(), 'error');
            $this->setRedirect(
                JRoute::_('index.php?option=com_expensemanager&view=technicalvisit&id=' . (int)$validData['id'], false)
            );
            return false;
        }

        $this->setRedirect(
            JRoute::_('index.php?option=com_expensemanager&view=technicalvisits', false)
        );

        return true;
    }
}
