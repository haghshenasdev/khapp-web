<?php

namespace App\classes\HomeItemActionHandeler;

class hiHandeler
{
    public function getList(){
        $files = scandir(__DIR__.'/Actions');

        $myarr = [];
        foreach ($files as $file) {
            if ($file == '.' or $file == '..') continue;
            $classname = substr($file,0,-4);
            $myarr[$classname] = $this->getObjAction($classname)->actionTitle;
        }
        return $myarr;
    }

    public function getObjAction(string $classname) : hiAction
    {
        return new ('App\classes\HomeItemActionHandeler\Actions\\'.$classname)();
    }
}
