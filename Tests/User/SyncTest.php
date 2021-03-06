<?php namespace JFusion\Tests\User;
/**
 * Model that handles the usersync
 *
 * PHP version 5
 *
 * @category  JFusion
 * @package   Models
 * @author    JFusion Team <webmaster@jfusion.org>
 * @copyright 2008 JFusion. All rights reserved.
 * @license   http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link      http://www.jfusion.org
 */

use JFusion\Tests\Abstracts\FrameworkTestCase;
use JFusion\User\Sync;

use Joomla\Registry\Registry;

/**
 * Class for usersync JFusion functions
 *
 * @category  JFusion
 * @package   Models
 * @author    JFusion Team <webmaster@jfusion.org>
 * @copyright 2008 JFusion. All rights reserved.
 * @license   http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link      http://www.jfusion.org
 */
class SyncTest extends FrameworkTestCase
{
	public function test_getLogData() {
		$log = Sync::getLogData('asdf125');
		$this->assertCount(3, $log);

		$log = Sync::getLogData('asdf125', 'created');
		$this->assertCount(1, $log);

		$log = Sync::getLogData('asdf125', 'error');
		$this->assertCount(1, $log);

		$log = Sync::getLogData('asdf125', 'unchanged');
		$this->assertCount(1, $log);
	}

	public function test_countLogData() {
		$count = Sync::countLogData('asdf125');
		$this->assertSame(3, $count);

		$count = Sync::countLogData('asdf125', 'created');
		$this->assertSame(1, $count);

		$count = Sync::countLogData('asdf125', 'error');
		$this->assertSame(1, $count);

		$count = Sync::countLogData('asdf125', 'unchanged');
		$this->assertSame(1, $count);
	}

	public function test_saveData() {
		$sync = new Registry();

		$sync->set('syncid', 'foobaa');
		$sync->set('action', 'lol');

		Sync::saveData($sync);

		$data = Sync::getData('foobaa');

		$this->assertSame('foobaa', $data->get('syncid', null));
	}

	public function test_updateData() {
		$data = Sync::getData('asdf125');

		$data->set('data', 'World');

		Sync::updateData($data);

		$data = Sync::getData('asdf125');

		$this->assertSame('World', $data->get('data', null));
	}

	public function test_getData() {
		$data = Sync::getData('asdf125');
		$this->assertSame('asdf125', $data->get('syncid', null));
	}


	public function test_syncError() {
		$this->markTestSkipped();
	}

	public function test_markResolved() {
		$log = Sync::getLogData('asdf125', 'error');
		$this->assertCount(1, $log);

		Sync::markResolved(2);

		$log = Sync::getLogData('asdf125', 'error');
		$this->assertCount(0, $log);
	}

	public function test_syncExecute() {
		$this->markTestSkipped();
	}

	public function test_changeStatus() {
		$status = Sync::getStatus('asdf125');
		$this->assertSame(1, $status);

		Sync::changeStatus('asdf125', 0);

		$status = Sync::getStatus('asdf125');
		$this->assertSame(0, $status);
	}

	public function test_getStatus() {
		$status = Sync::getStatus('asdf125');
		$this->assertSame(1, $status);
	}
}