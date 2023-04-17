<?php
$serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
$serviceContainer->initDatabaseMapFromDumps(array (
  'default' => 
  array (
    'tablesByName' => 
    array (
      'admin' => '\\PropelService\\Map\\AdminTableMap',
      'admin_history' => '\\PropelService\\Map\\AdminHistoryTableMap',
      'admin_session' => '\\PropelService\\Map\\AdminSessionTableMap',
      'partner' => '\\PropelService\\Map\\PartnerTableMap',
      'structure' => '\\PropelService\\Map\\StructureTableMap',
    ),
    'tablesByPhpName' => 
    array (
      '\\Admin' => '\\PropelService\\Map\\AdminTableMap',
      '\\AdminHistory' => '\\PropelService\\Map\\AdminHistoryTableMap',
      '\\AdminSession' => '\\PropelService\\Map\\AdminSessionTableMap',
      '\\Partner' => '\\PropelService\\Map\\PartnerTableMap',
      '\\Structure' => '\\PropelService\\Map\\StructureTableMap',
    ),
  ),
));
