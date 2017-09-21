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
        $uploadResult = move_uploaded_file($file['tmp_name'], $this->saveLocation . $file['name']);
        return($uploadResult);
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

    private function checkIfFileTypeIsAllowed() {
      if ($this->allowedFileTypes === '*') {
        return(true);
      }

      else {
        return(false);
      }
    }

    public function setAllowedFileTypes($allowedFileTypes) {
      $this->allowedFileTypes = $allowedFileTypes;
    }

  }


?>
