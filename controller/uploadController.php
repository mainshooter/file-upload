<?php
  require_once 'model/FileUploader.class.php';


  class uploadController {
    private $FileUploader;

    public function __construct() {
      $this->FileUploader = new FileUploader();
    }

    public function uploadFile() {
      if (ISSET($_POST['upload'])) {
        $this->FileUploader->setAllowedFileTypes('*');
        $this->FileUploader->setSaveLocation('view/upload/');
        echo $this->FileUploader->uploadFile($_FILES['fileUpload']);
      }
    }

  }


?>
