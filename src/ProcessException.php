<?php
/****************************************************
 *                     phpConsole                   *
 *                                                  *
 * An object-oriented multi process manager for PHP *
 *                                                  *
 *                                                  *
 ****************************************************/

namespace Console;

use Exception;

/**
 * process exception class
 */
class ProcessException extends Exception
{
	/**
	 * log method support
	 *
	 * @var array
	 */
	private static $methodSupport = ['info', 'error', 'debug'];

	/**
	 * the log path
	 *
	 * @var string
	 */
	private static $logPath = 'phpconsole';
	
	/**
	 * the magic __callStatics function
	 *
	 * @param string $method
	 * @param array $data
	 * @return void
	 */
	public static function __callStatic($method = '', $data = [])
	{
		$data = $data[0];
		if (! in_array($method, self::$methodSupport)) {
			throw new Exception('log method not support', 500);
		}
		$logPath = (isset($data['path'])? $data['path']: '')? : config('storage.logs') . DIRECTORY_SEPARATOR . self::$logPath;
        $msg = self::decorate($method, $data['msg']);
		error_log($msg, 3, $logPath . '.' . date('Y-m-d', time()) . '.log');
		if ($method === 'error') {
			exit;
		}
	}

	/**
	 * decorate log msg
	 *
	 * @param string $rank
	 * @param array $msg
	 * @return void
	 */
	private static function decorate($rank = 'info', $msg = [])
	{
		$time        = date('Y-m-d H:i:s', time());
		$pid         = posix_getpid();
		$memoryUsage = round(memory_get_usage()/1024, 2) . ' kb';

		switch ($rank = strtolower($rank)) {
			case 'info':
				$cRank = "\033[36m{$rank} \033[0m";
			break;
			case 'error':
				$cRank = "\033[31m{$rank}\033[0m";
			break;
			case 'debug':
				$cRank = "\033[32m{$rank}\033[0m";
			break;

			default:
				$cRank = $rank;
			break;
		}

		$default = [
			$time,
			$cRank,
			$pid,
			$memoryUsage
		];

		if (! isset($msg['from']) || empty($msg['from'])) {
			$default[] = 'worker';
			unset($msg['from']);
		}

		$msg  = array_merge($default, $msg);

		echo implode(' | ', $msg) . PHP_EOL;

		$msg[1] = $rank;

        return implode(' | ', $msg) . PHP_EOL;
	}
}
