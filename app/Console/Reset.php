<?php

namespace Console;

use Epic\Console\Command;

class Reset extends Command {
    
    const NL = '<br />';
    
	public function exec() {
        
        echo 'Reset de la bdd' . self::NL;

        $migration = new Migration(null);
        $migration->exec();
        
        $pdo = \PdoProvider::getInstance();
        
        echo 'OK' . self::NL;
        // ---------------------------------------------------------------------
        echo 'Remplissage de la bdd avec donnees JSON' . self::NL;
        $filling = new Filling($pdo);
        $filling->exec();
        echo 'OK' . self::NL;
        // ---------------------------------------------------------------------
        echo 'Faking' . self::NL;
        $faker = new Faker($pdo);
        $faker->exec();
        echo 'OK' . self::NL;
        // ---------------------------------------------------------------------
        echo 'to do' . self::NL;
        $buildSelections = new BuildSelections($pdo);
        $buildSelections->exec();
        echo 'OK' . self::NL;
        
	}

}
