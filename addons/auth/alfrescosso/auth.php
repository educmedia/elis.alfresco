<?php
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.
/**
 * Alfresco SSO authentication plug-in.
 *
 * @package    elis
 * @subpackage File system
 * @copyright  2010 Remote Learner - http://www.remote-learner.net/
 * @author     Justin Filip <jfilip@remote-learner.net>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    ///  It must be included from a Moodle page
}


require_once($CFG->libdir . '/authlib.php');


/**
 * Alfresco SSO authentication plugin.
 */
class auth_plugin_alfrescosso extends auth_plugin_base {

    /**
     * Constructor.
     */
    function auth_plugin_alfrescosso() {
        global $CFG;

        $this->authtype = 'alfrescosso';
        $this->config   = get_config('auth/alfrescosso');
        $this->isactive = file_exists($CFG->dirroot . '/file/repository/alfresco/settings.php');
    }


    /**
     * Returns true if the username and password work and false if they are
     * wrong or don't exist.
     *
     * @param string $username The username (with system magic quotes)
     * @param string $password The password (with system magic quotes)
     *
     * @return bool Authentication success or failure.
     */
    function user_login ($username, $password) {
        return false;
    }


    /**
     * Updates the user's password.
     *
     * called when the user password is updated.
     *
     * @param  object  $user        User table object  (with system magic quotes)
     * @param  string  $newpassword Plaintext password (with system magic quotes)
     * @return boolean result
     *
     */
    function user_update_password($user, $newpassword) {
        return false;
    }


    function prevent_local_passwords() {
        return false;
    }


    /**
     * Returns true if this authentication plugin is 'internal'.
     *
     * @return bool
     */
    function is_internal() {
        return true;
    }


    /**
     * Returns true if this authentication plugin can change the user's
     * password.
     *
     * @return bool
     */
    function can_change_password() {
        return false;
    }


    /**
     * Returns the URL for changing the user's pw, or empty if the default can
     * be used.
     *
     * @return string
     */
    function change_password_url() {
        return '';
    }


    /**
     * Returns true if plugin allows resetting of internal password.
     *
     * @return bool
     */
    function can_reset_password() {
        return true;
    }


    /**
     * Prints a form for configuring this authentication plugin.
     *
     * This function is called from admin/auth.php, and outputs a full page with
     * a form for configuring this plugin.
     *
     * @uses $CFG
     * @param array $page An object containing all the data for this page.
     */
    function config_form($config, $err, $user_fields) {
        global $CFG;

        // Print out a message about the Alfresco repository plug-in status on this system.
        if (!$this->isactive) {
            print_heading(get_string('alfresconotfound', 'auth_alfrescosso'), 'center', '2');
        } else {
            $url = $CFG->wwwroot . '/admin/settings.php?section=repositoryalfresco';
            print_heading(get_string('configurealfrescohere', 'auth_alfrescosso', $url), 'center', '2');
        }
    }


    /**
     * Processes and stores configuration data for this authentication plugin.
     */
    function process_config($config) {
        return true;
    }


   /**
     * Confirm the new user as registered. This should normally not be used,
     * but it may be necessary if the user auth_method is changed to manual
     * before the user is confirmed.
     */
    function user_confirm($username, $confirmsecret = null) {
        return AUTH_CONFIRM_ERROR;
    }


    /**
     * Post authentication hook.
     * This method is called from authenticate_user_login() for all enabled auth plugins.
     *
     * @uses $CFG
     * @param object $user user object, later used for $USER
     * @param string $username (with system magic quotes)
     * @param string $password plain text password (with system magic quotes)
     */
    function user_authenticated_hook(&$user, $username, $password) {
        global $CFG;

        if (!$this->isactive || !file_exists($CFG->dirroot . '/file/repository/repository.class.php')) {
            return;
        }

        require_once($CFG->dirroot . '/file/repository/repository.class.php');

        if (!$repo = repository_factory::factory('alfresco')) {
            return;
        }

        if (!$repo->verify_setup() || !$repo->is_configured()) {
            return;
        }

        // Perform the proper setup / updating / migration of user information on Alfresco.
        if ($repo->migrate_user($user, $password)) {
            $repo->sync_permissions($user);
        }
    }
}

?>