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
        $base_dir = getcwd();
        $this->FileUploader->setSaveLocation($base_dir . '/view/upload/');

        $uploadResult = $this->FileUploader->uploadFile($_FILES['fileUpload']);

        echo '<img src=' . $GLOBALS['config']['base_url'] . 'view/upload/' . $_FILES['fileUpload']['name'] . '>';
      }
    }

  }


?>
