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

> echo export $PHPCONSOLE_PATH=$(pwd) >> ~/.profile && echo 'export PATH="$PATH:$$PHPCONSOLE_PATH/bin"' >> ~/.profile && source ~/.profile

> composer install

```
phpconsole start/reload/quit/stop
```

### Manager process

- start \<worker-num\> \<passwd\>: start the phpconsole
- reload: gracefully quit&start the worker process
- quit: gracefully exit
- stop: forcefully exit

# Specification

- English

## Acknowledgments
-- https://github.com/TIGERB/naruto