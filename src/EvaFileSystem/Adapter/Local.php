<?php
// +----------------------------------------------------------------------
// | wallstreetcn
// +----------------------------------------------------------------------
// | Author: Mr.5 <mr5.simple@gmail.com>
// +----------------------------------------------------------------------
// + Datetime: 15/5/26 下午5:04
// +----------------------------------------------------------------------
// + Local.php
// +----------------------------------------------------------------------

namespace Eva\EvaFileSystem\Adapter;

use Gaufrette\Adapter\Local as GaufretteLocal;

class Local extends AdapterAbstract
{

    protected $storage;

    /**
     * Reads the content of the file
     *
     * @param string $key
     *
     * @return string|boolean if cannot read content
     */
    public function read($key)
    {
        return $this->storage->read($key);
    }

    /**
     * Writes the given content into the file
     *
     * @param string $key
     * @param string $content
     *
     * @return integer|boolean The number of bytes that were written into the file
     */
    public function write($key, $content)
    {
        return $this->storage->write($key, $content);
    }

    /**
     * Indicates whether the file exists
     *
     * @param string $key
     *
     * @return boolean
     */
    public function exists($key)
    {
        return $this->storage->exists($key);
    }

    /**
     * Returns an array of all keys (files and directories)
     *
     * @return array
     */
    public function keys()
    {
        return $this->storage->keys();
    }

    /**
     * Returns the last modified time
     *
     * @param string $key
     *
     * @return integer|boolean An UNIX like timestamp or false
     */
    public function mtime($key)
    {
        return $this->storage->mtime($key);
    }

    /**
     * Deletes the file
     *
     * @param string $key
     *
     * @return boolean
     */
    public function delete($key)
    {
        return $this->storage->delete($key);
    }

    /**
     * Renames a file
     *
     * @param string $sourceKey
     * @param string $targetKey
     *
     * @return boolean
     */
    public function rename($sourceKey, $targetKey)
    {
        return $this->storage->rename($sourceKey, $targetKey);
    }

    /**
     * Check if key is directory
     *
     * @param string $key
     *
     * @return boolean
     */
    public function isDirectory($key)
    {
        return $this->storage->isDirectory($key);
    }

    public function __construct($options)
    {
        $this->storage = new GaufretteLocal($options['uploadPath']);
    }


    /**
     * 生成图片的绝对链接
     *
     * @param string $filename
     * @param string $configKey
     * @return string
     */
    public function url($filename, $configKey)
    {
        // TODO: Implement url() method.
    }
}