<?php

namespace app\config\components;

use yii\base\Component;

class Common extends Component
{
    /**
     * @param $array
     * @return void
     */
    public function debug($array)
    {
        echo '<pre>'.print_r($array, true).'</pre>';
    }
}