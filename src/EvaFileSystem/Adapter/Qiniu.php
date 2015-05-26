<?php

namespace Eva\EvaFileSystem\Adapter;

use Gaufrette\Adapter;
use Gaufrette\Adapter\MetadataSupporter;

class Qiniu extends AdapterAbstract implements
    MetadataSupporter
{
    protected $bucket;
    protected $client;
    /**
     * @var \Phalcon\Config
     */
    protected $config;

    public function __construct($options)
    {
        // $accessKey, $secretKey, $bucket
        \Qiniu_setKeys($options['accessKey'], $options['secretKey']);
        $this->bucket = $options['bucket'];
        $this->client = new \Qiniu_MacHttpClient(null);
    }

    /**
     * Reads the content of the file
     *
     * @param string $key
     *
     * @return string|boolean if cannot read content
     */
    public function read($key)
    {
        // TODO: Implement read() method.
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
        $putPolicy = new \Qiniu_RS_PutPolicy($this->bucket);
        $upToken = $putPolicy->Token(null);

        list($ret, $err) = \Qiniu_Put($upToken, $key, $content, null);
        if ($err !== null) {
            return false;
        } else {
            return true;
        }
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
        // TODO: Implement exists() method.
    }

    /**
     * Returns an array of all keys (files and directories)
     *
     * @return array
     */
    public function keys()
    {
        // TODO: Implement keys() method.
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
        // TODO: Implement mtime() method.
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
        return \Qiniu_RS_Delete($this->client, $this->bucket, $key) === null;

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
        return \Qiniu_RS_Move($this->client, $this->bucket, $sourceKey, $this->bucket, $targetKey) === null;
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
        // TODO: Implement isDirectory() method.
    }

    /**
     * @param string $key
     * @param array $content
     */
    public function setMetadata($key, $content)
    {
        // TODO: Implement setMetadata() method.
    }

    /**
     * @param  string $key
     * @return array
     */
    public function getMetadata($key)
    {
        list($ret, $err) = \Qiniu_RS_Stat($this->client, $this->bucket, $key);
        if ($err !== null) {
            return false;
        } else {
            return $ret;
        }
    }

    public function url($filename, $configKey)
    {

    }
}