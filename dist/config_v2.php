<?php

class Config {

    public $config = array(
        "ext" => ".json",
        "joint_path" => "",
        "path_ready" => false,
        "backup_folder" => ".backup/",
        "path" => 0
    );

    /**
     * Class constructor
     * @param String $path The path to the config file to be used including a / at the
     * end and the file name
     */
    function __construct ($path, $file) {

        // Check if path is given
        if (isset($path) && isset($file)) {

            $this->config['path'] = $path;

            // Combine path and file name into complete file path
            $this->config['joint_path'] = $path . $file . $this->config['ext'];

            $this->config['path_ready'] = true;

        } else {

            // Return error
            return false;

        }

    }

    /**
     * Get the contents of a .json config file
     * @return Array Contents of file
     */
    function get_doc () {

        // Check if joint path is set
        if ($this->config['path_ready']) {

            // Get contents of config file
            $arr_contents = json_decode(file_get_contents($this->config['joint_path']), true);

            // Return array of contents
            return $arr_contents;

        }

    }

    /**
     * Create a new configuration document
     * @return [type]      [description]
     */
    function new_doc () {

        // Check if joint path is set
        if ($this->config['path_ready']) {

            // Create new config file with empty brackets
            $newconf = fopen($this->config['joint_path'], 'a');
            fwrite($newconf, '{}');
            fclose($newconf);
            return true;

        } else {

            return false;

        }

    }

    function set_value ($depth = 1,$key, $value, $key_2 = 0, $key_3 = 0, $key_4 = 0) {

        // Check if joint path is set
        if ($this->config['path_ready']) {

            // If the given value isn't empty
            if (isset($value)) {

                // Get contents of config file
                $arr_contents = json_decode(file_get_contents($this->config['joint_path']), true);

                if ($depth > 1) {

                    switch ($depth) {

                        case 2:
                            // Create new key:value entry
                            $arr_contents[$key][$key_2] = $value;
                            break;
                        case 3:
                            // Create new key:value entry
                            $arr_contents[$key][$key_2][$key_3] = $value;
                            break;
                        case 4:
                            // Create new key:value entry
                            $arr_contents[$key][$key_2][$key_3][$key_4] = $value;
                            break;

                    }

                } else {
                    $arr_contents[$key] = $value;
                }

                // Write the the new config back to the specified file
                $new_content = fopen($this->config['joint_path'], 'w');
                fwrite($new_content, json_encode($arr_contents, JSON_PRETTY_PRINT));
                fclose($new_content);
                return true;

            } else {

                return false;

            }

        } else {

            return false;

        }

    }

    function backup ($filename) {

        // Check if joint path is set
        if ($this->config['path'] !== 0) {

            // Get contents of config file
            $arr_contents = json_decode(file_get_contents($this->config['joint_path']), true);

            if (!file_exists($this->config['path'] . $this->config['backup_folder'])) {
                mkdir($this->config['path'] . $this->config['backup_folder']);
            }

            // Create new .backup file
            $new_content = fopen($this->config['path'] . $this->config['backup_folder'] . $filename . '.backup', 'w');

            // Place new contents in file
            fwrite($new_content, json_encode($arr_contents));
            fclose($new_content);
            return true;

        } else {

            return false;

        }

    }

}
