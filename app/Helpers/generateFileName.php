<?php

    function generateFileName($fileName){
        $name = uniqid();
        $lastIndex = strrpos($fileName,'.');
        $extension = substr($fileName, $lastIndex);
        $newFileName = $name . $extension;
        return $newFileName;
    }

?>
