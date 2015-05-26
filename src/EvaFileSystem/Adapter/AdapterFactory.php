<?php
/**
 * User: mr.5<mr5.simple@gmail.com>
 * Date: 2014-10-10 18:55
 */

namespace Eva\EvaFileSystem\Adapter;


use Eva\EvaEngine\IoC;

class AdapterFactory
{
    protected static $adapters = [];

    /**
     * @param $configKey
     * @return \Eva\EvaFileSystem\Adapter\AdapterAbstract
     * @throws \Eva\EvaEngine\Exception\RuntimeException
     */
    public static function getAdapter($configKey)
    {
        if (!isset(static::$adapters[$configKey])) {
            /** @var \Phalcon\Config $config */
            $config = IoC::get('config');
            $adapterClass = $config->filesystem->$configKey->adapter;
            $adapterOptions = $config->filesystem->$configKey->options;
            static::$adapters[$configKey] = new $adapterClass($adapterOptions);
        }


        return static::$adapters[$configKey];
    }
} 