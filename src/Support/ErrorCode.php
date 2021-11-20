<?php

namespace Hahadu\ThinkAdmin\Support;
use ReflectionClass;
use ReflectionClassConstant;
use Hahadu\Reflector\Reflection;
class ErrorCode
{
    /** 成功 */
    const SUCCESS = 200;
    /** 失败 */
    const FAIL = 10000;

    public function getErrorCodeMessage($code = self::FAIL){
        if($code == self::SUCCESS){
            return "success";
        }
        $classDoc = new ReflectionClass(new self());
        $list = array_flip($classDoc->getConstants());
        $constant = new ReflectionClassConstant(new self(),$list[$code]);

        $doc = new Reflection($constant);
        $text = $doc->getContext();
        return $text;



    }


}