<?php

header("Content-type: text/html; Charset=UTF-8");
$scan = scandir($dirname = __DIR__ . '/public/assets/images/user');
$finfo = new finfo(FILEINFO_MIME);
foreach ($scan as $element) {
    if (is_file($filename = $dirname . '/' . $element)) {
        $mime = $finfo->file($filename);
        switch ($mime) {
            case 'image/jpeg; charset=binary':$type = 'jpg';
                break;
            case 'image/png; charset=binary':$type = 'png';
                break;
            default:$type = null;
                var_dump($filename, $mime);
                break;
        }

        if (!empty($type)) {
            $data = file_get_contents($filename);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            ?>
                <h2><?= $element ?></h2>
                <img width="20%" src="http://localhost/itso/public/assets/images/user/<?= $element ?>" />
                <img width="20%" src="<?= $base64 ?>" />
                <pre><?= $base64 ?></pre>
                <?php
        }
    }
}

exit;

/*
header("Content-type: application/json; Charset=UTF-8");

$associationsFinales = [];

function stripAccents($str) {
	return strtr($str, ['Š' => 'S', 'š' => 's', 'Đ' => 'Dj', 'đ' => 'dj', 'Ž' => 'Z', 'ž' => 'z', 'Č' => 'C', 'č' => 'c', 'Ć' => 'C', 'ć' => 'c',
		'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'A', 'Ç' => 'C', 'È' => 'E', 'É' => 'E',
		'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O',
		'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ý' => 'Y', 'Þ' => 'B', 'ß' => 'Ss',
		'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'a', 'ç' => 'c', 'è' => 'e', 'é' => 'e',
		'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 'ð' => 'o', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o',
		'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ý' => 'y', 'ý' => 'y', 'þ' => 'b',
		'ÿ' => 'y', 'Ŕ' => 'R', 'ŕ' => 'r']);
}

$data = json_decode(file_get_contents(__DIR__ . '/db/data.json'));
$pictures = json_decode(file_get_contents(__DIR__ . '/db/association_pictures.json'));

$associations = $data->charity_association;

$matches = 0;

foreach ($associations as $ia => $association) {

	$match = false;
	$tests = [];

	$name = stripAccents($association->name);
	$name = str_replace("œ", "oe", $name);
	$name = str_replace("Œ", "OE", $name);
	$name = str_replace("’", "'", $name);
	$name = strtolower($name);
	$name = str_replace(['"', "'", ' ', '-', '–', '!', chr(194) . chr(160), chr(226) . chr(128) . chr(175)], "", $name);

	foreach ($pictures as $ip => $picture) {

		$image = stripAccents($picture->name);
		$image = strstr($image, '.', TRUE);
		$image = strtolower($image);
		$image = str_replace(['-', '_'], "", $image);

		if ($name == $image) {
			$matches++;
			$match = true;
			break;
		} else if (levenshtein($name, $image) <= 2 && strlen($name) > 6 && strlen($image) > 6) {
			$matches++;
			$match = true;
			break;
		} else {
			$tests[] = $name . " == " . $image . " " . levenshtein($name, $image);
		}
	}

	$associationName = $association->name;
	$associationName = str_replace("œ", "oe", $associationName);
	$associationName = str_replace("Œ", "OE", $associationName);
	$associationName = str_replace("’", "'", $associationName);

	$associationName = str_replace(chr(194) . chr(160), ' ', $associationName);
	$associationName = str_replace(chr(226) . chr(128) . chr(175), ' ', $associationName);

	if ($match) {

		$pictureName = $picture->name;
	} else {
		$pictureName = null;
	}

	$associationsFinales[] = ['name' => $associationName, 'picture' => $pictureName];
}

echo json_encode($associationsFinales, JSON_PRETTY_PRINT);
*/