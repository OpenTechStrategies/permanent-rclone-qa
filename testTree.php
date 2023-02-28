<?php
$inputCharacters = ['-','/','?','@','!','*','#','%','&','{','}','<','>',' ','\$','!',':','+','`','|','=','123','\\','\''];
$filenameFirst  = "new";
$filenameSecond  = "file";
$outputFilename =[];
$source = __DIR__ . "/testfile.txt";
$destination = __DIR__ ."/generatedFiles";
if (!is_dir($destination)) {
    mkdir($destination, 0777, true);
}
foreach ($inputCharacters as $inputCharacter) {
    $addMiddleCharacter = $filenameFirst.htmlspecialchars($inputCharacter).$filenameSecond;
    $addStartCharacter = htmlspecialchars($inputCharacter).$filenameFirst.$filenameSecond;
    $addEndCharacter = $filenameFirst.$filenameSecond.htmlspecialchars($inputCharacter);

    try {
        if(file_exists($destination . '/' . $addStartCharacter . '.txt')) {
            unlink($destination . '/' . $addStartCharacter . '.txt');
        }
        copy($source, $destination . '/' . $addStartCharacter.'.txt');

        if(file_exists($destination . '/' . $addMiddleCharacter . '.txt')) {
            unlink($destination . '/' . $addMiddleCharacter . '.txt');
        }
        copy($source, $destination . '/' . $addMiddleCharacter.'.txt');

        if(file_exists($destination . '/' . $addEndCharacter . '.txt')) {
            unlink($destination . '/' . $addEndCharacter . '.txt');
        }
        copy($source, $destination . '/' . $addEndCharacter.'.txt');
    }
    catch(Exception $e){
        throw new Exception('File cannot be copied! ',$e);
    }
    array_push($outputFilename,$addMiddleCharacter, $addStartCharacter, $addEndCharacter);
}
