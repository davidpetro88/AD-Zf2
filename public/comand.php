<?php
$test = shell_exec("c:\WINDOWS\system32\cmd.exe /c START C:\Zend\ZendServer\bin\php public\index.php create crud Cliente");

echo $test;