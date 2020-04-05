<?php

namespace Epic\Upload;

use Exception;

/**
 * 
 * https://www.php.net/manual/fr/features.file-upload.post-method.php
 * https://www.php.net/manual/fr/features.file-upload.errors.php
 * 
 */
class FileUploader {

	function upload(File $file, $destination) {
		if ($file->getError() === UPLOAD_ERR_OK) {

			$destinationDir = pathinfo($destination, PATHINFO_DIRNAME);
			if (!is_dir($destinationDir)) {
				mkdir($destinationDir, 0755, true);
			}

			if (move_uploaded_file($file->getTmpName(), $destination)) {
				return true;
			} else {
				throw new Exception("Potential attack");
			}
		} else {
			throw new UploadException($file->getError());
		}
	}

}

class UploadException extends Exception {

	public function __construct($code) {
		$message = $this->codeToMessage($code);
		parent::__construct($message, $code);
	}

	private function codeToMessage($code) {
		switch ($code) {
			case UPLOAD_ERR_INI_SIZE:
				$message = "The uploaded file exceeds the upload_max_filesize directive in php.ini";
				break;
			case UPLOAD_ERR_FORM_SIZE:
				$message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form";
				break;
			case UPLOAD_ERR_PARTIAL:
				$message = "The uploaded file was only partially uploaded";
				break;
			case UPLOAD_ERR_NO_FILE:
				$message = "No file was uploaded";
				break;
			case UPLOAD_ERR_NO_TMP_DIR:
				$message = "Missing a temporary folder";
				break;
			case UPLOAD_ERR_CANT_WRITE:
				$message = "Failed to write file to disk";
				break;
			case UPLOAD_ERR_EXTENSION:
				$message = "File upload stopped by extension";
				break;

			default:
				$message = "Unknown upload error";
				break;
		}
		return $message;
	}

}
