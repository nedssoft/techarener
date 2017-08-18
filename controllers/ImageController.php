<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/autoloader/Autoloader.php';

/**
* 
*/
class ImageController
{   public $image;
	public $tmp;
	public $file;
	public $dir;
	public $imageKey;
	
	function __construct()
	{
		  	$this->dir=$_SERVER['DOCUMENT_ROOT'].'\uploads';
		  	$this->imageKey = md5(uniqid(rand(), TRUE));
	}
	public function recieveImage()
	{
		if (isset($_POST['image']))
		{
			$this->file = $_FILES['image'];
			$this->tmp = $this->file['tmp_name'];

			if ($this->validate()){

				die($this->validate());
			}
			
			else{
				$this->createImage();
			}

			if ($this->UploadeImage($this->imageKey)){

				
			}

		}
       
	}

	public function validate()
	{   
       $imagError ="";
     $ext =substr(strrchr($this->file['name'], '.'), 1 );
     if ($ext != "jpg") && ($ext != "jpeg") && ($ext != "gif") && ($ext != "jpg") && ($ext != "png") && ($ext != "bmp")
     {
       $imagError = "Unknown extension";
     }
       
       if (!empty($imagError)){
       	return $imagError;
       }
     // if ($this->image['size'] > 2000000)
     // {
     // 	$imagError[]  = "image size is too big";
     // }
	}

	public function createImage()
	{
		list($width, $height, $type, $attr) = getimagesize($this->file['tmp_name']);
            $error = "The file you uploaded is not a supported filetype";
            switch ($type) {
                case IMAGETYPE_GIF:
                    $this->image = imagecreatefromgif($this->file['tmp_name']) or die($error);
                    $ext = '.gif';
                    break;
                case IMAGETYPE_JPEG:
                    $this->image= imagecreatefromjpeg($this->file['tmp_name']) or die($error);
                    $ext = '.jpeg';
                    break;
                case IMAGETYPE_PNG:
                    $this->image = imagecreatefrompng($this->file['tmp_name']) or die($error);
                    $ext = '.png';
                    break;
                default:
                    die($error);
            }
	}


	public function UploadeImage($imageKey)
	{

             if (!imagejpeg($this->image, $this->dir . '/"' . $imageKey. '".jpg')) {
                die('Image upload unsuccessful');
            }
            else{echo "successful";
          }
        }
	}
}