<?php
/**
 * User: mr.5<mr5.simple@gmail.com>
 * Date: 2014-10-10 18:55
 */

namespace Eva\EvaFileSystem\Adapter;


use Eva\EvaEngine\IoC;

class AdapterFactory {
    public static  function getAdapter($configKey)
    {
        /** @var \Phalcon\Config $config */
        $config = IoC::get('config');
        $adapterClass = $config->filesystem->$configKey->adapter;
        $adapterOptions = $config->filesystem->$configKey->options;
        $adapter = new $adapterClass($adapterOptions);

        return $adapter;
    }
} 