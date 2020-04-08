<?php

ini_set('xdebug.var_display_max_depth', '10');
ini_set('xdebug.var_display_max_children', '256');
ini_set('xdebug.var_display_max_data', '1024');

$schemaName = 'itso';

try {
	$pdo = new PDO('mysql:dbname=information_schema;host=localhost', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
} catch (PDOException $e) {
	die('Connexion échouée : ' . $e->getMessage());
}

//$schema = require __DIR__ . '/schema.php';

$schema = new Schema($schemaName);

require __DIR__ . '/schemaObj.php';


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
				$sql .= " DEFAULT '" . $column->getDefault() . "'";
			}
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

	$tableSql .= ") ENGINE=InnoDB DEFAULT CHARSET=utf8;" . "\n" . "\n" . "\n";

	var_dump($tableSql);
}

/*
DROP TABLE IF EXISTS `customers_favorites`;
CREATE TABLE IF NOT EXISTS `customers_favorites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `favorite_categorie_id` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
 */
