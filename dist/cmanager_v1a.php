<?php

/**
 * Class: Configuration manager
 * Version: 2.0
 * Note: All folders in path must exist otherwise class will throw error
 */

class ConfigManager {

    // Variables
    var $defFileExt = '.conf.json';
    var $givenFilePath;
    var $defFileContent = array();
    var $debug = false;

    // Class constructor
    function __construct ($filePath) {

        $this -> givenFilePath = $filePath;

        // If debug is enabled ignore file existance check and delete existing file if present
        if ($this -> debug) {

            if (file_exists($filePath . $this -> defFileExt)) {

                unlink($filePath . $this -> defFileExt);

            }

            $configFile = fopen($this -> givenFilePath . $this -> defFileExt, 'a');
            fwrite($configFile, json_encode($this -> defFileContent, JSON_PRETTY_PRINT));
            fclose($configFile);

        } else {

            // Check if file doesnt exist before creating new one
            if (!file_exists($filePath . $this -> defFileExt)) {

                $configFile = fopen($this -> givenFilePath . $this -> defFileExt, 'a');
                fwrite($configFile, json_encode($this -> defFileContent, JSON_PRETTY_PRINT));
                fclose($configFile);

            }

        }

    }

    /**
     * Get the value associated with a provided key
     * @param Int  $depth The depth of the stored value within the config file
     * @param String  $key The key to identify the value
     * @param String $secondKey The second key to identify the value
     * @param String $thirdKey The third key to identify the value
     * @return String The value associated with the key
     */
    function Get ($depth, $key, $secondKey = 0, $thirdKey = 0) {

        $decodedConfig = json_decode(file_get_contents($this -> givenFilePath . $this -> defFileExt), true);

        // Sort through depths and return corrisponding values
        switch ($depth) {

            case 1:

                return $decodedConfig[$key];

                break;
            case 2:

                return $decodedConfig[$key][$secondKey];

                break;
            case 3:

                return $decodedConfig[$key][$secondKey][$thirdKey];

                break;

        }

    }

    /**
     * Set a new value or change an existing value in a config file
     * @param String $key The key to associate with the value
     * @param String $value The value to be associated with the key
     */
    function Set ($key, $value) {

        // Decode json from the file specified
        $decodedConfig = json_decode(file_get_contents($this -> givenFilePath . $this -> defFileExt), true);

        // If the given value isn't empty
        if ($value !== 0) {

            // Create new key:value entry
            $decodedConfig[$key] = $value;

            // Write the the new config back to the specified file
            $configFile = fopen($this -> givenFilePath . $this -> defFileExt, 'w');
            fwrite($configFile, json_encode($decodedConfig, JSON_PRETTY_PRINT));
            fclose($configFile);

        } else {

            return false;

        }

    }

}
