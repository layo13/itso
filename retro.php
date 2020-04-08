<?php

function cleanNumericIndexes(array $array) {
	$result = [];
	foreach ($array as $key => $value) {
		if (!is_numeric($key)) {
			$result[$key] = $value;
		}
	}
	return $result;
}

//------------------------------------------------------------------------------

$schema = 'itso';

try {
	$pdo = new PDO('mysql:dbname=information_schema;host=localhost', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
} catch (PDOException $e) {
	die('Connexion échouée : ' . $e->getMessage());
}

$dump = [
	'name' => $schema,
	'tables' => array()
];

$tables = $pdo->query("SELECT * FROM `TABLES` WHERE TABLE_SCHEMA LIKE '$schema'")->fetchAll();
$tables = array_map('cleanNumericIndexes', $tables);

foreach ($tables as $table) {


	$columns = $pdo->query("SELECT * FROM `COLUMNS` WHERE TABLE_SCHEMA LIKE '$schema' AND TABLE_NAME LIKE '" . $table['TABLE_NAME'] . "'")->fetchAll();
	$columns = array_map('cleanNumericIndexes', $columns);

	$dumpTable = [
		'name' => $table['TABLE_NAME'],
		'columns' => [
		]
	];

	foreach ($columns as $column) {
		/* var_dump(
		  'COLUMN_NAME => ' . $column['COLUMN_NAME'] . "\n" .
		  'ORDINAL_POSITION => ' . $column['ORDINAL_POSITION'] . "\n" .
		  'COLUMN_DEFAULT => ' . $column['COLUMN_DEFAULT'] . "\n" .
		  'IS_NULLABLE => ' . $column['IS_NULLABLE'] . "\n" .
		  'DATA_TYPE => ' . $column['DATA_TYPE'] . "\n" .
		  'CHARACTER_MAXIMUM_LENGTH => ' . $column['CHARACTER_MAXIMUM_LENGTH'] . "\n" .
		  'CHARACTER_OCTET_LENGTH => ' . $column['CHARACTER_OCTET_LENGTH'] . "\n" .
		  'NUMERIC_PRECISION => ' . $column['NUMERIC_PRECISION'] . "\n" .
		  'NUMERIC_SCALE => ' . $column['NUMERIC_SCALE'] . "\n" .
		  'DATETIME_PRECISION => ' . $column['DATETIME_PRECISION'] . "\n" .
		  'CHARACTER_SET_NAME => ' . $column['CHARACTER_SET_NAME'] . "\n" .
		  'COLLATION_NAME => ' . $column['COLLATION_NAME'] . "\n" .
		  'COLUMN_TYPE => ' . $column['COLUMN_TYPE'] . "\n" .
		  'COLUMN_KEY => ' . $column['COLUMN_KEY'] . "\n" .
		  'EXTRA => ' . $column['EXTRA'] . "\n" .
		  'COLUMN_COMMENT => ' . $column['COLUMN_COMMENT']
		  ); */

		$dumpColumn = [
			'name' => $column['COLUMN_NAME']
		];

		if ($column['DATA_TYPE'] == 'text') {
			$dumpColumn['type'] = $column['DATA_TYPE'];
			$dumpColumn['character_set_name'] = $column['CHARACTER_SET_NAME'];
			$dumpColumn['collation_name'] = $column['COLLATION_NAME'];
		} else if ($column['DATA_TYPE'] == 'datetime') {
			$dumpColumn['type'] = $column['DATA_TYPE'];
		} else if ($column['DATA_TYPE'] == 'int') {
			$dumpColumn['type'] = $column['DATA_TYPE'];
		} else if ($column['DATA_TYPE'] == 'varchar') {
			$dumpColumn['type'] = $column['DATA_TYPE'];
			$dumpColumn['length'] = $column['CHARACTER_MAXIMUM_LENGTH'];
			$dumpColumn['character_set_name'] = $column['CHARACTER_SET_NAME'];
			$dumpColumn['collation_name'] = $column['COLLATION_NAME'];
		} else {
			var_dump($column);
			exit;
		}

		if ($column['IS_NULLABLE'] == 'YES') {
			$dumpColumn['nullable'] = true;
		} else if ($column['IS_NULLABLE'] == 'NO') {
			$dumpColumn['nullable'] = false;
		}

		if (!is_null($column['COLUMN_DEFAULT'])) {
			$dumpColumn['default'] = $column['COLUMN_DEFAULT'];
		}

		if (!empty($column['COLUMN_COMMENT'])) {
			$dumpColumn['comment'] = $column['COLUMN_COMMENT'];
		}

		if ($column['COLUMN_KEY'] == 'PRI' && $column['EXTRA'] == 'auto_increment') {
			$dumpColumn['primary'] = true;
		} else if (empty($column['COLUMN_KEY']) && empty($column['EXTRA'])) {
			
		} else {
			var_dump($column);
			exit;
		}

		$dumpTable['columns'][] = $dumpColumn;
	}

	$dumpTable['engine'] = $table['ENGINE'];
	$dumpTable['collation'] = $table['TABLE_COLLATION'];
	if (!empty($table['TABLE_COMMENT'])) {
		$dumpTable['comment'] = $table['TABLE_COMMENT'];
	}
	$dump['tables'][] = $dumpTable;
}

var_export($dump);
