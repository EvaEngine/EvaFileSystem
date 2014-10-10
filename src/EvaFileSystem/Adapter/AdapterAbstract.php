<?php
namespace Eva\EvaFileSystem\Adapter;

use Gaufrette\Adapter;
use Phalcon\Mvc\User\Component;

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
    abstract public function thumbWitchClass($filename, $styleClass, $configKey);
}
