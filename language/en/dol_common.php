<?php
/**
 *
 * DOL - Discord Oauth2 light. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2019, phpBB Studio, https://www.phpbbstudio.com
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = [];
}

/**
* Some characters you may want to copy&paste: ’ » “ ” …
*/
$lang = array_merge($lang, [
	'AUTH_PROVIDER_OAUTH_SERVICE_DISCORD'		=> 'Discord',

	'PHPBBSTUDIO_DOL_EXCEPTION_TOKEN'			=> 'Something went wrong requesting an Discord OAuth2 access token.<br>
													Original error message:<br>
													<samp class="error">%s</samp><br><br>
													<em>Did you perhaps refresh the page after linking an account?</em>',

	'PHPBBSTUDIO_DOL_EXCEPTION_USER_INFO'		=> 'Something went wrong requesting the Discord OAuth2 account information.<br><br>
													Original error message:<br>
													<samp class="error">%s</samp>',

	// Translators please do not change the following line, no need to translate it!
	'PHPBBSTUDIO_DOL_CREDIT_LINE'				=> '<a href="https://phpbbstudio.com">Discord OAuth2 light</a> &copy; 2019 - phpBB Studio',
]);
