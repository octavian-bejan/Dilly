<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	require '../app/vendor/autoload.php';
	use Aws\S3\S3Client;

	class Services extends Controller
	{
		public function index($data = "")
		{
			$id = $data;
			$this->view("home/index", array());
		}

		public function newMoment()
		{
			$title = $_POST["title"];
			$date = $_POST["date"];
			$tags = $this->parseTags($_POST["tags"]);

			//max 10 MB
			global $homeUrl;

			if($_FILES["image"]["error"] == 0){
				//a fost incarcat fisierul
				//se incarca pe S3 si se obtine link

				if(!getimagesize($_FILES["image"]["tmp_name"])){
					//eroare de la incarcarea imaginii
				}

				$valid_types = array(IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_BMP);
				$extensions = array("jpeg", "png", "bmp");
				$size = getimagesize($_FILES['image']['tmp_name']);
				$extension = "";
				if(!in_array($size[2], $valid_types))
				{
				    //tipul nu corespunde
				}else
				{
					$extension = $extensions[array_search($size[2], $valid_types)];
				}

				if($_FILES["image"]["size"] > 10485760){
					//fisierul e prea mare
				}

				$acceptabil = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
				$nume = "";
			    $lungime = rand(20, 30);
			    for ($i = 0; $i < $lungime; $i++) {
			        $nume .= $acceptabil[rand(0, strlen($acceptabil) - 1)];
			    }

				if(!move_uploaded_file($_FILES["image"]["tmp_name"], "upload/" . $nume . "." . $extension)){
					//eroare
				}

				//fisierul incarcat cu succes
				$s3Client = new S3Client([
				    'version'     => 'latest',
				    'region'      => 'eu-central-1',
				    'credentials' => [
				        'key'    => 'AKIAISJPPQWLFPKJBF4A',
				        'secret' => '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',
				    ],
				    'http'    => [
				        'verify' => false
				    ]
				]);

				try {
				    $result = $s3Client->putObject([
				        'Bucket' => 'digital.legacy.box',
				        'Key'    => "upload/" . $nume . "." . $extension,
				        'Body'   => fopen("upload/" . $nume . "." . $extension, 'r'),
				        'ACL'    => 'public-read',
				    ]);
					
					echo "<img src=\"" . $result["ObjectURL"] . "\">"; exit();
				} catch (Aws\S3\Exception\S3ClientException $e) {
				    echo "There was an error uploading the file.\n";
				}

			}else
			{
				//nu a fost incarcat un fisier
			}

			//adaugam in baza de date 
		}

		private function parseTags()
        {
            if(isset($_GET['url']))
            {
                return $url = explode('/', filter_var(rtrim($_GET['url'], ','), FILTER_SANITIZE_URL));
            }
        }
	}
?>