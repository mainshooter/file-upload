<?php
  require_once 'model/Security.class.php';

  class FileUploader {
    private $Security;

    private $allowedFileTypes;
    private $saveLocation;

    public function __construct() {
      $this->Security = new Security();
    }

    public function uploadFile($file) {
      if ($this->checkIfDirectoryExists()) {
        if ($this->checkIfFileTypeIsAllowed($file['type'])) {
          $uploadResult = move_uploaded_file($file['tmp_name'], $this->saveLocation . $file['name']);
          return($uploadResult);
        }

        else {
          // Not allowed file type
          return(false);
        }
      }

      else {
        // Directory doesn't exists
        return(false);
      }
    }

    private function checkIfDirectoryExists() {
      if (file_exists($this->saveLocation) === true) {
        return(true);
      }

      else {
        return(false);
      }
    }

    public function setSaveLocation($location) {
      $this->saveLocation = $this->Security->checkInput($location);
    }

    private function checkIfFileTypeIsAllowed($fileType = false) {
      if ($this->allowedFileTypes === '*') {
        return(true);
      }

      else if (is_array($this->allowedFileTypes)){
        foreach ($this->allowedFileTypes as $fileTypes) {
          if ($fileTypes === $fileTypes) {
            // Same file type
            return(true);
            break;
          }
        }
      }

      else {
        // No other result we stop
        return(false);
      }
    }

    public function setAllowedFileTypes($allowedFileTypes) {
      $this->allowedFileTypes = $allowedFileTypes;
    }

  }
  // application/javascript
  // application/json
  // application/x-www-form-urlencoded
  // application/xml
  // application/zip
  // application/pdf
  // application/sql
  // application/msword (.doc)
  // application/vnd.ms-excel (.xls)
  // application/vnd.openxmlformats-officedocument.spreadsheetml.sheet (.xlsx)
  // application/vnd.ms-powerpoint (.ppt)
  // application/vnd.openxmlformats-officedocument.presentationml.presentation (.pptx)
  // audio/mpeg
  // audio/vorbis
  // multipart/form-data
  // text/css
  // text/html
  // text/csv
  // text/plain
  // image/png
  // image/jpeg
  // image/gif
  // All file types

?>
