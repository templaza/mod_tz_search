<?php
/*------------------------------------------------------------------------

# helper.php - TZ Search Module

# ------------------------------------------------------------------------

# author    TemPlaza

# copyright Copyright (C) 2011 templaza.com. All Rights Reserved.

# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL

# Websites: http://www.templaza.com

# Technical Support:  Forum - http://www.templaza.com/Forum/

-------------------------------------------------------------------------*/

// no direct access
defined('_JEXEC') or die ('Restricted access');

/**
 * mod_tz_search Helper class
 *
 * @static
 * @package        Joomla
 * @subpackage    search
 * @since        1.5
 */
class modTZ_SearchHelper
{

    /**
     * Search areas
     *
     * @var integer
     */
    var $_areas = null;

    var $keyword = null;

    var $match = null;

    var $ordering = null;

    function modTZ_SearchHelper($params)
    {
        // Set the search parameters
        $this->keyword = urldecode(JRequest::getString('searchword'));
        $this->match = JRequest::getWord('searchphrase', $params->get('searchphrase', 'all'));
        $this->ordering = JRequest::getWord('ordering', 'newest');

        //Set the search areas
        $areas = JRequest::getVar('areas');
        $this->setAreas($areas);
    }

    /**
     * Method to get the search areas
     *
     * @since 1.5
     */
    function getAreas()
    {
        global $mainframe;
        // Load the Category data
        if (empty($this->_areas['search'])) {
            $areas = array();
            JPluginHelper::importPlugin('search');
            $dispatcher = JDispatcher::getInstance();
            $searchareas = $dispatcher->trigger('onContentSearchAreas');
            foreach ($searchareas as $area) {
                $areas = array_merge($areas, $area);
            }

            $this->_areas['search'] = $areas;
        }
        // built select lists
        if (empty($this->_areas['ordering'])) {
            $orders = array();
            $orders[] = JHTML::_('select.option', 'newest', JText::_('MOD_SEARCH_NEWEST_FIRST'));
            $orders[] = JHTML::_('select.option', 'oldest', JText::_('MOD_SEARCH_OLDEST_FIRST'));
            $orders[] = JHTML::_('select.option', 'popular', JText::_('MOD_SEARCH_MOST_POPULAR'));
            $orders[] = JHTML::_('select.option', 'alpha', JText::_('MOD_SEARCH_ALPHABETICAL'));
            $orders[] = JHTML::_('select.option', 'category', JText::_('MOD_SEARCH_CATEGORY'));
            $this->_areas['ordering'] = JHTML::_('select.radiolist', $orders, 'ordering', '', 'value', 'text', $this->ordering, 'tz_search_ordering_');
        }
        if (empty($this->_areas['searchphrase'])) {
            $searchphrases = array();
            $searchphrases[] = JHTML::_('select.option', 'all', JText::_('MOD_SEARCH_ALL_WORDS'));
            $searchphrases[] = JHTML::_('select.option', 'any', JText::_('MOD_SEARCH_ANY_WORDS'));
            $searchphrases[] = JHTML::_('select.option', 'exact', JText::_('MOD_SEARCH_EXACT_PHRASE'));
            $this->_areas['searchphrase'] = JHTML::_('select.radiolist', $searchphrases, 'searchphrase', '', 'value', 'text', $this->match, 'tz_search_type_');
        }
        if (empty($this->_areas['searchword'])) {
            $this->_areas['searchword'] = $this->keyword;
        }
        return $this->_areas;
    }

    /**
     * Method to set the search areas
     *
     * @access    public
     * @param    array    Active areas
     * @param    array    Search areas
     */
    function setAreas($active = array(), $search = array())
    {
        $this->_areas['active'] = $active;
        $this->_areas['search'] = $search;
    }

    /**
    * Display the search button as an image.
    *
    * @param   string  $button_text  The alt text for the button.
    *
    * @return  string  The HTML for the image.
    *
    * @since   1.5
    */
    public static function getSearchImage($button_text)
    {
        $img = JHtml::_('image', 'searchButton.gif', $button_text, null, true, true);
        return $img;
    }
}


