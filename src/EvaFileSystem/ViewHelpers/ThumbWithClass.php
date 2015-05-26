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

use Eva\EvaFileSystem\Adapter\AdapterFactory;
use Phalcon\Text;

class ThumbWithClass
{
    public function __invoke($filename, $styleClass, $configKey = 'default')
    {
        if (Text::startsWith($filename, 'http://www.gravatar.com/', false)) {
            return $filename;
        }

        $adapter = AdapterFactory::getAdapter($configKey);

        return $adapter->thumbWitchClass($filename, $styleClass, $configKey);

    }
}
