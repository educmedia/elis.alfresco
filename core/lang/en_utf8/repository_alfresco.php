<?php

$string['adminusername'] = 'Admin username override';
$string['alfheader'] = 'Alfresco multimedia filters';
$string['alfheaderintro'] = 'To customize the media dimetions add &d=WIDTHxHEIGHT to the end of the URL.  Width and height also accept a percent.';
$string['alfmediapluginavi'] = 'Enable .avi filter';
$string['alfmediapluginflv'] = 'Enable .flv filter';
$string['alfmediapluginmov'] = 'Enable .mov filter';
$string['alfmediapluginmp3'] = 'Enable .mp3 filter';
$string['alfmediapluginmpg'] = 'Enable .mpg filter';
$string['alfmediapluginram'] = 'Enable .ram filter';
$string['alfmediapluginrm'] = 'Enable .rm filter';
$string['alfmediapluginrpm'] = 'Enable .rpm filter';
$string['alfmediapluginswf'] = 'Enable .swf filter';
$string['alfmediapluginswfnote'] = 'As a default security measure, normal users should not be allowed to embed swf flash files.';
$string['alfmediapluginwmv'] = 'Enable .wmv filter';
$string['alfmediapluginyoutube'] = 'Enable YouTube link filter';
$string['alfrescosearch'] = 'Alfresco search';
$string['badxmlreturn'] = 'Bad XML return';
$string['cachetime'] = 'Cache files';
$string['categoryfilter'] = 'Category filter';
$string['choosealfrescofile'] = 'Choose Alfresco file';
$string['choosefrommyfiles'] = 'Choose from My Files';
$string['chooselocalfile'] = 'Choose local file';
$string['chooserootfolder'] = 'Choose root folder';
$string['configadminusername'] = 'Alfresco has a default username of <b>admin</b>.  Moodle will also use a default ' .
                                 'username of admin for the first account you create.  We will need to re-map that ' .
                                 'value to something else when creating the Alfresco account for that user.<br /><br />' .
                                 'The value you specify here <b>must</b> be unique to your Moodle site.  You cannot have ' .
                                 'a Moodle user account with the username value you enter and you should ensure that one ' .
                                 'is not created after this value has been set.';
$string['configadminusernameconflict'] = 'The username override that you have set for your Moodle <b>admin</b> account: ' .
                                         '<i>$a->username</i> has already been used to create an Alfresco account.<br /><br />' .
                                         '<b>WARNING: A Moodle account with that username has been created which will directly ' .
                                         'conflict with the Alfresco account.  You must either delete or change the username ' .
                                         'of the <a href=\"$a->url\">Moodle user</a>.</b>';
$string['configadminusernameset'] = 'The username override that you have set for your Moodle <b>admin</b> account: ' .
                                    '<i>$a</i> has already been used to create an Alfresco account.';
$string['configcachetime'] = 'Specify that files from the repository should be cached for this long in the user\'s browser';
$string['configurecategoryfilter'] = 'Configure category filter';
$string['configdefaultfilebrowsinglocation'] = 'If you choose a value here it will be the default location that a user ' .
                                               'finds themselvses automatically sent to when launching a file browser ' .
                                               'without having a previous location to be sent to.<br /><br /><b>NOTE:</b> ' .
                                               'If a user does not have permissions to view the default location, they ' .
                                               'will see the next available location on the list that they have ' .
                                               'permissions to view.';
$string['configdeleteuserdir'] = 'When deleting a Moodle user account, if that user has an Alfresco account, it will be ' .
                                 'deleted at the same time.  By default their Alfresco home directory will not be deleted. ' .
                                 'Change this option to enable or disable that behaviour.<br /><br /><b>NOTE:</b> ' .
                                 'deleting a user\'s home directory in Alfresco will break any links in Moodle to content ' .
                                 'that was located in that directory.';
$string['configuserquota'] = 'Set the default value for how much storage space all Moodle users on Alfresco can use.  ' .
                             '<b>Select Unlimited for unlimited storage space.</b>';
$string['couldnotaccessserviceat'] = 'Could not access Alfrecso service at: $a';
$string['couldnotdeletefile'] = '<br />Error: Could not delete: $a';
$string['couldnotgetalfrescouserdirectory'] = 'Could not get Alfresco user directory for user: $a';
$string['couldnotgetfiledataforuuid'] = 'Could not get file data for UUID: $a';
$string['couldnotgetnodeproperties'] = 'Could not get node properties for UUID: $a';
$string['couldnotmigrateuser'] = 'Could not migrate user account for: $a';
$string['couldnotmovenode'] = 'Could not move node to new location';
$string['couldnotmoveroot'] = 'Could not move root folder contents to new location';
$string['couldnotopenlocalfileforwriting'] = 'Could not open local file for writing: $a';
$string['couldnotwritelocalfile'] = 'Could not write local file';
$string['defaultfilebrowsinglocation'] = 'Default file browsing location';
$string['deleteuserdir'] = 'Auto-delete Alfresco user directories';
$string['description'] = 'Connect to the Alfresco document management system repository.';
$string['done'] = 'done';
$string['errorcouldnotcreatedirectory'] = 'Error: could not create directory $a';
$string['errordirectorynameexists'] = 'Error: directory $a already exists';
$string['erroruploadduplicatefilename'] = 'Error: A file with that name already exists in this directory: <b>$a</b>';
$string['erroruploadquota'] = 'Error: You do not have enough storage space left to upload this file.';
$string['erroruploadquotasize'] = 'Error: You do not have enough storage space left to upload this file.  You have used ' .
                              '$a->current of $a->max';
$string['erroropeningtempfile'] = 'Error opening temp file';
$string['errorreadingfile'] = 'Error reading file from repository: $a';
$string['errorreceivedfromendpoint'] = 'Alfresco: Error received from endpoint -- ';
$string['erroruploadingfile'] = 'Error uploading file to Alfresco';
$string['failedtoinvokeservice'] = 'Failed to invoke service $a->serviceurl Code: $a->code';
$string['filealreadyexistsinthatlocation'] = '$a file already exists in that location';
$string['incorectformatforchooseparameter'] = 'Incorrect format for choose parameter';
$string['installingwebscripts'] = 'Installing new web scripts, please wait...';
$string['invalidcourseid'] = 'Invalid course ID: $a';
$string['invalidpath'] = 'Invalid repository path';
$string['invalidschema'] = 'invalid schema $a';
$string['invalidsite'] = 'Invalid site';
$string['lockingdownpermissionson'] = 'Locking down permissions on Alfresco folder <b>$a->name</b> (<i>$a->uuid</i>)';
$string['myfiles'] = 'My Files';
$string['myfilesquota'] = 'My Files - $a free';
$string['nocategoriesfound'] = 'No categories found';
$string['processingcategories'] = 'Processing categories...';
$string['quotanotset'] = 'Not Set';
$string['quotaunlimited'] = 'Unlimited';
$string['repository'] = 'Alfresco';
$string['repository_alfresco_category_filter'] = 'Choose the categories available when filtering search results';
$string['repository_alfresco_root_folder'] = 'The root folder on the repository where this Moodle site will store it\'s files in Alfresco';
$string['repository_alfresco_server_homedir'] = 'This is home directory (relative to the repository root space) for the user configured to access Alfresco without leading slash (/).<br /><br />Examples:<br /><b>my_home_dir<br />Moodle Users/User A</b>';
$string['repository_alfresco_server_host'] = 'The URL to your Alfresco server (should be in the following format http://www.myserver.org).';
$string['repository_alfresco_server_password'] = 'The password to login to the Alfresco server with.';
$string['repository_alfresco_server_port'] = 'The port that your Alfreso server is running on (i.e. 80, 8080).';
$string['repository_alfresco_server_settings'] = 'Alfresco server settings';
$string['repository_alfresco_server_username'] = 'The username to login to the Alfresco server with.';
$string['repositoryname'] = 'Alfresco';
$string['resetcategories'] = 'Reset categories';
$string['resetcategoriesdesc'] = 'This will force an update of all the categories from the repository (note: this will probably take about 30-60 seconds to complete)';
$string['rootfolder'] = 'Root folder';
$string['serverpassword'] = 'Password';
$string['serverport'] = 'Port';
$string['serverurl'] = 'URL';
$string['serverusername'] = 'Username';
$string['startingalfrescocron'] = 'Starting Alfresco cron...';
$string['startingpartialusermigration'] = 'Starting partial user migration...';
$string['unabletoauthenticatewithendpoint'] = 'Alfresco: Unable to authenticate with endpoint';
$string['userquota'] = 'User storage quota';
$string['uploadedbymoodle'] = 'Uploaded by Moodle';
$string['usernameorpasswordempty'] = 'Username and / or password is empty';
$string['youdonothaveaccesstothisfunctionality'] = 'You do not have access to this functionality';

?>