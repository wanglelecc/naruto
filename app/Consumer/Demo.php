<?php
// +----------------------------------------------------------------------
// |  
// | Demo Consumer
// | 
// +----------------------------------------------------------------------
// | Copyright (c) https://www.56br.com/ All rights reserved.
// +----------------------------------------------------------------------
// | Author:  wll <wanglelecc@gmail.com>
// +----------------------------------------------------------------------
// | Date: 2019-12-01 15:43
// +----------------------------------------------------------------------

namespace App\Consumer;

use Console\Process;
use Console\Callback;
use Console\ProcessException;


class Demo extends Consumer implements Callback
{
    public function handle(Process $process)
    {
        $time = microtime(true);

        ProcessException::debug([
            'msg' => [
                'microtime' => $time,
                'debug'     => 'this is the business logic ' . $process->pid,
            ]
        ]);

        sleep(1);
    }
}