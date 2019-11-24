```

phpconsole
			
An object-oriented multi process manager for PHP

Version: 0.5.0

```



# How to use?

### Install

```
composer create-project wanglelecc/phpconsole phpconsole --prefer-dist && cd phpconsole
```

### Business code

```php

new Manager([], function (Process $worker) {
			// mock business logic
			(new Test())->businessLogic();
		}
	);
```

### Run


> composer install

```
php phpconsole start/reload/quit/stop --worker-num=2  > /dev/null &
```

### Manager process

- start \<worker-num\> \<passwd\>: start the phpconsole
- reload: gracefully quit&start the worker process
- quit: gracefully exit
- stop: forcefully exit

# Specification

- English

## Acknowledgments
- https://github.com/TIGERB/naruto