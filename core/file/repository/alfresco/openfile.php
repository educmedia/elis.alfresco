<?php
/**
 * Open an Alfresco file given the file's UUID value.
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

    require_once('../../../config.php');
    require_once($CFG->dirroot . '/file/repository/repository.class.php');


    $uuid = required_param('uuid', PARAM_CLEAN);


    if (!$repo = repository_factory::factory($CFG->repository)) {
        print_error('couldnotcreaterepositoryobject', 'repository');
    }

    if (!$repo->permission_check($uuid, $USER->id)) {
        print_error('youdonothaveaccesstothisfunctionality', 'repository_alfresco');
    }

    $repo->read_file($uuid);

    exit;
?>
