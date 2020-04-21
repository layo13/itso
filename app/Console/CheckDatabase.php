<?php

namespace Console;

use Epic\Console\Command;

class CheckDatabase extends Command {

	public function exec() {

		$tables = ['user_type', 'user, picture', 'charity_association', 'brand', 'celebrity_category', 'product_category'];

		foreach ($tables as $table) {
			var_dump($table, $this->pdo->query('SELECT COUNT(*) FROM ' . $table)->fetchColumn());
		}
	}

}
