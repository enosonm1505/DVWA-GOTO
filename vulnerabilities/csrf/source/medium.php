<?php

if( isset( $_GET[ 'Change' ] ) ) {
	// Checks to see where the request came from
	if( eregi( $_SERVER[ 'SERVER_NAME' ], $_SERVER[ 'HTTP_REFERER' ] ) ) {
		// Get input
		$pass_new  = $_GET[ 'password_new' ];
		$pass_conf = $_GET[ 'password_conf' ];

		// Do the passwords match?
		if( $pass_new == $pass_conf ) {
			// They do!
			$pass_new = mysql_real_escape_string( $pass_new );
			$pass_new = md5( $pass_new );

			// Update the database
			$insert = "UPDATE `users` SET password = '$pass_new' WHERE user = '" . dvwaCurrentUser() . "';";
			$result = mysql_query( $insert ) or die( '<pre>' . mysql_error() . '</pre>' );

			// Feedback for the user
			trigger_error("Password Changed.", E_USER_ERROR);
			$html .= "<pre>Password Changed.</pre>";
		}
		else {
			// Issue with passwords matching
		  trigger_error("Passwords did not match.", E_USER_ERROR);
			$html .= "<pre>Passwords did not match.</pre>";
		}
	}
	else {
		// Didn't come from a trusted source
		$html .= "<pre>That request didn't look correct.</pre>";
	}

	mysql_close();
}

?>
