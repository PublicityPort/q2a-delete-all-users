<?php
	
class qa_delete_all_users {
    private $directory; //Stores and returns present directory
    private $urltoroot; //Stores and returns URL till the directory, use with URL
    
	function load_module( $directory, $urltoroot )
	{
		$this->directory = $directory;
		$this->urltoroot = $urltoroot;
    }
    
    function match_request($request) {
		$parts=explode('/', $request);
		return (count($parts) == 1 && $parts[0]=='delete-all-users'); 
    }
    function process_request($request) {
        require_once $this->directory . 'db/selects.php';
        require_once QA_INCLUDE_DIR.'app/users-edit.php';

        $userid = qa_get_logged_in_userid();
		if (!isset($userid)) {
			qa_redirect('login');
        }

        $level = qa_get_logged_in_level();
        if ($level <= QA_USER_LEVEL_ADMIN) {
			$qa_content['error'] = qa_lang_html('users/no_permission');
        }
        
        $allusers = qa_db_select_with_pending(qa_db_all_users_except_admins());

        if(count($allusers) > 0){

            echo '<p>';
            foreach($allusers as $user){
                print('<br />Deleting user with userid ' . $user['userid']);
                qa_delete_user($user['userid']);
            }
            echo '</p>';
        }else{
            echo '<p>Nothing to remove :)</p>';
        }
    }
}