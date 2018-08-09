<?php
	
class qa_delete_all_users {
    function match_request($request) {
		$parts=explode('/', $request);
		return (count($parts) == 1 && $parts[0]=='delete-all-users'); 
    }
    function process_request($request) {
        $userid = qa_get_logged_in_userid();
		if (!isset($userid)) {
			qa_redirect('login');
        }

        $level = qa_get_logged_in_level();
        if ($level <= QA_USER_LEVEL_ADMIN) {
			$qa_content['error'] = qa_lang_html('users/no_permission');
        }
        

        $favoritemap = qa_get_favorite_non_qs_map();


        if(isset($favoritemap['tag']))
            echo sizeof($favoritemap['tag']);
        else
            echo "0";
    }
}