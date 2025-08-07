<?php

interface WriterInterface {

    /**
     * @param resource $filehandle
     */
    public function writeHeader($filehandle);

    /**
     * @param resource $filehandle
     * @param array $data
     */
    public function write($filehandle, $data);

    /**
     * @param string $filename
     * 
     * @return string
     */
    public static function generateNewFilename($filename): string;
}