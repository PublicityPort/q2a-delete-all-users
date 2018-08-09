<?php

/*
	This plugin is desiged to delete all users to generate sample test data and pass on the production data to your developers and testers.
*/

if (!defined('QA_VERSION')) { // don't allow this page to be requested directly from browser
	header('Location: ../../');
	exit;
}

qa_register_plugin_module('page', 'qa-delete-all-users.php', 'qa_delete_all_users', 'Delete all users except the admin.');

