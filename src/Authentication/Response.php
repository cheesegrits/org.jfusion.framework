<?php namespace JFusion\Authentication;
/**
 * @package     Joomla.Platform
 * @subpackage  User
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

use JFusion\Debugger\Debugger;

use \stdClass;

/**
 * Authentication response class, provides an object for storing user and error details
 *
 * @package     Joomla.Platform
 * @subpackage  User
 * @since       11.1
 */
class Response
{
	/**
	 * Response status (see status codes)
	 *
	 * @var    string
	 * @since  11.1
	 */
	public $status = Authentication::STATUS_FAILURE;

	/**
	 * The type of authentication that was successful
	 *
	 * @var    string
	 * @since  11.1
	 */
	public $type = '';

	/**
	 *  The error message
	 *
	 * @var    string
	 * @since  11.1
	 */
	public $error_message = '';

	/**
	 * Any UTF-8 string that the End User wants to use as a username.
	 *
	 * @var    string
	 * @since  11.1
	 */
	public $username = '';

	/**
	 * Any UTF-8 string that the End User wants to use as a password.
	 *
	 * @var    string
	 * @since  11.1
	 */
	public $password = '';

	/**
	 * The email address of the End User as specified in section 3.4.1 of [RFC2822]
	 *
	 * @var    string
	 * @since  11.1
	 */
	public $email = '';

	/**
	 * UTF-8 string free text representation of the End User's full name.
	 *
	 * @var    string
	 * @since  11.1
	 *
	 */
	public $fullname = '';

	/**
	 * Userinfo
	 *
	 * @var    stdClass
	 * @since  11.1
	 *
	 */
	public $userinfo = '';

	/**
	 * The End User's date of birth as YYYY-MM-DD. Any values whose representation uses
	 * fewer than the specified number of digits should be zero-padded. The length of this
	 * value MUST always be 10. If the End User user does not want to reveal any particular
	 * component of this value, it MUST be set to zero.
	 *
	 * For instance, if a End User wants to specify that his date of birth is in 1980, but
	 * not the month or day, the value returned SHALL be "1980-00-00".
	 *
	 * @var    string
	 * @since  11.1
	 */
	public $birthdate = '';

	/**
	 * The End User's gender, "M" for male, "F" for female.
	 *
	 * @var    string
	 * @since  11.1
	 */
	public $gender = '';

	/**
	 * UTF-8 string free text that SHOULD conform to the End User's country's postal system.
	 *
	 * @var    string
	 * @since  11.1
	 */
	public $postcode = '';

	/**
	 * The End User's country of residence as specified by ISO3166.
	 *
	 * @var    string
	 * @since  11.1
	 */
	public $country = '';

	/**
	 * End User's preferred language as specified by ISO639.
	 *
	 * @var    string
	 * @since  11.1
	 */
	public $language = '';

	/**
	 * ASCII string from TimeZone database
	 *
	 * @var    string
	 * @since  11.1
	 */
	public $timezone = '';

	/**
	 * ASCII string from TimeZone database
	 *
	 * @var    Debugger
	 * @since  11.1
	 */
	public $debugger = null;
}
