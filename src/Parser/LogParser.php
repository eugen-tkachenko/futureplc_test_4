<?php

namespace App\Parser;

class LogParser implements ParserInterface {

    /**
     * @param string $filename
     * @throws Exception
     * 
     * @return array
     * 
     * TODO: add storage support
     */
    function parseAppCodes(string $path): array {

        $codes = [];

        $filename = $path . DIRECTORY_SEPARATOR . 'appCodes.ini';

        $lineCounter = 0;

        $filehandle = fopen($filename, 'r');
        
        while (($buffer = fgets($filehandle)) !== false) {
            $lineCounter++;
            
            // regex attemp
            // [\w-]+\s+=\s+"[&\w:\s()-.'"]+"\n
            if (strpos($buffer, ' = ') === false) continue;

            [$key, $value] = explode(' = ', $buffer);

            // more validation? it goes here
            if ( !$key || !$value) 
                throw new \Exception("Can't read the $key appCode on line $lineCounter");

            $codes[trim(str_replace('"', '', $value))] = trim($key);
        }

        fclose($filehandle);
        
        return $codes;
    }

    /**
     * @param string $dir
     * @param string $fileExtension
     * 
     * @return array
     */
    public function findAllFiles(string $dir, string $fileExtension, $result = []): array {        
        $files = scandir($dir);

        foreach ($files as $value) {
            $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
            if ( !is_dir($path) ) {
                if ( pathinfo($path, PATHINFO_EXTENSION) === $fileExtension )
                    $result[] = $path;
            } else if ($value != "." && $value != "..") {
                $result = self::findAllFiles($path, $fileExtension, $result);
            }
        }

        return $result;
    }
}