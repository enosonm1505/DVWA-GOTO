<?php

if( isset( $_POST[ 'Submit' ]  ) ) {
	// Get input
	$target_raw = $_REQUEST[ 'ip' ];

	// Set blacklist
	$substitutions = array(
		'&&' => '',
		';'  => '',
	);

  // Remove any of the charactars in the array (blacklist).
  $target = str_replace( array_keys( $substitutions ), $substitutions, $target_raw );
  
  if($target != $target_raw) {
    trigger_error("IP contains blacklist characters that could lead to command execution.", E_USER_ERROR);
  }
  
	// Determine OS and execute the ping command.
	if( stristr( php_uname( 's' ), 'Windows NT' ) ) {
		// Windows
		$cmd = shell_exec( 'ping  ' . $target );
	}
	else {
		// *nix
		$cmd = shell_exec( 'ping  -c 4 ' . $target );
	}

	// Feedback for the end user
	$html .= "<pre>{$cmd}</pre>";
}

?>
