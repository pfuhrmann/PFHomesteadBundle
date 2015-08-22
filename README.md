# PFHomesteadBundle
Bundle for configuring and using [Laravel Homestead VM](http://laravel.com/docs/master/homestead) 
seamlessly within your Symfony projects  
- Based on amazing [laravel/homestead](https://github.com/laravel/homestead) package

## Install
### Use Composer for installing
```bash
$ composer require pfuhrmann/homestead-bundle
```

### Update ``app/AppKernel.php``
```php
<?php
// app/AppKernel.php

// ...
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            // ...

            new PF\HomesteadBundle\PFHomesteadBundle(),
        );

        // ...
    }

    // ...
}
```
## Configuration
Config options are identical to those described in [Homestead docs](http://laravel.com/docs/master/homestead)

### Add Homestead configuration to ``app/config/config_dev.yml``
```yaml
pf_homestead:
    ip: "192.168.10.10"
    memory: 2048
    cpus: 1
    provider: virtualbox
    authorize: ~/.ssh/id_rsa.pub
    name: vagrant
    hostname: homestead
    keys:
        - ~/.ssh/id_rsa
    folders:
        - map: ~/www/your-project
          to: /home/vagrant/your-project
          type: "nfs"
    sites:
        - map: app.local
          to: /home/vagrant/your-project/web
    databases:
        - database_name
    # variables:
    #     - key: APP_ENV
    #       value: local
    # blackfire:
    #     - id: foo
    #       token: bar
    #       client-id: foo
    #       client-token: bar
    # ports:
    #     - send: 93000
    #       to: 9300
    #     - send: 7777
    #       to: 777
    #       protocol: udp
```

## Commands
#### Start the Homestead VM
```bash
$ php app/console homestead:up
```

#### SSH into the Homestead VM
```bash
$ php app/console homestead:ssh
```

#### Run the command inside the Homestead VM
```bash
$ php app/console homestead:run some_command
```

#### Pause/suspend Homestead VM
```bash
$ php app/console homestead:suspend
```

#### Resume Homestead VM
```bash
$ php app/console homestead:resume
```

#### Provision Homestead VM
```bash
$ php app/console homestead:provision
``````

#### Halt Homestead VM
```bash
$ php app/console homestead:halt
```

#### Destroy Homestead VM
```bash
$ php app/console homestead:destroy
```

#### Display OpenSSH valid configuration
```bash
$ php app/console homestead:ssh-config
```

#### Display the status of the Homestead VM
```bash
$ php app/console homestead:status
```

#### Update Homestead VM
```bash
$ php app/console homestead:update
```
