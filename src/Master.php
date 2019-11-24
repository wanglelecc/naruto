<?php
/****************************************************
 *                     phpconsole                   *
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
}
