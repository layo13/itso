<?php

namespace Console;

use Epic\Console\Command;
use Epic\Database\Column;

class Filling extends Command {

	public function exec() {
		$data = json_decode(
			file_get_contents(ROOT . "/db/data.json")
			, TRUE);

		foreach ($data as $table => $entities) {

			foreach ($entities as $entity) {

				$sql = "INSERT INTO " . $table;

				$columns = $tokens = $values = [];

				foreach ($entity as $column => $value) {
					$tokens[] = '?';
					$columns[] = $column;
					$values[] = $value;
				}

				$sql.= " (" . implode(', ', $columns) . ")";
				$sql.= " VALUES";
				$sql.= " (" . implode(', ', $tokens) . ")";

				$stmt = $this->pdo->prepare($sql);
				var_dump($stmt->execute($values));
			}
		}
	}

}
