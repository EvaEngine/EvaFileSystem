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

class ThumbWithClass extends Files
{
    public function __invoke($filename, $class)
    {
        $config = $this->getConfig();
        $classSeparator = $config->thumbClassSeparator ? $config->thumbClassSeparator : '!';
        return $filename . $classSeparator . $class;
    }
} 