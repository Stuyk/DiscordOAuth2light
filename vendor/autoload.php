<?php
/**
 *
 * phpBB Studio - GitHub OAuth2 light. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2019, phpBB Studio, https://www.phpbbstudio.com
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

if (!defined('IN_PHPBB'))
{
	exit;
}

/**
 * The $class is passed by php automatically.
 * It's the name of the class not declared yet, but used somewhere in runtime.
 */
spl_autoload_register(function($class)
{
	$path = str_replace('\\', DIRECTORY_SEPARATOR, $class);

	$path = dirname(__DIR__) . DIRECTORY_SEPARATOR . $path . '.php';

	if (file_exists($path))
	{
		require $path;

		return true;
	}

	return false;
});
