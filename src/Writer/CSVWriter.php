<?php

namespace App\Writer;

class CSVWriter implements WriterInterface {

    /**
     * @param resource $filehandle
     * 
     * @throws ValueError
     */
    public function writeHeader($filehandle) {
        fputcsv($filehandle, [
            'id',
            'appCode',
            'deviceId',
            'contactable',
            'subscription_status',
            'has_downloaded_free_product_status',
            'has_downloaded_iap_product_status',
        ], ',');
    }

    /**
     * @param resource $filehandle
     * @param array $data
     * 
     * @throws ValueError
     */
    public function write($filehandle, $data) {
        fputcsv($filehandle, $data, ',');
    }

    /**
     * @param string $filename
     * 
     * @return string
     */
    public static function generateNewFilename($filename): string {
        return substr($filename, 0, strrpos($filename, '.')) . '.csv';
    }
}