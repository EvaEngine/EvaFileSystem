<?php
namespace Eva\EvaFileSystem\ViewHelpers;

// +----------------------------------------------------------------------
// | [wallstreetcn]
// +----------------------------------------------------------------------
// | Author: Mr.5 <mr5.simple@gmail.com>
// +----------------------------------------------------------------------
// + Datetime: 14-9-24 15:43
// +----------------------------------------------------------------------
// + ThumbWithClass.php
// +----------------------------------------------------------------------

use Eva\EvaFileSystem\Entities\Files;
use Phalcon\Text;

class ThumbWithClass extends Files
{
    public function __invoke($filename, $styleClass, $configKey = 'default')
    {
        if (Text::startsWith($filename, 'http://www.gravatar.com/', false)) {
            return $filename;
        }
        $config = $this->getDI()->getConfig();
        if ($configKey == 'default') {
            if (isset($config->thumbnail->$configKey->baseUri) && $baseUrl = $config->thumbnail->$configKey->baseUri) {
                $config = $this->getConfig();
                $classSeparator = $config->thumbClassSeparator ? $config->thumbClassSeparator : '!';

                $uri = $filename . $classSeparator . $styleClass;

                $baseUrl = Text::startsWith($filename, 'http://', false) ? '' : $baseUrl;
                return $baseUrl . $uri;
            }
        } else {
            /** @var \Eva\EvaFileSystem\Adapter\AdapterAbstract $adapter */
            $adapter = $this->getDI()->get($configKey . 'Filesystem');
            return $adapter->thumbWitchClass($filename, $styleClass, $configKey);
        }
        return $filename;
    }
}
