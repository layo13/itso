<?php

namespace Console;

use Epic\Console\Command;
use Epic\Database\Column;

class Filling extends Command {

	public function exec() {

		$this->dynamic();
		$this->productCategories();
		$this->celebrityCategories();
		$this->charityAssociations();
		$this->brands();
	}

	private function dynamic() {
		$data = json_decode(
			file_get_contents(ROOT . "/db/data.json")
			, TRUE);

		foreach ($data as $table => $entities) {

			foreach ($entities as $entity) {

				$sql = "INSERT INTO " . $table;

				$columns = $tokens = $values = [];

				foreach ($entity as $column => $value) {

					if (is_string($value)) {
                        // $value = utf8_decode($value);
					}

					$tokens[] = '?';
					$columns[] = $column;
					$values[] = $value;
				}

				$sql .= " (" . implode(', ', $columns) . ")";
				$sql .= " VALUES";
				$sql .= " (" . implode(', ', $tokens) . ")";

				$stmt = $this->pdo->prepare($sql);
				$stmt->execute($values);
			}
		}
	}

	private function charityAssociations() {
		$data = json_decode(
			file_get_contents(ROOT . "/db/associations_with_pictures.json")
			, TRUE);

		foreach ($data as $charityAssociation) {

			$pictureId = null;

			if (!empty($charityAssociation['picture'])) {

				$sql = "INSERT INTO picture (name) VALUES (?)";
				$stmt = $this->pdo->prepare($sql);
				$stmt->execute([$charityAssociation['picture']]);

				$pictureId = $this->pdo->lastInsertId();
			}

			$sql = "INSERT INTO charity_association (name, picture_id) VALUES (?, ?)";
			$stmt = $this->pdo->prepare($sql);
			$stmt->execute([$charityAssociation['name'], $pictureId]);
		}
	}

	private function brands() {
		$data = json_decode(
			file_get_contents(ROOT . "/db/brands_with_pictures.json")
			, TRUE);

		foreach ($data as $charityAssociation) {

			$pictureId = null;

			if (!empty($charityAssociation['picture'])) {

				$sql = "INSERT INTO picture (name) VALUES (?)";
				$stmt = $this->pdo->prepare($sql);
				$stmt->execute([$charityAssociation['picture']]);

				$pictureId = $this->pdo->lastInsertId();
			}

			$sql = "INSERT INTO brand (name, picture_id) VALUES (?, ?)";
			$stmt = $this->pdo->prepare($sql);
			$stmt->execute([$charityAssociation['name'], $pictureId]);
		}
	}

	private function celebrityCategories() {
		$data = json_decode(
			file_get_contents(ROOT . "/db/celebrity_categories.json")
			, TRUE);

		foreach ($data as $celebrityCategory) {
			$this->saveCelebrityCategory($celebrityCategory);
		}
	}

	private function saveCelebrityCategory($celebrityCategory, $parentId = null) {

		//$name = utf8_decode($celebrityCategory['name']);
		$name = $celebrityCategory['name'];

		$sql = "INSERT INTO celebrity_category (name, parent_id) VALUES (?, ?)";
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute([$name, $parentId]);

		$id = $this->pdo->lastInsertId();

		if (!empty($celebrityCategory['children'])) {
			foreach ($celebrityCategory['children'] as $child) {
				$this->saveCelebrityCategory($child, $id);
			}
		}
	}

	private function productCategories() {
		$data = json_decode(
			file_get_contents(ROOT . "/db/product_categories.json")
			, TRUE);

		foreach ($data as $productCategory) {
			$this->saveProductCategory($productCategory);
		}
	}

	private function saveProductCategory($productCategory, $parentId = null) {

		//$name = utf8_decode($productCategory['name']);
		$name = $productCategory['name'];
		$sql = "INSERT INTO product_category (name, parent_id) VALUES (?, ?)";
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute([$name, $parentId]);

		$id = $this->pdo->lastInsertId();

		if (!empty($productCategory['children'])) {
			foreach ($productCategory['children'] as $child) {
				$this->saveProductCategory($child, $id);
			}
		}
	}

}
