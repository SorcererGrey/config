# Config Version 2.0
### What is it?
Config is a class for use in PHP based projects, this class allows you to easily use JSON to
store information or configurations that can be read and written to with a small amount of code.
### Functions
|Function|Parameters|Description|Returns|
|-----|-----|-----|-----|
|get_doc|N/A|Get the decoded contents of a JSON file|Array of file contents|
|new_doc|N/A|Generate a new empty JSON file with the provided name|True on success|
|set_value|Key, Value, Readable (Uncompressed if true)|Write a value to an existing JSON file|True on success|
|backup|Filename|Backup the current contents of a JSON file|True on success|
### Usage
The class can easily be implemented using the following code
```PHP
<?php

require 'config_v2.php';

// Create a new config object providing the path to the file or where you wish to create a Filename
// and the name of the file
$conf = new Config('/', 'general');

// Create new config file
$conf->new_doc();

// Write to the config file, the depth (This is where the key:value pair are
// located eg {"details": {"name":"Dylan"}} would be a depth of 2), key and value must be provided
$conf->set_value('1', 'forename', 'Dylan');

// Read from the config file, this will give you an array of contents
$conf->get_doc();

// Create backup of the file, this requires the name to give the file containing the backup
// backups will be located in the .backup/ folder created in the provided directory
$conf->backup('bk_21.08.17');

```

### Other information
The folder that will contain or already contains the JSON file you wish to interact with *must already
exist* before you try to interact with it using this class
