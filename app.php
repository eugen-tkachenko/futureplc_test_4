<?php

require 'vendor/autoload.php';

use App\ParserFacade;
use App\Parser\LogParser;
use App\DTO\DataDTO;
use App\Writer\CSVWriter;

(new ParserFacade(new LogParser(), new DataDTO, new CSVWriter))
    ->process('./parser_test/', 'log');