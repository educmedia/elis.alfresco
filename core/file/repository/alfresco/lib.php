<?php
/**
 * General Alfresco-related API stuff.
 *
 * ELIS(TM): Enterprise Learning Intelligence Suite
 * Copyright (C) 2008-2009 Remote-Learner.net Inc (http://www.remote-learner.net)
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @package    elis
 * @subpackage File system
 * @author     Remote-Learner.net Inc
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL
 * @copyright  (C) 2008-2010 Remote Learner.net Inc http://www.remote-learner.net
 *
 */

    require_once $CFG->libdir . '/HTML_TreeMenu-1.2.0/TreeMenu.php';


/**
 * Get the list of categories selected from the admin configured filter list and
 * perform some basic cleanup of that list.
 *
 * @uses $CFG
 * @param none
 * @return array An array of category DB object IDs.
 */
    function repository_alfresco_get_category_filter() {
        global $CFG;

        if (empty($CFG->repository_alfresco_catfilter)) {
            return array();
        }

        if ($catfilter = unserialize($CFG->repository_alfresco_catfilter)) {
            $updated = array();
            $changed = false;

        /// Make sure all the selected categories actually exist in the DB.
            foreach ($catfilter as $cat) {
                if (record_exists('alfresco_categories', 'id', $cat)) {
                    $updated[] = $cat;
                } else {
                    $changed = true;
                }
            }

        /// Update and store any changes.
            if ($changed) {
                set_config('repository_alfresco_catfilter', implode(',', $updated));
                $catfilter = $updated;
            }
        }

        return $catfilter;
    }


/**
 * Make an array of categories so that the categories selected as available for
 * filtering and their parent categories (up to the root) are present and available
 * for building the dynamic tree later.
 *
 * @param none
 * @return array An array of category DB objects.
 */
    function repository_alfresco_make_category_tree() {
        global $CFG;

        $tree = array();
        $cats = array();

        if (!$catlist = repository_alfresco_get_category_filter()) {
            return $cats;
        }

        foreach ($catlist as $cat) {
            do {
                if ($cdb = get_record('alfresco_categories', 'id', $cat)) {
                    if (!array_key_exists($cdb->id, $cats)) {
                        $cats[$cdb->id] = $cdb;
                    }

                    $cat = $cdb->parent;
                }
            } while ($cat);
        }

        return $cats;
    }


/**
 * Recursively builds a dynamic tree menu for seleting the categories available to
 * filter search results by.
 *
 * @param array $cats     An array of category objects from the DB.
 * @param array $selected An array of currently selected category IDs.
 * @return array An array of completed HTML_TreeMenu nodes.
 */
    function repository_alfresco_make_category_select_tree_choose($cats, $selected = array()) {
        global $CFG;
        global $repo;
        static $catlist;

        if (empty($cats)) {
            return;
        }

        if (!isset($catlist)) {
            $catlist = repository_alfresco_make_category_tree();
        }

        $icon  = 'folder.gif';
        $eicon = 'folder-expanded.gif';
        $nodes = array();

        for ($i = 0; $i < count($cats); $i++) {
            if (in_array($cats[$i]->id, $selected)) {
                $checked = ' checked';
            } else {
                $checked = '';
            }

            $text = '<input type="checkbox" name="categories[]" value="' . $cats[$i]->id . '"' . $checked .
                    ' />' . $cats[$i]->title;

            if (array_key_exists($cats[$i]->id, $catlist)) {
                $expanded = true;
            } else {
                $expanded = false;
            }

            $node = new HTML_TreeNode(array(
                'text'         => $text,
                'icon'         => $icon,
                'expandedIcon' => $eicon,
                'expanded'     => $expanded
            ));

            if ($children = $repo->category_get_children($cats[$i]->id)) {
                if ($cnodes = repository_alfresco_make_category_select_tree_choose($children, $selected)) {
                    for ($j = 0; $j < count($cnodes); $j++) {
                        $node->addItem($cnodes[$j]);
                    }
                }
            }

            $nodes[] = $node;
        }

        return $nodes;
    }


/**
 * Recursively builds a dynamic tree menu for seleting the categories to filter
 * search results by.
 *
 * @param array  $cats     An array of category objects from the DB.
 * @param array  $selected An array of currently selected category IDs.
 * @param string $baseurl  The base URL that this menu is being displayed on.
 * @return array An array of completed HTML_TreeMenu nodes.
 */
    function repository_alfresco_make_category_select_tree_browse($cats, $selected = array(), $baseurl = '') {
        global $CFG;
        global $repo;

        static $catlist;

        if (empty($cats)) {
            return;
        }

        $icon  = 'folder.gif';
        $eicon = 'folder-expanded.gif';
        $nodes = array();

    /// Get the list of all the categories we actually need to display here
        if (!isset($catlist)) {
            $catlist = repository_alfresco_make_category_tree();
        }

        $catfilter = repository_alfresco_get_category_filter();

        for ($i = 0; $i < count($cats); $i++) {
            if (!empty($catlist) && !array_key_exists($cats[$i]->id, $catlist)) {
                continue;
            }

            if (empty($catfiler) || in_array($cats[$i]->id, $catfilter)) {
                if (in_array($cats[$i]->id, $selected)) {
                    $checked = ' checked';
                } else {
                    $checked = '';
                }

                $text = '<input type="checkbox" name="categories[]" value="' . $cats[$i]->id .
                        '"' . $checked . ' /> ';
            }

            if (!empty($baseurl)) {
                $text .= '<a href="' . $baseurl . '&amp;search=*&amp;category=' . $cats[$i]->id .
                         '">' . $cats[$i]->title . '</a>';
            } else {
                $text .= $cats[$i]->title;
            }

            $node = new HTML_TreeNode(array(
                'text'         => $text,
                'icon'         => $icon,
                'expandedIcon' => $eicon,
                'expanded'     => false
            ));

            if ($children = $repo->category_get_children($cats[$i]->id)) {
                if ($cnodes = repository_alfresco_make_category_select_tree_browse($children, $selected, $baseurl)) {
                    for ($j = 0; $j < count($cnodes); $j++) {
                        $node->addItem($cnodes[$j]);
                    }
                }
            }

            $nodes[] = $node;
        }

        return $nodes;
    }


?>
