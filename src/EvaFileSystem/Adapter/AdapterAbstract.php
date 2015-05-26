<?php
namespace Eva\EvaFileSystem\Adapter;

use Eva\EvaEngine\IoC;
use Gaufrette\Adapter;
use Phalcon\Mvc\User\Component;
use Phalcon\Text;

/**
 * 文件系统适配器抽象类
 * @author mr.5<mr5.simple@gmail.com>
 * @package Eva\EvaFileSystem\Adapter
 */
abstract class AdapterAbstract extends Component implements Adapter
{
//    abstract public function thumb();

    abstract public function __construct($options);

    /**
     * 生成图片的绝对链接
     *
     * @param string $filename
     * @param string $configKey
     * @return string
     */
    abstract public function url($filename, $configKey);

    /**
     * 通过缩略图样式名称生成缩略图链接
     *
     * @param string $filename
     * @param string $styleClass
     * @param string $configKey
     * @return string
     */
    public function thumbWitchClass($filename, $styleClass, $configKey)
    {
        $config = IoC::get('config')->filesystem->$configKey;
        $separator = '!';
        if (isset($config->thumbClassSeparator)) {
            $separator = $config->thumbClassSeparator;
        }
        $styleClass = trim($styleClass);
        $uri = $styleClass ? $filename . $separator . $styleClass : $filename;
        $baseUrl = $config->baseUrl;
        $baseUrl = Text::startsWith($filename, 'http://', false) ? '' : $baseUrl;
        if ($baseUrl) {
            $baseUrl = rtrim($baseUrl, '/') . '/';
        }

        return $baseUrl . ltrim($uri, '/');
    }
}
