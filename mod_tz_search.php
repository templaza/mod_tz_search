<?php
/*------------------------------------------------------------------------

# mod_tz_search.php - TZ Search Module

# ------------------------------------------------------------------------

# author    TemPlaza

# copyright Copyright (C) 2014 templaza.com. All Rights Reserved.

# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL

# Websites: http://www.templaza.com

# Technical Support:  Forum - http://www.templaza.com/Forum/

-------------------------------------------------------------------------*/

// no direct access
defined('_JEXEC') or die('Restricted access');

// Include the syndicate functions only once
require_once __DIR__ . '/helper.php';

$lang = JFactory::getLanguage();
$app  = JFactory::getApplication();
$doc = JFactory::getDocument();
if ($params->get('loadjquery',0)) {
    $doc->addScript('//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js');
}
if ($params->get('loadbootstrap',0)) {
    $doc->addStyleSheet('modules/mod_tz_search/assets/bootstrap/bootstrap.min.css');
    $doc->addScript('modules/mod_tz_search/assets/bootstrap/bootstrap.min.js');
}
$doc->addStyleSheet('modules/mod_tz_search/assets/style.css');
$doc->addScript('modules/mod_tz_search/assets/script.js');

if ($params->get('opensearch', 1))
{
    $ostitle = $params->get('opensearch_title', JText::_('MOD_SEARCH_SEARCHBUTTON_TEXT') . ' ' . $app->getCfg('sitename'));
    $doc->addHeadLink(
        JUri::getInstance()->toString(array('scheme', 'host', 'port'))
        . JRoute::_('&option=com_search&format=opensearch'), 'search', 'rel',
        array(
            'title' => htmlspecialchars($ostitle),
            'type' => 'application/opensearchdescription+xml'
        )
    );
}

$upper_limit = $lang->getUpperLimitSearchWord();

$button			= $params->get('button', 0);
$imagebutton	= $params->get('imagebutton', 0);
$button_pos		= $params->get('button_pos', 'left');
$button_text	= htmlspecialchars($params->get('button_text', JText::_('MOD_SEARCH_SEARCHBUTTON_TEXT')));
$width			= (int) $params->get('width', 20);
$maxlength		= $upper_limit;
$text			= htmlspecialchars($params->get('text', JText::_('MOD_SEARCH_SEARCHBOX_TEXT')));
$label			= htmlspecialchars($params->get('label', JText::_('MOD_SEARCH_LABEL_TEXT')));
$set_Itemid		= (int) $params->get('set_itemid', 0);
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

$tz_search	=	new modTZ_SearchHelper($params);
$areas      = $tz_search->getAreas();

if ($imagebutton)
{
    $img = modTZ_SearchHelper::getSearchImage($button_text);
}
$mitemid = $set_Itemid > 0 ? $set_Itemid : $app->input->get('Itemid');

require JModuleHelper::getLayoutPath('mod_tz_search', $params->get('layout', 'default'));