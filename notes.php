<?php

header("Content-type: text/plain; Charset=UTF-8");

$password = 'test';

echo $password .' => '. password_hash($password, PASSWORD_BCRYPT);