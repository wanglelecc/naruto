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

	/**
	 * app name
	 *
	 * @var string
	 */
	public $appName = 'phpconsole';

	/**
	 * tmp dir
	 *
	 * @var string
	 */
	public $tmpDir = 'storage/tmp/';

	/**
	 * construct function
	 */
	public function __construct($config = [])
	{
		$this->type = 'master';

		$this->pipeDir = isset( $config[ 'pipe_dir' ] ) && !empty( $config[ 'pipe_dir' ] )
			? $config[ 'pipe_dir' ] : $this->pipeDir;
		$this->tmpDir  = isset( $config[ 'tmp_dir' ] ) ? $config[ 'tmp_dir' ] : $this->tmpDir;
		$this->appName = isset( $config[ 'app_name' ] ) ? $config[ 'app_name' ] : $this->appName;
		$this->pidDir  = $this->tmpDir;
		$this->pidPath = $this->pidDir . '/master.pid';

		parent::__construct();

		ProcessException::info( [
			'msg' => [
				'from'  => 'master',
				'extra' => 'master instance create',
			],
		] );

		$this->setProcessName();

		// make pipe
		$this->pipeMake();

		// make pid
		$this->pidMake();

	}

	/**
	 * hangup function
	 *
	 * @param Closure $closure
	 *
	 * @return void
	 */
	public function hangup(Closure $closure)
	{
		# do nothing...
	}

	/**
	 * create pid
	 *
	 * @return void
	 */
	public function pidMake()
	{
		$pidDir = dirname( $this->pidPath );
		if ( !file_exists( $pidDir ) ) {
			mkdir( $pidDir, 755, true );
		}

		file_put_contents( $this->pidPath, posix_getpid() );
	}

	/**
	 * clear pipe
	 *
	 * @return void
	 */
	public function clearPid()
	{
		if ( file_exists( $this->pidPath ) ) {
			unlink( $this->pidPath );
		}
	}
}
