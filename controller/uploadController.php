<?php
  require_once 'model/FileUploader.class.php';


  class uploadController {
    private $FileUploader;

    public function __construct() {
      $this->FileUploader = new FileUploader();
    }

    public function uploadFile() {
      if (ISSET($_POST['upload'])) {
        $allowedTypes = array(
          "image/png",
          "image/jpeg",
          "image/gif"
        );
        $this->FileUploader->setAllowedFileTypes($allowedTypes);
        $base_dir = getcwd();
        $this->FileUploader->setSaveLocation($base_dir . '/view/upload/');

        if ($this->FileUploader->checkIfFileExists($_FILES['fileUpload']['name']) === false) {
          $uploadResult = $this->FileUploader->uploadFile($_FILES['fileUpload']);
          if ($uploadResult === true) {
            include 'view/header.php';
              include 'view/image.php';
            include 'view/footer.php';
          }
        }

        else {
          include 'view/header.php';
          echo "<h1>Bestand bestaat al!</h1>";
            include 'view/image-error.php';
          include 'view/footer.php';
        }
      }

      else {
        // client came here by excident
        header('Location: '. $GLOBALS['config']['base_url']);
      }
    }

  }


?>
