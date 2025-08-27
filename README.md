## Task

Parse the data from the log files in the ```./parser_test/``` folder into ```.csv``` files with proper reformatting.

## Usage

For security reasons the content of the ```./parser_test/``` folder is omitted from the repository, please move your ```.log``` files there manually.

To run:

```php app.php```

## Details:

The parser implements the Facade pattern.

This allows to separate parsing, validation and reading between ```LogParser```, ```DataDTO``` and ```CSVWriter``` classes.

In turn, those three classes implement ```Parser```, ```DTO``` and ```Writer``` interfaces, correspondingly.

Such architecture allows one to simply extend the module to read from any other source (**DB, RSS-feed, REST (JSON) and SOAP (XML) API, WebSockets, files of various formats, etc.**), write into any other destinations, and change the way the data is processed in between with a DTO.


For simplicity, the ```.csv``` files are created in the same folders the ```.log``` files are located.