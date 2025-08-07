<?php

include_once('./ParserFacade.php');
include_once('./parsers/LogParser.php');
include_once('./dto/DataDTO.php');
include_once('./writers/CSVWriter.php');

(new ParserFacade(new LogParser(), new DataDTO, new CSVWriter))
    ->process('./parser_test/', 'log');