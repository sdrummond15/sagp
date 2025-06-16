<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_button
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Inclui helper (se necessário)
require_once __DIR__ . '/helper.php';

// Adiciona CSS
$document = JFactory::getDocument();
$document->addStyleSheet(JURI::base(true) . '/modules/mod_button/assets/css/style_button.css');

// Renderiza o layout
require JModuleHelper::getLayoutPath('mod_button', $params->get('layout', 'default'));
