<?php namespace JFusion\Application;
/**
 * @package     Joomla.Libraries
 * @subpackage  Application
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

use JFusion\Factory;
use JFusion\User\Userinfo;
use Joomla\Event\Event;
use Joomla\Input\Input;

/**
 * Joomla! CMS Application class
 *
 * @package     Joomla.Libraries
 * @subpackage  Application
 * @since       3.2
 */
class Application
{
	/**
	 * @var    Application  The application instance.
	 * @since  11.3
	 */
	protected static $instance;

	/**
	 * @var boolean $messageStatus
	 * @since  11.3
	 */
	private $messageStatus = true;

	/**
	 * @var Input $input
	 */
	public $input = null;

	/**
	 * Class constructor.
	 *
	 * @param   mixed  $input   An optional argument to provide dependency injection for the application's
	 *                          input object.  If the argument is a JInput object that object will become
	 *                          the application's input object, otherwise a default input object is created.
	 * @since   3.2
	 */
	public function __construct(Input $input = null)
	{
		// If a input object is given use it.
		if ($input instanceof Input)
		{
			$this->input = $input;
		}
		// Create the input based on the application logic.
		else
		{
			$this->input = new Input;
		}
	}

	/**
	 * Returns a reference to the global Application object, only creating it if it doesn't already exist.
	 *
	 * @return  Application
	 */
	public static function getInstance()
	{
		if (!static::$instance)
		{
			static::$instance = new Application();
		}
		return static::$instance;
	}

	/**
	 * Enqueue a system message.
	 *
	 * @param   string  $msg   The message to enqueue.
	 * @param   string  $type  The message type. Default is message.
	 *
	 * @return  void
	 *
	 * @since   3.2
	 */
	public function enqueueMessage($msg, $type = 'message')
	{
		if ($this->messageStatus) {
			$event = new Event('onApplicationEnqueueMessage');
			$event->addArgument('message', $msg);
			$event->addArgument('type', $type);
			Factory::getDispatcher()->triggerEvent($event);
		}
	}

	/**
	 * @param boolean $status
	 */
	public function messageStatus($status)
	{
		$this->messageStatus = $status;
	}

	/**
	 * Redirect to another URL.
	 *
	 * If the headers have not been sent the redirect will be accomplished using a "301 Moved Permanently"
	 * or "303 See Other" code in the header pointing to the new location. If the headers have already been
	 * sent this will be accomplished using a JavaScript statement.
	 *
	 * @param   string   $url    The URL to redirect to. Can only be http/https URL
	 * @param   boolean  $moved  True if the page is 301 Permanently Moved, otherwise 303 See Other is assumed.
	 *
	 * @return  void
	 *
	 * @since   11.3
	 */
	public function redirect($url, $moved = false)
	{
		$event = new Event('onApplicationRedirect');

		$event->addArgument('url', $url);
		$event->addArgument('moved', $moved);

		Factory::getDispatcher()->triggerEvent($event);
	}

	/**
	 * Retrieves the source of the avatar for a Joomla supported component
	 *
	 * @return string url of the default avatar
	 */
	public function getDefaultAvatar()
	{
		$event = new Event('onApplicationGetDefaultAvatar');
		Factory::getDispatcher()->triggerEvent($event);

		return $event->getArgument('avatar', false);
	}

	/**
	 * Load Script language
	 *
	 * @param string|array $keys
	 */
	public static function loadScriptLanguage($keys) {
		if (!empty($keys)) {
			$event = new Event('onApplicationLoadScriptLanguage');

			$event->setArgument('keys', $keys);

			Factory::getDispatcher()->triggerEvent($event);
		}
	}

	/**
	 * Load Script language
	 */
	public static function getUser() {
		$event = new Event('onApplicationGetUser');

		Factory::getDispatcher()->triggerEvent($event);

		$user = $event->getArgument('user', null);

		if ($user instanceof Userinfo) {
			return $user;
		} else {
			return new Userinfo(null);
		}
	}
}
