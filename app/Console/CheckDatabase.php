<?php

namespace Console;

use Epic\Console\Command;

class CheckDatabase extends Command {

	public function exec() {

		$tables = ['user_type', 'user', 'picture', 'charity_association', 'brand', 'celebrity_category', 'product_category'];

		echo '<table border="2" cellpadding="2" cellspacing="2">';
		echo '<tr><th>Table</th><th>Lignes</th></tr>';
		foreach ($tables as $table) {
			echo '<tr><td>' . $table . '</td><td>' . $this->pdo->query('SELECT COUNT(*) FROM ' . $table)->fetchColumn() . '</td></tr>';
		}
		echo '</table>';
	}

}
