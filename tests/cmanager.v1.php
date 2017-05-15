<?php

/**
 * Class: Configuration manager
 * Version: 1
 */

class ConfigManager {

    var $defFileExt = '.conf.json';
    var $givenFilePath;
    var $defFileContent = array();
    var $debug = false;

    function __construct ($filePath) {

        $this -> givenFilePath = $filePath;

        if ($this -> debug) {

            if (file_exists($filePath . $this -> defFileExt)) {

                unlink($filePath . $this -> defFileExt);

            }

            $configFile = fopen($this -> givenFilePath . $this -> defFileExt, 'a');
            fwrite($configFile, json_encode($this -> defFileContent, JSON_PRETTY_PRINT));
            fclose($configFile);

        } else {

            if (!file_exists($filePath . $this -> defFileExt)) {

                $configFile = fopen($this -> givenFilePath . $this -> defFileExt, 'a');
                fwrite($configFile, json_encode($this -> defFileContent, JSON_PRETTY_PRINT));
                fclose($configFile);

            }

        }

    }

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

    function Set ($key, $value) {

        $decodedConfig = json_decode(file_get_contents($this -> givenFilePath . $this -> defFileExt), true);

        if ($value !== 0) {

            $decodedConfig[$key] = $value;

            $configFile = fopen($this -> givenFilePath . $this -> defFileExt, 'w');
            fwrite($configFile, json_encode($decodedConfig, JSON_PRETTY_PRINT));
            fclose($configFile);

        } else {

            return false;

        }

    }

}
