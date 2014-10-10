<?php

namespace Eva\EvaFileSystem;

use Phalcon\Loader;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Eva\EvaEngine\Module\StandardInterface;

class Module implements ModuleDefinitionInterface, StandardInterface
{
    public static function registerGlobalAutoloaders()
    {
        return array(
            'Eva\EvaFileSystem' => __DIR__ . '/src/EvaFileSystem',
        );
    }

    public static function registerGlobalEventListeners()
    {
    }

    public static function registerGlobalViewHelpers()
    {
        return array(
            'thumbWithClass' => 'Eva\EvaFileSystem\ViewHelpers\ThumbWithClass'
        );
    }

    public static function registerGlobalRelations()
    {
    }

    /**
     * Registers the module auto-loader
     */
    public function registerAutoloaders()
    {

    }

    /**
     * Registers the module-only services
     *
     * @param \Phalcon\DI $di
     */
    public function registerServices($di)
    {
        $dispatcher = $di->getDispatcher();
        $dispatcher->setDefaultNamespace('Eva\EvaFileSystem\Controllers');

        $self = $this;
        $di->set('customFilesystem', function ($configKey) use ($self, $di) {
            return $self->diCustomFilesystemFilesystem($di, $configKey);
        });
    }

    /**
     * 自定义文件系统 DI
     *
     * @param \Phalcon\DI $di
     * @param string $configKey
     */
    protected function diCustomFilesystemFilesystem($di, $configKey)
    {
        /** @var \Phalcon\Config $config */
        $config = $di->getConfig();
        $adapterClass = $config->filesystem->$configKey->adapter;
        $adapterOptions = $config->filesystem->$configKey->options;
        $adapter = new $adapterClass($adapterOptions);

        return $adapter;
    }
}
