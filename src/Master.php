<?php
/****************************************************
 *                     phpConsole                   *
 *                                                  *
 * An object-oriented multi process manager for PHP *
 *                                                  *
 *                                                  *
 ****************************************************/

namespace Console;

use Console\Manager;
use Console\Process;
use Console\ProcessException;
use Closure;

/**
 * master process class
 */
class Master extends Process
{

	protected $pidPath = 'storage/temp/master.pid';

	/**
	 * construct function
	 */
	public function __construct()
	{
		$this->type = 'master';
		$this->setProcessName();
		parent::__construct();
		
		ProcessException::info([
			'msg' => [
				'from'  => 'master',
				'extra' => 'master instance create'
			]
		]);

		// make pipe
		$this->pipeMake();

		// make pid
		$this->pidMake();
		
	}

	/**
	 * hangup function
	 *
	 * @param Closure $closure
	 * @return void
	 */
	public function hangup(Closure $closure)
	{
		# do nothing...
	}


	public function pidMake()
	{
		$pidDir = dirname($this->pidPath);
		if ( !file_exists( $pidDir ) ) {
			mkdir($pidDir, 755, true);
		}

		file_put_contents($this->pidPath, posix_getpid());
	}

	public function clearPid()
	{
		if ( file_exists( $this->pidPath ) ) {
			unlink($this->pidPath);
		}
	}
}
