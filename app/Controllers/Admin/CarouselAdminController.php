<?php
namespace Kourtis\Controllers\Admin;

use Kourtis\Database\CarouselDB;
use Kourtis\Services\UploadImageService;

class CarouselAdminController extends AdminController
{
    public function __construct($data = null)
    {
        parent::__construct($data);
    }

    public function editCarousel($success=null, $flashMessage=null)
    {
        if ($this->adminIsLoggedIn()) {

            $myDB = new CarouselDB();
            $gallery = $myDB->getCarouselGallery();
            $carouselImages = $myDB->getCarouselImages();

            if (isset($success) && isset($flashMessage)) {
                echo $this->twig->render('carousel/editCarousel.twig', array('gallery' => $gallery, 'carouselImages' => $carouselImages, 'success'=>$success, 'flashMessage'=>$flashMessage));
            } else {
                echo $this->twig->render('carousel/editCarousel.twig', array('gallery' => $gallery, 'carouselImages' => $carouselImages));
            }

        } else {
            echo $this->twig->render('login.twig');
        }
    }

    public function postEditCarousel()
    {
        if ($this->adminIsLoggedIn()) {

            $myDB = new CarouselDB();
            $i = 0;
            $flashMessage = "Carousel Successfully Edited!";
            $success = true;

            if (isset($_GET['included'])) {
                $incl = $_GET['included'];
                foreach ($incl as $includeID) {
                    $i++;
                    echo "ID: " . $includeID . " POSITION: " . $i;
                    $result = $myDB->includeInCarousel($includeID, $i);

                    if ($result == false) {
                        $success = false;
                        $flashMessage = "Error: Something went wrong!";
                        break;
                    }
                }
            }

            if (isset($_GET['notIncluded'])) {
                $notIncl = $_GET['notIncluded'];
                foreach ($notIncl as $notInclID) {
                    echo "Not Included ID: " . $notInclID;
                    $result = $myDB->notIncludeInCarousel($notInclID);

                    if ($result == false) {
                        $success = false;
                        $flashMessage = "Error: Something went wrong!";
                        break;
                    }
                }
            }

            $this->editCarousel($success, $flashMessage);

        } else {
            echo $this->twig->render('login.twig');
        }
    }

    public function uploadCarousel($success=null, $flashMessage=null)
    {
        if ($this->adminIsLoggedIn()) {
            if (isset($success) && isset($flashMessage)) {
                echo $this->twig->render('carousel/uploadCarousel.twig', array('success'=>$success, 'flashMessage'=>$flashMessage));
            } else {
                echo $this->twig->render('carousel/uploadCarousel.twig');
            }
        } else {
            echo $this->twig->render('login.twig');
        }
    }

    public function postUploadCarousel()
    {
        if ($this->adminIsLoggedIn()) {

            $DB = new CarouselDB();
            $uploadDir = 'img/carousel/';
            $uploadImageService = new UploadImageService();
            $success = false;

            //Try to upload image
            $uploadError = $uploadImageService->uploadImage($uploadDir);
            if (empty($uploadError)) {

                //Add row to db
                $nameOfImage = $_FILES['image']['name'];
                $result = $DB->addCarouselImage($_POST, $nameOfImage);

                if (empty($result)) { //successfully added row
                    $flashMessage = "Image Successfully Added!";
                    $success = true;
                } else { //failed to add row
                    $flashMessage = $result;
                    //Delete uploaded image from server
                    unlink($uploadDir . $nameOfImage);
                }

            } else { //image failed to upload
                $flashMessage = $uploadError . "\nError: Could not upload image.";
            }

            $this->uploadCarousel($success, $flashMessage);

        } else {

            echo $this->twig->render('login.twig');

        }
    }

    public function deleteFromCarousel()
    {
        if ($this->adminIsLoggedIn()) {

            $myDB = new CarouselDB();

            if (isset($_GET['ID']) && isset($_GET['path'])) {

                $id = $_GET['ID'];
                $path = $_GET['path'];

                $myDB->deleteFromCarousel($id);

                //deletes the file from the server
                echo unlink(getenv('DOCUMENT_ROOT') . $path);
            }

        } else {
            echo $this->twig->render('login.twig');
        }
    }

}