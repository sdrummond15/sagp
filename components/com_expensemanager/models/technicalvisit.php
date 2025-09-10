<?php
defined('_JEXEC') or die('Restricted access');

class ExpenseManagerModelTechnicalvisit extends JModelForm
{
    protected $text_prefix = 'COM_EXPENSEMANAGER_TECHNICALVISIT';

    public function getTable($type = 'Technicalvisit', $prefix = 'ExpenseManagerTable', $config = array())
    {
        return JTable::getInstance($type, $prefix, $config);
    }

    public function getForm($data = array(), $loadData = true)
    {
        $form = $this->loadForm(
            'com_expensemanager.technicalvisit',
            'technicalvisit',
            array(
                'control' => 'jform',
                'load_data' => $loadData
            )
        );

        if (empty($form)) {
            return false;
        }

        return $form;
    }

    protected function loadFormData()
    {
        $data = JFactory::getApplication()->getUserState('com_expensemanager.edit.technicalvisit.data', array());

        if (empty($data)) {
            $item = $this->getItem();

            if (empty($item->id)) {
                $user = JFactory::getUser();
                $item->consultant_id = array($user->id);

                $editorFieldsWithDefaults = [
                    'budget_expense_realization_notes',
                    'budget_revenue_collection_notes',
                    'budget_art167a_compliance_notes',
                    'duodecimo_art29a_calc_notes',
                    'duodecimo_transfer_calc_notes',
                    'indices_education_25_notes',
                    'indices_fundeb_application_notes',
                    'indices_art212a_chart_notes',
                    'indices_health_spending_notes',
                    'indices_personnel_expenses_notes',
                    'indices_financial_availability_notes'
                ];

                foreach ($editorFieldsWithDefaults as $fieldName) {
                    if (empty($item->$fieldName)) {
                        $item->$fieldName = $this->_getDefaultEditorContent($fieldName);
                    }
                }
            }
            $data = (array) $item;
        }
        return $data;
    }

    private function _getDefaultEditorContent($fieldName)
    {
        $path = __DIR__ . '/defaults/' . $fieldName . '.php';

        if (file_exists($path)) {
            ob_start();
            include $path;
            return ob_get_clean();
        }

        return '';
    }

    public function save($data)
    {
        // Define o 'created_by' para novos itens
        if (empty($data['id'])) {
            $user = JFactory::getUser();
            $data['created_by'] = $user->get('id');
        }

        $db = $this->getDbo();
        $table = $this->getTable();

        // Carrega a tabela para garantir que o item existe antes de salvar
        if (!empty($data['id'])) {
            if (!$table->load((int) $data['id'])) {
                $this->setError('Falha ao carregar a visita técnica para atualização.');
                return false;
            }
        }

        if (!$table->bind($data)) {
            $this->setError('Falha no bind da tabela de visitas.');
            return false;
        }

        if (!$table->store()) {
            $this->setError('Falha ao salvar a visita principal: ' . $table->getError());
            return false;
        }

        $visitId = (int) $table->id;
        $consultantIds = isset($data['consultant_id']) ? (array) $data['consultant_id'] : array();

        try {
            $db->transactionStart();

            $deleteQuery = $db->getQuery(true)
                ->delete($db->quoteName('#__expensemanager_technical_visit_consultants'))
                ->where($db->quoteName('technical_visit_id') . ' = ' . $visitId);
            $db->setQuery($deleteQuery)->execute();

            if (!empty($consultantIds)) {
                $values = array();
                foreach ($consultantIds as $consultantId) {
                    if ((int)$consultantId > 0) {
                        $values[] = $visitId . ', ' . (int)$consultantId;
                    }
                }

                if (!empty($values)) {
                    $insertQuery = $db->getQuery(true)
                        ->insert($db->quoteName('#__expensemanager_technical_visit_consultants'))
                        ->columns(array($db->quoteName('technical_visit_id'), $db->quoteName('consultant_id')))
                        ->values($values);
                    $db->setQuery($insertQuery)->execute();
                }
            }

            $db->transactionCommit();
        } catch (Exception $e) {
            $db->transactionRollback();
            $this->setError('Erro crítico no banco de dados ao salvar consultores: ' . $e->getMessage());
            return false;
        }

        $this->setState($this->context . '.id', $visitId);
        return true;
    }

    public function delete(&$pks)
    {
        $pks = (array) $pks;
        JArrayHelper::toInteger($pks);

        if (empty($pks)) {
            $this->setError(JText::_('JLIB_HTML_PLEASE_MAKE_A_SELECTION_FROM_THE_LIST'));
            return false;
        }

        $db    = $this->getDbo();
        $query = $db->getQuery(true);
        
        try {
            $db->transactionStart();

            $query->delete($db->quoteName('#__expensemanager_technical_visit_consultants'))
                  ->where($db->quoteName('technical_visit_id') . ' IN (' . implode(',', $pks) . ')');
            $db->setQuery($query)->execute();
            
            $query->clear()
                  ->delete($db->quoteName('#__expensemanager_technical_visits'))
                  ->where($db->quoteName('id') . ' IN (' . implode(',', $pks) . ')');
            $db->setQuery($query)->execute();

            $db->transactionCommit();

        } catch (Exception $e) {
            $db->transactionRollback();
            $this->setError($e->getMessage());
            return false;
        }

        return true;
    }

    public function getItem($pk = null)
    {
        $pk = (!empty($pk)) ? $pk : (int) JFactory::getApplication()->input->getInt('id');

        if ($pk > 0) {
            try {
                $db    = $this->getDbo();
                $query = $db->getQuery(true);

                $query->select('tv.*, c.name AS client_name')
                    ->from($db->quoteName('#__expensemanager_technical_visits', 'tv'))
                    ->join('LEFT', $db->quoteName('#__expensemanager_clients', 'c') . ' ON c.id = tv.client_id')
                    ->where('tv.id = ' . (int) $pk);

                $db->setQuery($query);
                $item = $db->loadObject();

                if ($item) {
                    $query->clear()
                        ->select($db->quoteName('consultant_id'))
                        ->from($db->quoteName('#__expensemanager_technical_visit_consultants'))
                        ->where($db->quoteName('technical_visit_id') . ' = ' . (int) $pk);
                    $db->setQuery($query);
                    $item->consultant_id = $db->loadColumn();

                    if (!empty($item->consultant_id)) {
                        $query->clear()
                            ->select(
                                $db->quoteName('u.name') . ', ' .
                                    $db->quoteName('p.profile_value', 'crc')
                            )
                            ->from($db->quoteName('#__users', 'u'))
                            ->join(
                                'LEFT',
                                $db->quoteName('#__user_profiles', 'p') . ' ON ' . $db->quoteName('u.id') . ' = ' . $db->quoteName('p.user_id')
                            )
                            ->where($db->quoteName('p.profile_key') . ' = ' . $db->quote('profile.aboutme'))
                            ->where($db->quoteName('u.id') . ' IN (' . implode(',', array_map('intval', $item->consultant_id)) . ')');

                        $db->setQuery($query);
                        $userDetails = $db->loadObjectList();

                        $details = [];
                        if ($userDetails) {
                            foreach ($userDetails as $user) {
                                $details[] = $user->name . ' - CRC: ' . trim($user->crc, '"');
                            }
                        }
                        $item->consultants_details = implode("\n", $details);
                    } else {
                        $item->consultants_details = 'Nenhum consultor associado.';
                    }
                }
                return $item;
            } catch (Exception $e) {
                $this->setError($e->getMessage());
                return false;
            }
        }
        return new stdClass();
    }
}
