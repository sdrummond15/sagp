<?php
/**
 * @package     ExpenseManager
 * @subpackage  Administrator
 * @version     1.0.0
 * @author      Pedro Inácio Rodrigues Pontes
 * @copyright   Copyright (C) 2025. Todos os direitos reservados.
 * @license     GNU General Public License version 2
 */

// Proteção contra acesso direto
defined('_JEXEC') or die('Restricted access');

class ExpenseManagerModelClients extends JModelList
{
    public function __construct($config = array())
    {
        if (empty($config['filter_fields']))
        {
            $config['filter_fields'] = array(
                'id', 'a.id',
                'name', 'a.name',
                'client_type', 'a.client_type',
                'cnpj', 'a.cnpj',
                'city_id', 'a.city_id', 'city_name',
                'published', 'a.published',
                'ordering', 'a.ordering'
            );
        }

        parent::__construct($config);
    }

    protected function getListQuery()
    {
        $db = $this->getDbo();
        $query = $db->getQuery(true);

        $query->select(
            $this->getState(
                'list.select',
                'a.id, a.name, a.client_type, a.cnpj, a.city_id, a.contact_person, a.contact_email, a.published, a.created, a.created_by, a.ordering, a.checked_out, a.checked_out_time'
            )
        );
        $query->from('#__expensemanager_clients AS a');

        $query->select('c.name AS city_name');
        $query->join('LEFT', '#__expensemanager_cities AS c ON c.id = a.city_id');
        $query->select('u.name AS created_by_name');
        $query->join('LEFT', '#__users AS u ON u.id = a.created_by');
        $query->select('uc.name AS editor');
        $query->join('LEFT', '#__users AS uc ON uc.id = a.checked_out');

        // Filtro de Publicação
        $published = $this->getState('filter.published');
        if (is_numeric($published))
        {
            $query->where('a.published = ' . (int) $published);
        }
        elseif ($published === '')
        {
            $query->where('(a.published IN (0, 1))');
        }

        // Filtro de Pesquisa
        $search = $this->getState('filter.search');
        if (!empty($search))
        {
            if (stripos($search, 'id:') === 0)
            {
                $query->where('a.id = ' . (int) substr($search, 3));
            }
            else
            {
                $search = $db->quote('%' . $db->escape($search, true) . '%');
                $query->where(
                    '(a.name LIKE ' . $search .
                    ' OR a.cnpj LIKE ' . $search .
                    ' OR a.contact_person LIKE ' . $search . ')'
                );
            }
        }

        // Ordenação
        $orderCol = $this->state->get('list.ordering', 'a.name');
        $orderDirn = $this->state->get('list.direction', 'ASC');
        $query->order($db->escape($orderCol . ' ' . $orderDirn));

        return $query;
    }

    protected function populateState($ordering = 'a.name', $direction = 'asc')
    {
        parent::populateState($ordering, $direction);
        
        $app = JFactory::getApplication();

        $search = $this->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
        $this->setState('filter.search', $search);

        $published = $this->getUserStateFromRequest($this->context . '.filter.published', 'filter_published');
        $this->setState('filter.published', $published);
    }
}