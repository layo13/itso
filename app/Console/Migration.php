<?php

namespace Console;

use Epic\Console\Command;
use Epic\Database\Column;

class Migration extends Command {

	private function getInformationSchema() {
		try {
			return new \PDO('mysql:dbname=information_schema;host=localhost', 'root', '', array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION));
		} catch (PDOException $e) {
			return FALSE;
		}
	}

	public function exec() {

		$pdo = $this->getInformationSchema();

		$schema = require ROOT . "/db/schema.php";

		$pdo->exec("DROP DATABASE IF EXISTS itso;");
		$pdo->exec("CREATE DATABASE itso CHARACTER SET UTF8 collate utf8_general_ci;");
		$pdo->exec("USE itso;");

		/* @var $table \Epic\Database\Table */
		foreach ($schema->getTables() as $table) {

			$columnsSql = array_map(function(Column $column) {

				if ($column->getType() == Column::TYPE_INTEGER) {
					$type = 'int(11)';
				} else if ($column->getType() == Column::TYPE_VARCHAR) {
					$type = 'varchar(' . $column->getLength() . ')';
				} else if ($column->getType() == Column::TYPE_TEXT) {
					$type = 'text';
				} else if ($column->getType() == Column::TYPE_DATETIME) {
					$type = 'datetime';
				} else if ($column->getType() == Column::TYPE_FLOAT) {
					$type = 'float';
				} else if ($column->getType() == Column::TYPE_TINYINTEGER) {
					$type = 'tinyint(4)';
				} else {
					var_dump($column->getType());
					exit;
				}

				if ($column->getPrimary() === true) {
					$sql = "`" . $column->getName() . "` " . $type . " NOT NULL AUTO_INCREMENT";
				} else {
					$sql = "`" . $column->getName() . "` " . $type;

					if ($column->getNullable()) {
						$sql .= " NULL";
					} else {
						$sql .= " NOT NULL";
					}

					if (null !== $column->getDefault()) {
						if ('CURRENT_TIMESTAMP' == $column->getDefault()) {
							$sql .= " DEFAULT " . $column->getDefault() . "";
						} else {
							$sql .= " DEFAULT '" . $column->getDefault() . "'";
						}
					}
				}

				$comment = $column->getComment();
				if (!empty($comment)) {
					$sql .= " COMMENT '" . addslashes($comment). "'";
				}

				// character_set_name
				// collation_name
				// nullable
				// default
				// comment

				return $sql;
			}, $table->getColumns());

			$idName = null;
			foreach ($table->getColumns() as $column) {
				if (true == $column->getPrimary()) {
					$idName = $column->getName();
				}
			}

			if (!empty($idName)) {
				$columnsSql[] = 'PRIMARY KEY (`' . $idName . '`)';
			}

			$tableSql = "DROP TABLE IF EXISTS `" . $table->getName() . "`;" . "\n";
			$tableSql .= "CREATE TABLE IF NOT EXISTS `" . $table->getName() . "` (" . "\n";

			$tableSql .= implode(", \n", $columnsSql) . "\n";

			$tableSql .= ") ENGINE=InnoDB DEFAULT CHARSET=utf8";

			$comment = $table->getComment();
			if (!empty($comment)) {
				$tableSql .= " COMMENT '" . addslashes($comment). "'";
			}

			$tableSql .= ";";

			//var_dump($tableSql);

			$pdo->exec($tableSql);
		}
	}

}
