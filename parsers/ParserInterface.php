<?php

interface ParserInterface {

    /**
     * @param string $filename
     * @throws Exception
     * 
     * @return array
     * 
     * TODO: add storage support
     */
    public function parseAppCodes(string $path): array;

    /**
     * @param string $dir
     * @param string $fileExtension
     * 
     * @return array
     */
    public function findAllFiles(string $dir, string $fileExtension, $result = []): array;
    
}