<?php
/**
 * @package     ExpenseManager
 * @subpackage  Administrator
 * @version     1.0.0
 * @author      Pedro Inácio Rodrigues Pontes
 * @copyright   Copyright (C) 2025. Todos os direitos reservados.
 * @license     GNU General Public License version 2
 */

defined('_JEXEC') or die('Restricted access');

class ExpenseManagerControllerCategories extends JControllerAdmin
{
    protected $text_prefix = 'COM_EXPENSEMANAGER_CATEGORIES';

    public function getModel($name = 'Category', $prefix = 'ExpenseManagerModel', $config = array())
    {
        $model = parent::getModel($name, $prefix, array('ignore_request' => true));
        return $model;
    }
}