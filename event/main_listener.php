<?php
/**
 *
 * DOL - Discord OAuth2 light. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2019, phpBB Studio, https://www.phpbbstudio.com
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace phpbbstudio\dol\event;

/**
 * @ignore
 */
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * DOL - Discord OAuth2 light Event listener.
 */
class main_listener implements EventSubscriberInterface
{
	/* @var \phpbb\language\language */
	protected $language;

	/**
	 * Constructor
	 *
	 * @param  \phpbb\language\language		$language		Language object
	 * @return void
	 * @access public
	 */
	public function __construct(\phpbb\language\language $language)
	{
		$this->language = $language;
	}

	/**
	 * Assign functions defined in this class to event listeners in the core.
	 *
	 * @return array
	 * @access public
	 * @static
	 */
	public static function getSubscribedEvents()
	{
		return [
			'core.user_setup_after'		=> 'dol_load_language_on_setup',
		];
	}

	/**
	 * Load extension language file during after user set up.
	 *
	 * @event  core.user_setup_after
	 * @return void
	 * @access public
	 */
	public function dol_load_language_on_setup()
	{
		$this->language->add_lang('dol_common', 'phpbbstudio/dol');
	}
}
