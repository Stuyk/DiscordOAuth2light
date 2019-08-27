<?php
/**
 *
 * DOL - Discord OAuth2 light. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2019, phpBB Studio, https://www.phpbbstudio.com
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace phpbbstudio\dol\migrations;

class install_config extends \phpbb\db\migration\migration
{
	/**
	 * Check if the migration is effectively installed.
	 *
	 * @return bool			True if this migration is installed or false otherwise.
	 * @access public
	 */
	public function effectively_installed()
	{
		return $this->config->offsetExists('auth_oauth_studio_discord_key');
	}

	/**
	 * Assign migration file dependencies for this migration.
	 *
	 * @return array		Array of migration files
	 * @access public
	 * @static
	 */
	public static function depends_on()
	{
		return ['\phpbb\db\migration\data\v32x\v327'];
	}

	/**
	 * Add the DOL extension configurations to the database.
	 *
	 * @return array		Array of configs
	 * @access public
	 */
	public function update_data()
	{
		return [
			['config.add', ['auth_oauth_studio_discord_key', '']],
			['config.add', ['auth_oauth_studio_discord_secret', '']],
		];
	}
}
