# Configuration Manager
A PHP class for managing .json configuration files of multiple depths, file created using the class are created with the .conf.json extention and files can be created then managed anywhere specified

### Class usage
You can use this class by using the following code and calling one of the two functions provided.
```PHP
<?php

// Create a new ConfigManager object
$config = ConfigManager('config');

// Set new key config entry
$config -> set('key', 'value');

// Get value of key config entry
$config -> get('key');
```

### Functions
#### Get
The Get function retrieves the value of a config value from the file specified.</br>
Arguments:
- Depth > This is the depth of the value you want within the config file in use e.g
{"key": "value"} is a depth of 1
- Key > The key of the value to retrieve
- Second key > The child key when the parent key is specified
- Third Key > The child key when the two parent keys are specified

#### Set
The set function places a new key:value entry into the config file, see above for usage example.</br>
To add multiple depths of values give a multi level array for the second argument
