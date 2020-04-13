<?php

require_once __DIR__ . '/fct.php';

require_once __DIR__ . '/Epic/EpicLoader.php';
EpicLoader::register();

spl_autoload_register(function($class) {
	$file = str_replace("\\", "/", ROOT . "/app/" . $class . ".php");
	if (is_file($file)) {
		require $file;
	} else {
		return;
	}
});

if (extension_loaded('xdebug')) {
	ini_set('xdebug.var_display_max_depth', '10');
	ini_set('xdebug.var_display_max_children', '256');
	ini_set('xdebug.var_display_max_data', '1024');
}

set_exception_handler(function(Exception $e) {
	//ob_end_clean();
	//header('Content-type: text/html; charset=utf-8');

	$message = $e->getMessage();
	$code = $e->getCode();
	$file = $e->getFile();
	$line = $e->getLine();
	$trace = $e->getTrace();

	echo '<h1>Uncaught exception ' . get_class($e) . '</h1>';
	echo '<h2>Message: ' . $e->getMessage() . '</h2>';
	if (!empty($code)) {
		echo '<h3>Code: ' . $code . '</h3>';
	}
	echo '<p>File : ' . $file . '</p>';
	echo '<p>Line : ' . $line . '</p>';

	echo '<h3>Stack</h3>';
	echo '<table border="2" cellspacing="2" cellpadding="5">';
	echo '<tr><th>#</th><th>Fichier</th><th>Ligne</th><th>Fonction/Méthode</th><th>dump</th></tr>';
	foreach ($trace as $key => $value) {
		echo '<tr>';
		echo '<td>' . $key . '</td>';
		echo '<td>' . (!empty($value['file']) ? $value['file'] : '') . '</td>';
		echo '<td>' . (!empty($value['line']) ? $value['line'] : '') . '</td>';
		echo '<td>';
		if (!empty($value['class'])) {
			echo $value['class'] . $value['type'] . $value['function'];
		} else {
			echo $value['function'];
		}
		echo '</td>';

		echo '<td>';
		var_dump($value);
		echo '</td>';

		echo '</tr>';
	}
	echo '</table>';
	exit;
});

set_error_handler(function($errno, $errstr, $errfile, $errline, $errcontext) {
	//ob_end_clean();
	//header('Content-type: text/html; charset=utf-8');

	switch ($errno) {
		case E_ERROR: $errlabel = "E_ERROR";
			break;
		case E_WARNING: $errlabel = "Warning";
			break;
		case E_PARSE: $errlabel = "E_PARSE";
			break;
		case E_NOTICE: $errlabel = "Notice";
			break;
		case E_CORE_ERROR: $errlabel = "E_CORE_ERROR";
			break;
		case E_CORE_WARNING: $errlabel = "E_CORE_WARNING";
			break;
		case E_COMPILE_ERROR: $errlabel = "E_COMPILE_ERROR";
			break;
		case E_COMPILE_WARNING: $errlabel = "E_COMPILE_WARNING";
			break;
		case E_USER_ERROR: $errlabel = "E_USER_ERROR";
			break;
		case E_USER_WARNING: $errlabel = "E_USER_WARNING";
			break;
		case E_USER_NOTICE: $errlabel = "E_USER_NOTICE";
			break;
		case E_STRICT: $errlabel = "E_STRICT";
			break;
		case E_RECOVERABLE_ERROR: $errlabel = "E_RECOVERABLE_ERROR";
			break;
		case E_DEPRECATED: $errlabel = "E_DEPRECATED";
			break;
		case E_USER_DEPRECATED: $errlabel = "E_USER_DEPRECATED";
			break;
		default:$errlabel = "UNKOWN ERROR TYPE";
			break;
	}
	echo '<h1>' . $errlabel . '</h1>';
	echo '<h2>' . $errstr . '</h2>';
	echo '<p>File : ' . $errfile . '</p>';
	echo '<p>Line : ' . $errline . '</p>';
	$backtrace = debug_backtrace();
	echo '<h3>Stack</h3>';
	echo '<table border="2" cellspacing="2" cellpadding="5">';
	echo '<tr><th>#</th><th>Fichier</th><th>Ligne</th><th>Fonction/Méthode</th><th>dump</th></tr>';
	foreach ($backtrace as $key => $value) {
		echo '<tr>';
		echo '<td>' . $key . '</td>';
		echo '<td>' . (!empty($value['file']) ? $value['file'] : '') . '</td>';
		echo '<td>' . (!empty($value['line']) ? $value['line'] : '') . '</td>';
		echo '<td>';
		if (!empty($value['class'])) {
			echo $value['class'] . $value['type'] . $value['function'];
		} else {
			echo $value['function'];
		}
		echo '</td>';

		echo '<td>';
		var_dump($value);
		echo '</td>';

		echo '</tr>';
	}
	echo '</table>';
	exit;
});


/* A ETUDIER
set_error_handler(function ($err_severity, $err_msg, $err_file, $err_line, array $err_context)
{
    // error was suppressed with the @-operator
    if (0 === error_reporting()) { return false;}
    switch($err_severity)
    {
        case E_ERROR:               throw new ErrorException            ($err_msg, 0, $err_severity, $err_file, $err_line);
        case E_WARNING:             throw new WarningException          ($err_msg, 0, $err_severity, $err_file, $err_line);
        case E_PARSE:               throw new ParseException            ($err_msg, 0, $err_severity, $err_file, $err_line);
        case E_NOTICE:              throw new NoticeException           ($err_msg, 0, $err_severity, $err_file, $err_line);
        case E_CORE_ERROR:          throw new CoreErrorException        ($err_msg, 0, $err_severity, $err_file, $err_line);
        case E_CORE_WARNING:        throw new CoreWarningException      ($err_msg, 0, $err_severity, $err_file, $err_line);
        case E_COMPILE_ERROR:       throw new CompileErrorException     ($err_msg, 0, $err_severity, $err_file, $err_line);
        case E_COMPILE_WARNING:     throw new CoreWarningException      ($err_msg, 0, $err_severity, $err_file, $err_line);
        case E_USER_ERROR:          throw new UserErrorException        ($err_msg, 0, $err_severity, $err_file, $err_line);
        case E_USER_WARNING:        throw new UserWarningException      ($err_msg, 0, $err_severity, $err_file, $err_line);
        case E_USER_NOTICE:         throw new UserNoticeException       ($err_msg, 0, $err_severity, $err_file, $err_line);
        case E_STRICT:              throw new StrictException           ($err_msg, 0, $err_severity, $err_file, $err_line);
        case E_RECOVERABLE_ERROR:   throw new RecoverableErrorException ($err_msg, 0, $err_severity, $err_file, $err_line);
        case E_DEPRECATED:          throw new DeprecatedException       ($err_msg, 0, $err_severity, $err_file, $err_line);
        case E_USER_DEPRECATED:     throw new UserDeprecatedException   ($err_msg, 0, $err_severity, $err_file, $err_line);
    }
});

class WarningException              extends ErrorException {}
class ParseException                extends ErrorException {}
class NoticeException               extends ErrorException {}
class CoreErrorException            extends ErrorException {}
class CoreWarningException          extends ErrorException {}
class CompileErrorException         extends ErrorException {}
class CompileWarningException       extends ErrorException {}
class UserErrorException            extends ErrorException {}
class UserWarningException          extends ErrorException {}
class UserNoticeException           extends ErrorException {}
class StrictException               extends ErrorException {}
class RecoverableErrorException     extends ErrorException {}
class DeprecatedException           extends ErrorException {}
class UserDeprecatedException       extends ErrorException {}
 */