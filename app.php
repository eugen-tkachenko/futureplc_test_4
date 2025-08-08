<?php

require 'vendor/autoload.php';

use App\ParserFacade;
use App\Parser\LogParser;
use App\DTO\DataDTO;
use App\Writer\CSVWriter;
// use App\Enums\FreeProductStatus;

// echo FreeProductStatus::Status0;

(new ParserFacade(new LogParser(), new DataDTO, new CSVWriter))
    ->process('./parser_test/', 'log');