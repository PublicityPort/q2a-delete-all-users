<?php

function qa_db_all_users_except_admins()
{
	return array(
		'columns' => array('userid'),
		'source' => '^users WHERE LEVEL <= 100',
    );

}