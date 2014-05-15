<?php
/*------------------------------------------------------------------------

# default.php - TZ Search Module

# ------------------------------------------------------------------------

# author    TemPlaza

# copyright Copyright (C) 2011 templaza.com. All Rights Reserved.

# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL

# Websites: http://www.templaza.com

# Technical Support:  Forum - http://www.templaza.com/Forum/

-------------------------------------------------------------------------*/
// no direct access
defined('_JEXEC') or die ('Restricted access');

?>
<div class="mod_tz_search<?php echo $moduleclass_sfx ?>">
    <form action="<?php echo JRoute::_('index.php');?>" method="post" class="form-inline">
        <div class="dropdown">
        <?php
        $output = '<label for="mod-search-searchword" class="element-invisible">' . $label . '</label> ';
        $output .= '<input name="searchword" autocomplete="off" id="mod-tz-search-searchword" maxlength="' . $maxlength . '"  class="inputbox search-query tz_down" type="text" size="' . $width . '" value="' . $text . '"  onblur="if (this.value==\'\') this.value=\'' . $text . '\';" onfocus="if (this.value==\'' . $text . '\') this.value=\'\';" />';

        if ($button) :
            if ($imagebutton) :
                $btn_output = ' <input type="image" value="' . $button_text . '" class="button" src="' . $img . '" onclick="this.form.searchword.focus();"/>';
            else :
                $btn_output = ' <button class="button btn btn-primary" onclick="this.form.searchword.focus();">' . $button_text . '</button>';
            endif;

            switch ($button_pos) :
                case 'top' :
                    $output = $btn_output . '<br />' . $output;
                    break;

                case 'bottom' :
                    $output .= '<br />' . $btn_output;
                    break;

                case 'right' :
                    $output .= $btn_output;
                    break;

                case 'left' :
                default :
                    $output = $btn_output . $output;
                    break;
            endswitch;

        endif;

        echo $output;

        $filters    =   array();
        if ($params->get('searchfor',1)) :
            ob_start();
            ?>
            <li class="tz-search-option">
                <span class="tz-search-header"><?php echo JText::_('MOD_SEARCH_FOR'); ?></span>
                <?php echo $areas['searchphrase']; ?>
            </li>
        <?php
            $filters[]  =   ob_get_clean();
        endif;

        if ($params->get('ordering',1)) :
            ob_start();
            ?>
            <li class="tz-search-option">
                <span class="tz-search-header"><?php echo JText::_('MOD_SEARCH_ORDERING'); ?></span>
                <?php echo $areas['ordering']; ?>
            </li>
            <?php
            $filters[]  =   ob_get_clean();
        endif;

        if ($params->get('searchonly',1)) :
            ob_start();
            ?>
            <li class="tz-search-option">
                <span class="tz-search-header"><?php echo JText::_('MOD_SEARCH_SEARCH_ONLY'); ?></span>
                <ul>
                    <?php foreach ($areas['search'] as $val => $txt) :
                        $checked = is_array($areas['active']) && in_array($val, $areas['active']) ? 'checked="checked"' : '';
                        ?>
                        <li>
                            <input type="checkbox" name="areas[]" value="<?php echo $val; ?>"
                                   id="tz_area_<?php echo $val; ?>" <?php echo $checked; ?> />
                            <label for="tz_area_<?php echo $val; ?>">
                                <?php echo JText::_($txt); ?>
                            </label>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </li>
            <?php
            $filters[]  =   ob_get_clean();
        endif;

        $divider    =   '<li class="divider"></li>';

        if (count($filters)) :
        ?>
            <ul class="dropdown-menu tz-search-dropdown" role="menu" aria-labelledby="dropdownMenu">
                <?php echo implode($divider, $filters); ?>
            </ul>
        <?php endif; ?>
        </div>
        <input type="hidden" name="task" value="search" />
        <input type="hidden" name="option" value="com_search" />
        <input type="hidden" name="Itemid" value="<?php echo $mitemid; ?>" />
    </form>
</div>
