<?php

//upload file
function uploadFile($nameFolder, $file)
{
    $fileName = time() . '' . $file->getClientOriginalName();
    return $file->storeAS($nameFolder, $fileName, 'public');
}
