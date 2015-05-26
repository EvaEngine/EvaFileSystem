<?php

namespace Eva\EvaFileSystem\Entities;

use Eva\EvaEngine\Exception;
use Eva\EvaFileSystem\ViewHelpers\ThumbWithClass;

class Files extends \Eva\EvaEngine\Mvc\Model
{
    protected $tableName = 'file_files';

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $title;

    /**
     *
     * @var string
     */
    public $status;

    /**
     *
     * @var string
     */
    public $storageAdapter;


    /**
     *
     * @var string
     */
    public $isImage;

    /**
     *
     * @var string
     */
    public $fileName;

    /**
     *
     * @var string
     */
    public $fileExtension;

    /**
     *
     * @var string
     */
    public $originalName;

    /**
     *
     * @var string
     */
    public $filePath;

    /**
     *
     * @var string
     */
    public $fileHash;

    /**
     *
     * @var integer
     */
    public $fileSize;

    /**
     *
     * @var string
     */
    public $mimeType;

    /**
     *
     * @var integer
     */
    public $imageWidth;

    /**
     *
     * @var integer
     */
    public $imageHeight;

    /**
     *
     * @var string
     */
    public $description;

    /**
     *
     * @var integer
     */
    public $sortOrder;

    /**
     *
     * @var integer
     */
    public $userId;

    /**
     *
     * @var string
     */
    public $username;

    /**
     *
     * @var integer
     */
    public $createdAt;
    /**
     * @var string
     */
    public $configKey = 'default';

    private $configReady = false;

    private $uploadPath;

    private $uploadTmpPath;

    private $uploadPathlevel;

    private $baseUrlForLocal;

    private $baseUrl;

    public function getUploadPath()
    {
        $this->readConfig();

        return $this->uploadPath;
    }

    public function getUploadTmpPath()
    {
        $this->readConfig();

        return $this->uploadTmpPath;
    }

    public function getUploadPathLevel()
    {
        $this->readConfig();

        return $this->uploadPathLevel;
    }

    public function getBaseUrlForLocal()
    {
        $this->readConfig();

//        p($this->baseUrlForLocal);
        return $this->baseUrlForLocal;
    }

    public function getBaseUrl()
    {
        $this->readConfig();

        return $this->baseUrl;
    }

    public function setConfigKey($configKey)
    {
        $this->configKey = $configKey;

        return $this;
    }

    public function getConfigKey()
    {
        return $this->configKey;
    }

    public function getConfig()
    {
        $configKey = $this->configKey;
        if (empty($this->getDI()->getConfig()->filesystem->$configKey)) {
            throw new Exception\InvalidArgumentException(sprintf('No matched file system config key %s found',
                $configKey));
        }

        return $this->getDI()->getConfig()->filesystem->$configKey;
    }

    public function readConfig()
    {
//        if (true === $this->configReady) {
//            return $this;
//        }
        $config = $this->getConfig();

        $this->uploadPath = @$config->uploadPath;
        $this->uploadTmpPath = @$config->uploadTmpPath;
        $this->uploadPathLevel = @$config->uploadPathLevel;
        $this->baseUrlForLocal = @$config->baseUrlForLocal;
        $this->baseUrl = @$config->baseUrl;
        $this->configReady = true;

        return $this;
    }


    public function getFullUrl($style = '')
    {
        if (!$this->id) {
            return '';
        }
        $thumbWithClass = new ThumbWithClass();

        return $thumbWithClass($this->getLocalUrl(), $style);
    }

    public function getLocalUrl()
    {
        if (!$this->id) {
            return '';
        }

        return
            rtrim($this->getBaseUrlForLocal(), '/')
            . '/'
            . trim($this->filePath, '/')
            . '/'
            . ltrim($this->fileName, '/');
    }

    public function getLocalPath()
    {
        if (!$this->id) {
            return '';
        }

        return $this->getUploadPath() . '/' . $this->filePath . '/' . $this->fileName;
    }

    public function getReadableFileSize()
    {
        $size = $this->fileSize;
        $units = array(' B', ' KB', ' MB', ' GB', ' TB');
        for ($i = 0; $size >= 1024 && $i < 4; $i++) {
            $size /= 1024;
        }

        return round($size, 2) . $units[$i];
    }

    public function initialize()
    {
        $this->belongsTo('userId', 'Eva\EvaUser\Entities\Users', 'id', array(
            'alias' => 'User'
        ));
    }
}
