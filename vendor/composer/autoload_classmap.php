<?php

// autoload_classmap.php @generated by Composer

$vendorDir = dirname(dirname(__FILE__));
$baseDir = dirname($vendorDir);

return array(
    'Admin' => $baseDir . '/app/models/Admin.php',
    'Algorithm' => $baseDir . '/app/algorithm/Algorithm.php',
    'BaseController' => $baseDir . '/app/controllers/BaseController.php',
    'Clue' => $baseDir . '/app/models/Clue.php',
    'ClueController' => $baseDir . '/app/controllers/ClueController.php',
    'ClueData' => $baseDir . '/app/models/ClueData.php',
    'ClueProgress' => $baseDir . '/app/models/ClueProgress.php',
    'Common' => $baseDir . '/app/models/Common.php',
    'Config' => $baseDir . '/app/models/Config.php',
    'ConfigData' => $baseDir . '/app/models/ConfigData.php',
    'CreateAdminsTable' => $baseDir . '/app/database/migrations/2015_01_03_114814_create_admins_table.php',
    'CreateClueDataTable' => $baseDir . '/app/database/migrations/2015_01_17_092954_create_clue_data_table.php',
    'CreateClueProgressTable' => $baseDir . '/app/database/migrations/2015_01_04_154423_create_clue_progress_table.php',
    'CreateClueTable' => $baseDir . '/app/database/migrations/2015_01_03_150013_create_clue_table.php',
    'CreateConfigTable' => $baseDir . '/app/database/migrations/2015_01_19_155729_create_config_table.php',
    'CreateHistoryTable' => $baseDir . '/app/database/migrations/2015_01_04_235733_create_history_table.php',
    'CreatePrizesTable' => $baseDir . '/app/database/migrations/2015_01_17_141158_create_prizes_table.php',
    'CreateUsersTable' => $baseDir . '/app/database/migrations/2015_01_02_175829_create_users_table.php',
    'DatabaseSeeder' => $baseDir . '/app/database/seeds/DatabaseSeeder.php',
    'Game' => $baseDir . '/app/config/Game.php',
    'History' => $baseDir . '/app/models/Historic.php',
    'HomeController' => $baseDir . '/app/controllers/HomeController.php',
    'IlluminateQueueClosure' => $vendorDir . '/laravel/framework/src/Illuminate/Queue/IlluminateQueueClosure.php',
    'Prize' => $baseDir . '/app/models/Prize.php',
    'SessionHandlerInterface' => $vendorDir . '/symfony/http-foundation/Symfony/Component/HttpFoundation/Resources/stubs/SessionHandlerInterface.php',
    'TestCase' => $baseDir . '/app/tests/TestCase.php',
    'User' => $baseDir . '/app/models/User.php',
    'Whoops\\Module' => $vendorDir . '/filp/whoops/src/deprecated/Zend/Module.php',
    'Whoops\\Provider\\Zend\\ExceptionStrategy' => $vendorDir . '/filp/whoops/src/deprecated/Zend/ExceptionStrategy.php',
    'Whoops\\Provider\\Zend\\RouteNotFoundStrategy' => $vendorDir . '/filp/whoops/src/deprecated/Zend/RouteNotFoundStrategy.php',
    'currentAlgorithm' => $baseDir . '/app/algorithm/currentAlgorithm.php',
    'randomAlgorithm' => $baseDir . '/app/algorithm/randomAlgorithm.php',
);
