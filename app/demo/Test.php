<?php
/****************************************************
 *                     phpconsole                   *
 *                                                  *
 * An object-oriented multi process manager for PHP *
 *                                                  *
 *                                                  *
 ****************************************************/

namespace App\Demo;

use Console\ProcessException;

class Test
{
    public function businessLogic($worker)
    {
        $time = microtime(true);
        ProcessException::debug([
            'msg' => [
                'microtime' => $time,
                'debug' 	=> 'this is the business logic '.$worker->pid,
            ]
        ]);


        // mock business logic
//        usleep(1000000);
		sleep(1);
    }
}
