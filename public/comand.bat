echo off
REM This adds the folder containing php.exe to the path
PATH=%PATH%;C:\Zend\ZendServer\bin\

REM Change Directory to the folder containing your script
CD C:\Zend\Apache2\htdocs\zf2-tutorial

REM Execute
C:\Zend\ZendServer\bin\php public\index.php create crud Cliente 