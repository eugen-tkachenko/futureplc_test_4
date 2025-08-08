<?php

namespace App;

use App\Parser\LogParser;
use App\DTO\DataDTO;
use App\Writer\CSVWriter;

class ParserFacade {

    /**
     * The entry point.
     * All parameters MUST realise interfaces
     */
    public function __construct(
        private LogParser $parser, 
        private DataDTO $dataDTO,
        private CSVWriter $writer,
    ){}

    /**
     * Here, we parse all the appCodes 
     * and find all the files we want to process
     * 
     * @param string $path
     * @param string $fileExtension
     */
    public function process($path, $fileExtension) {
        
        echo "Processing started...\n";
        
        // we use the DTO class as a storage for now
        $DTOClass = get_class($this->dataDTO);

        $DTOClass::$appCodes = $this->parser->parseAppCodes($path);

        $files = $this->parser->findAllFiles($path, $fileExtension);

        foreach ($files as $filename) {
            $this->processFile($filename);
        }

        echo "Processing finished successfully\n";
    }

    /** 
     * Processes a single data file
     * 
     * @param string $filename
     */
    protected function processFile($filename) {

        $writerClass = get_class($this->writer);
        $newFilename = $writerClass::generateNewFilename($filename);

        $oldfile = fopen($filename, 'r');
        $newfile = fopen($newFilename, 'w');       

        try {
            $this->writer->writeHeader($newfile);

            // skip header
            $buffer = fgets($oldfile);

            while (($buffer = fgets($oldfile)) !== false) {
                $data = $this->dataDTO->process($buffer);
                $this->writer->write($newfile, $data);
            }

        } catch (Exception $e) {
            echo 'Error while writing to the file: ""' . $e->getMessage() . "\n";
        } finally {
            fclose($oldfile);
            fclose($newfile);
        }
    }
}