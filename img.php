<?php

class Image {

	const PORTRAIT = 'portrait';
	const LANDSCAPE = 'landscape';
	const SQUARE = 'square';

	/**
	 *
	 * @var resource Ressource 
	 */
	private $resource;

	private function __construct($resource) {
		$this->resource = $resource;
	}

	public static function create() {
		//return new Image($resource);
	}

	public static function createFromBmp() {
		
	}

	public static function createFromGif() {
		
	}

	/**
	 * 
	 * @param type $filename
	 * @return \Image
	 */
	public static function createFromJpeg($filename) {
		return new Image(imagecreatefromjpeg($filename));
	}

	public static function createFromPng() {
		
	}

	public static function createFromString() {
		
	}

	public static function createFromWebp() {
		
	}

	public function getWidth() {
		return imagesx($this->resource);
	}

	public function getHeight() {
		return imagesy($this->resource);
	}

	public function toJpeg($filename = null) {
		if (empty($filename)) {
			ob_start();
			imagejpeg($this->resource);
			return ob_get_clean();
		} else {
			return imagejpeg($this->resource, $filename);
		}
	}

	public function isRectangular() {
		return $this->getWidth() != $this->getHeight();
	}

	public function isSquare() {
		return $this->getWidth() == $this->getHeight();
	}

	public function getOrientation() {
		if ($this->getWidth() < $this->getHeight()) {
			return self::PORTRAIT;
		} else if ($this->getWidth() > $this->getHeight()) {
			return self::LANDSCAPE;
		} else {
			return self::SQUARE;
		}
	}

	public function setRatio($ratioWidth, $ratioHeight) {
		if ($ratioWidth < $ratioHeight) {
			$ratioOrientation = self::PORTRAIT;
		} else if ($ratioWidth > $ratioHeight) {
			$ratioOrientation = self::LANDSCAPE;
		} else {
			$ratioOrientation = self::SQUARE;
		}

		$orientation = $this->getOrientation();

		if ($orientation == self::SQUARE && $ratioOrientation == self::LANDSCAPE) {
			$newwidth = $this->getWidth();
			$newheight = intval($ratioHeight * $this->getHeight() / $ratioWidth);
			$landscape = imagecreatetruecolor($newwidth, $newheight);
			imagecopyresampled($landscape, $this->resource, 0, 0, 0, ($this->getHeight() - $newheight) / 2, $newwidth, $newheight, $newwidth, $newheight);
			return new Image($landscape);
		} else if ($orientation == self::PORTRAIT && $ratioOrientation == self::LANDSCAPE) {
			$newwidth = $this->getWidth();
			$newheight = intval($ratioHeight * $this->getHeight() / $ratioWidth);
			$landscape = imagecreatetruecolor($newwidth, $newheight);
			imagecopyresampled($landscape, $this->resource, 0, 0, 0, ($this->getHeight() - $newheight) / 2, $newwidth, $newheight, $newwidth, $newheight);
			return new Image($landscape);
		} else if ($orientation == self::PORTRAIT && $ratioOrientation == self::SQUARE) {
			$newwidth = $newheight = $this->getWidth();
			$square = imagecreatetruecolor($newwidth, $newheight);
			imagecopyresampled($square, $this->resource, 0, 0, 0, ($this->getHeight() - $newheight) / 2, $newwidth, $newheight, $newwidth, $newheight);
			return new Image($square);
		} else if ($orientation == self::LANDSCAPE && $ratioOrientation == self::SQUARE) {
			$newwidth = $newheight = $this->getHeight();
			$square = imagecreatetruecolor($newwidth, $newheight);
			imagecopyresampled($square, $this->resource, 0, 0, ($this->getWidth() - $newwidth) / 2, 0, $newwidth, $newheight, $newwidth, $newheight);
			return new Image($square);
		} else if ($orientation == self::LANDSCAPE && $ratioOrientation == self::PORTRAIT) {
			$newwidth = intval($ratioWidth * $this->getWidth() / $ratioHeight);
			$newheight = $this->getHeight();
			$portrait = imagecreatetruecolor($newwidth, $newheight);
			imagecopyresampled($portrait, $this->resource, 0, 0, ($this->getWidth() - $newwidth) / 2, 0, $newwidth, $newheight, $newwidth, $newheight);
			return new Image($portrait);
		} else if ($orientation == self::SQUARE && $ratioOrientation == self::PORTRAIT) {
			$newwidth = intval($ratioWidth * $this->getWidth() / $ratioHeight);
			$newheight = $this->getHeight();
			$portrait = imagecreatetruecolor($newwidth, $newheight);
			imagecopyresampled($portrait, $this->resource, 0, 0, ($this->getWidth() - $newwidth) / 2, 0, $newwidth, $newheight, $newwidth, $newheight);
			return new Image($portrait);
		} else if ($orientation == self::LANDSCAPE && $ratioOrientation == self::LANDSCAPE) {
			/*var_dump("DE PAYSAGE A PAYSAGE");
			$ratioTarget = $ratioWidth / $ratioHeight;
			var_dump($ratioTarget, $this->getWidth() / $this->getHeight());*/

			if (($ratioWidth / $ratioHeight) < ($this->getWidth() / $this->getHeight())) {
				var_dump("IL FAUT CONSERVER LA HAUTEUR ET REDUIRE LA LARGEUR");
				exit;
				$newwidth = $ratioHeight * $this->getWidth() / $ratioWidth;
				$newheight = $this->getHeight();
				$portrait = imagecreatetruecolor($newwidth, $newheight);
				imagecopyresampled($portrait, $this->resource, 0, 0, ($this->getWidth() - $newwidth) / 2, 0, $newwidth, $newheight, $newwidth, $newheight);
				return new Image($portrait);
			} else {
				var_dump("IL FAUT CONSERVER LA LARGEUR ET REDUIRE LA HAUTEUR");
				$newwidth = $this->getWidth();
				$newheight = $ratioHeight * $this->getWidth() / $ratioWidth;
				var_dump([
					'$newwidth' => $newwidth,
					'$newheight' => $newheight
				]);
				$portrait = imagecreatetruecolor($newwidth, $newheight);
				imagecopyresampled($portrait, $this->resource, 0, 0, 0, ($this->getHeight() - $newheight) / 2, $newwidth, $newheight, $newwidth, $newheight);
				return new Image($portrait);
			}
		} else if ($orientation == self::PORTRAIT && $ratioOrientation == self::PORTRAIT) {
			var_dump("DE PORTRAIT A PORTRAIT");

			if (($ratioWidth / $ratioHeight) > ($this->getWidth() / $this->getHeight())) {
				var_dump("IL FAUT CONSERVER LA HAUTEUR ET REDUIRE LA LARGEUR");
				$newwidth = $ratioHeight * $this->getWidth() / $ratioWidth;
				$newheight = $this->getHeight();
				$portrait = imagecreatetruecolor($newwidth, $newheight);
				imagecopyresampled($portrait, $this->resource, 0, 0, ($this->getWidth() - $newwidth) / 2, 0, $newwidth, $newheight, $newwidth, $newheight);
				return new Image($portrait);
			} else {
				var_dump("IL FAUT CONSERVER LA LARGEUR ET REDUIRE LA HAUTEUR");
				$newwidth = $this->getWidth();
				$newheight = $ratioWidth * $this->getHeight() / $ratioHeight;
				$portrait = imagecreatetruecolor($newwidth, $newheight);
				imagecopyresampled($portrait, $this->resource, 0, 0, 0, ($this->getHeight() - $newheight) / 2, $newwidth, $newheight, $newwidth, $newheight);
				return new Image($portrait);
			}
		} else {
			return clone $this;
		}
	}

	public function toSquare() {
		$width = $this->getWidth();
		$height = $this->getHeight();

		if ($width < $height) {
			$delta = $height - $width;
			$newwidth = $newheight = $width;
			$orientation = self::PORTRAIT;
		} else {
			$delta = $width - $height;
			$newwidth = $newheight = $height;
			$orientation = self::LANDSCAPE;
		}

		$square = imagecreatetruecolor($newwidth, $newheight);

		/*
		 * Liste de paramètres :
		 * dst_image	Ressource cible de l'image.
		 * src_image	Ressource source de l'image.
		 * dst_x		X : coordonnées du point de destination.
		 * dst_y		Y : coordonnées du point de destination.
		 * src_x		X : coordonnées du point source.
		 * src_y		Y : coordonnées du point source.
		 * dst_w		Largeur de la destination.
		 * dst_h		Hauteur de la destination.
		 * src_w		Largeur de la source.
		 * src_h		Hauteur de la source.
		 */
		if ($orientation == self::LANDSCAPE) {
			imagecopyresampled($square, $this->resource, 0, 0, $delta / 2, 0, $newwidth, $newheight, $newwidth, $newheight);
		} else {
			imagecopyresampled($square, $this->resource, 0, 0, 0, $delta / 2, $newwidth, $newheight, $newwidth, $newheight);
		}

		return new Image($square);
	}

	public function resize($newwidth, $newheight) {
		$resized = imagecreatetruecolor($newwidth, $newheight);
		imagecopyresampled($resized, $this->resource, 0, 0, 0, 0, $newwidth, $newheight, $this->getWidth(), $this->getHeight());
		return new Image($resized);
	}

}

$image = Image::createFromJpeg(__DIR__ . '/IMG_8099.JPG');

$imageRatio = $image->setRatio(1920, 1080);

$filename = __DIR__ . '/IMG_8099_BIS.JPG';

if (is_file($filename)) unlink ($filename);

$imageSize = $imageRatio->resize(1920, 1080);

$imageSize->toJpeg($filename);

//echo '<img src="data:image/jpeg;base64, ' . base64_encode($imageRatio->toJpeg()) . '" class="img-responsive" />';

exit;

header("Content-type: text/html; Charset=UTF-8");

$filenames = [
	//realpath(__DIR__ . '/images/thor.jpg'),
	realpath(__DIR__ . '/images/thorrectv2.jpg'),
	//realpath(__DIR__ . '/images/thorrecth.jpg'),
];
?><!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bootstrap 101 Template</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
			<?php
			foreach ($filenames as $filename) {

				$image = Image::createFromJpeg($filename);
				$images = ['original' => $image];
				$images['1/2'] = $image->setRatio(1, 2);
				$images['2/3'] = $image->setRatio(2, 3);
				//$images['4/3'] = $image->setRatio(4, 3);
				//$images['16/9'] = $image->setRatio(16, 9);
				//$images['1/1'] = $image->setRatio(1, 1);
				$images = array_filter($images);
				?><div class="row"><?php
				foreach ($images as $ratio => $i) {
					echo '<div class="col-md-4">';
					echo '<h2>' . $ratio . '</h2>';
					echo '<img src="data:image/jpeg;base64, ' . base64_encode($i->toJpeg()) . '" class="img-responsive" />';
					echo '</div>';
				}
				?></div><?php
					continue;
					?>

				<?php
				$images = [];
				$class = 'col-md-12';
				$image = Image::createFromJpeg($filename);
				$images[] = $image;
				if ($image->isRectangular()) {
					$class = 'col-md-6';
					$imageSquare = $image->toSquare();
					$images[] = $imageSquare;
					if ($imageSquare->getWidth() > 500) {
						$class = 'col-md-4';
						$imageResized = $imageSquare->resize(200, 200);
						$images[] = $imageResized;
					}
				}
				foreach ($images as $i) {
					echo '<div class="' . $class . '">';
					echo '<img src="data:image/jpeg;base64, ' . base64_encode($i->toJpeg()) . '" class="img-responsive" />';
					echo '</div>';
				}
				?>
			</div>
			<hr />
		<?php } ?>
	</div>

	<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
</body>
</html>