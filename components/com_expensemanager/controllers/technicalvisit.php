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

// Mudamos para o JControllerLegacy, que é mais simples e ideal para o frontend.
jimport('joomla.application.component.controller');

class ExpenseManagerControllerTechnicalvisits extends JControllerLegacy
{
    /**
     * Deleta um registro. Esta implementação é explícita para garantir o
     * funcionamento correto no frontend, evitando erros de token e de 404.
     */
    public function delete()
    {
        // 1. Verificar o token de segurança que veio pela URL (usando 'get')
        JSession::checkToken('get') or die(JText::_('JINVALID_TOKEN'));

        $app   = JFactory::getApplication();
        
        // 2. Pegar o ID do item a ser deletado da URL usando um nome específico 'visit_id' para evitar conflitos.
        $id = $app->input->getInt('visit_id', 0);

        if (!$id)
        {
            $app->enqueueMessage(JText::_('COM_EXPENSEMANAGER_ERROR_NO_ID_PROVIDED'), 'error');
            $this->setRedirect(JRoute::_('index.php?option=com_expensemanager&view=technicalvisits', false));
            return;
        }
        
        // 3. Pegar o model de item (singular)
        $model = $this->getModel('Technicalvisit');

        // O model espera um array de IDs, então colocamos nosso 'id' em um.
        $cid = array($id);

        // 4. Tentar deletar o item chamando o método do model
        if ($model->delete($cid))
        {
            $app->enqueueMessage(JText::_('COM_EXPENSEMANAGER_TECHNICALVISIT_DELETE_SUCCESS'));
        }
        else
        {
            $app->enqueueMessage($model->getError(), 'error');
        }

        // 5. Redirecionar explicitamente de volta para a lista.
        $this->setRedirect(JRoute::_('index.php?option=com_expensemanager&view=technicalvisits', false));
    }
}
```

### O que eu fiz no Canvas:

No arquivo `controllers/technicalvisits.php`, eu mudei apenas uma linha para que o controller procure pelo novo nome de parâmetro:

* **De:** `$id = $app->input->getInt('id', 0);`
* **Para:** `$id = $app->input->getInt('visit_id', 0);`

---

### Ação Necessária no seu Arquivo da View

Agora, você precisa fazer a mudança correspondente no seu arquivo `views/technicalvisits/tmpl/default.php`.

1.  Encontre a linha que cria o link para deletar:
    ```php
    $linkDelete = JRoute::_('index.php?option=com_expensemanager&task=technicalvisits.delete&id=' . (int) $item->id . '&' . JSession::getFormToken() . '=1');
    ```

2.  Altere `&id=` para `&visit_id=`, assim:
    ```php
    $linkDelete = JRoute::_('index.php?option=com_expensemanager&task=technicalvisits.delete&visit_id=' . (int) $item->id . '&' . JSession::getFormToken() . '=1');
    

