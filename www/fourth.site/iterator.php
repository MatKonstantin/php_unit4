<?php

$fi = new FilesystemIterator('.');
foreach($fi as $fileInfo){
    echo $fileInfo;
    if($fileInfo->isFile()){
        echo '( ', $fileInfo->getExtension(), ') ';
    }
    echo '<hr>';
}

class HtmlFilterIterator extends FilterIterator
{
    public function accept() {
        $fileInfo = $this
            ->getInnerIterator()
            ->current();
        return preg_match('/\.html$/', $fileInfo);
    }
}

echo "<h2>HTML файлы</h2>";
$iterator = new HtmlFilterIterator($fi);
foreach($iterator as $fileInfo){
    echo $fileInfo, '<hr>';
}