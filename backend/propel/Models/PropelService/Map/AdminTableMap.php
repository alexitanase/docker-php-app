<?php

namespace PropelService\Map;

use PropelService\Admin;
use PropelService\AdminQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'admin' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class AdminTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'PropelService.Map.AdminTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'admin';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'Admin';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\PropelService\\Admin';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'PropelService.Admin';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 12;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 12;

    /**
     * the column name for the int_id field
     */
    public const COL_INT_ID = 'admin.int_id';

    /**
     * the column name for the fullname field
     */
    public const COL_FULLNAME = 'admin.fullname';

    /**
     * the column name for the phonenumber field
     */
    public const COL_PHONENUMBER = 'admin.phonenumber';

    /**
     * the column name for the email field
     */
    public const COL_EMAIL = 'admin.email';

    /**
     * the column name for the passwd field
     */
    public const COL_PASSWD = 'admin.passwd';

    /**
     * the column name for the type field
     */
    public const COL_TYPE = 'admin.type';

    /**
     * the column name for the structure field
     */
    public const COL_STRUCTURE = 'admin.structure';

    /**
     * the column name for the status field
     */
    public const COL_STATUS = 'admin.status';

    /**
     * the column name for the last_address field
     */
    public const COL_LAST_ADDRESS = 'admin.last_address';

    /**
     * the column name for the callmebot_apikey field
     */
    public const COL_CALLMEBOT_APIKEY = 'admin.callmebot_apikey';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'admin.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'admin.updated_at';

    /**
     * The default string format for model objects of the related table
     */
    public const DEFAULT_STRING_FORMAT = 'YAML';

    /** The enumerated values for the type field */
    public const COL_TYPE_UNSET = 'UNSET';
    public const COL_TYPE_OWNER = 'OWNER';
    public const COL_TYPE_PARTNER = 'PARTNER';

    /** The enumerated values for the status field */
    public const COL_STATUS_DISABLED = 'DISABLED';
    public const COL_STATUS_ENABLED = 'ENABLED';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     *
     * @var array<string, mixed>
     */
    protected static $fieldNames = [
        self::TYPE_PHPNAME       => ['IntId', 'Fullname', 'Phonenumber', 'Email', 'Passwd', 'Type', 'Structure', 'Status', 'LastAddress', 'CallMeBotApiKey', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['intId', 'fullname', 'phonenumber', 'email', 'passwd', 'type', 'structure', 'status', 'lastAddress', 'callMeBotApiKey', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [AdminTableMap::COL_INT_ID, AdminTableMap::COL_FULLNAME, AdminTableMap::COL_PHONENUMBER, AdminTableMap::COL_EMAIL, AdminTableMap::COL_PASSWD, AdminTableMap::COL_TYPE, AdminTableMap::COL_STRUCTURE, AdminTableMap::COL_STATUS, AdminTableMap::COL_LAST_ADDRESS, AdminTableMap::COL_CALLMEBOT_APIKEY, AdminTableMap::COL_CREATED_AT, AdminTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['int_id', 'fullname', 'phonenumber', 'email', 'passwd', 'type', 'structure', 'status', 'last_address', 'callmebot_apikey', 'created_at', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, ]
    ];

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     *
     * @var array<string, mixed>
     */
    protected static $fieldKeys = [
        self::TYPE_PHPNAME       => ['IntId' => 0, 'Fullname' => 1, 'Phonenumber' => 2, 'Email' => 3, 'Passwd' => 4, 'Type' => 5, 'Structure' => 6, 'Status' => 7, 'LastAddress' => 8, 'CallMeBotApiKey' => 9, 'CreatedAt' => 10, 'UpdatedAt' => 11, ],
        self::TYPE_CAMELNAME     => ['intId' => 0, 'fullname' => 1, 'phonenumber' => 2, 'email' => 3, 'passwd' => 4, 'type' => 5, 'structure' => 6, 'status' => 7, 'lastAddress' => 8, 'callMeBotApiKey' => 9, 'createdAt' => 10, 'updatedAt' => 11, ],
        self::TYPE_COLNAME       => [AdminTableMap::COL_INT_ID => 0, AdminTableMap::COL_FULLNAME => 1, AdminTableMap::COL_PHONENUMBER => 2, AdminTableMap::COL_EMAIL => 3, AdminTableMap::COL_PASSWD => 4, AdminTableMap::COL_TYPE => 5, AdminTableMap::COL_STRUCTURE => 6, AdminTableMap::COL_STATUS => 7, AdminTableMap::COL_LAST_ADDRESS => 8, AdminTableMap::COL_CALLMEBOT_APIKEY => 9, AdminTableMap::COL_CREATED_AT => 10, AdminTableMap::COL_UPDATED_AT => 11, ],
        self::TYPE_FIELDNAME     => ['int_id' => 0, 'fullname' => 1, 'phonenumber' => 2, 'email' => 3, 'passwd' => 4, 'type' => 5, 'structure' => 6, 'status' => 7, 'last_address' => 8, 'callmebot_apikey' => 9, 'created_at' => 10, 'updated_at' => 11, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IntId' => 'INT_ID',
        'Admin.IntId' => 'INT_ID',
        'intId' => 'INT_ID',
        'admin.intId' => 'INT_ID',
        'AdminTableMap::COL_INT_ID' => 'INT_ID',
        'COL_INT_ID' => 'INT_ID',
        'int_id' => 'INT_ID',
        'admin.int_id' => 'INT_ID',
        'Fullname' => 'FULLNAME',
        'Admin.Fullname' => 'FULLNAME',
        'fullname' => 'FULLNAME',
        'admin.fullname' => 'FULLNAME',
        'AdminTableMap::COL_FULLNAME' => 'FULLNAME',
        'COL_FULLNAME' => 'FULLNAME',
        'Phonenumber' => 'PHONENUMBER',
        'Admin.Phonenumber' => 'PHONENUMBER',
        'phonenumber' => 'PHONENUMBER',
        'admin.phonenumber' => 'PHONENUMBER',
        'AdminTableMap::COL_PHONENUMBER' => 'PHONENUMBER',
        'COL_PHONENUMBER' => 'PHONENUMBER',
        'Email' => 'EMAIL',
        'Admin.Email' => 'EMAIL',
        'email' => 'EMAIL',
        'admin.email' => 'EMAIL',
        'AdminTableMap::COL_EMAIL' => 'EMAIL',
        'COL_EMAIL' => 'EMAIL',
        'Passwd' => 'PASSWD',
        'Admin.Passwd' => 'PASSWD',
        'passwd' => 'PASSWD',
        'admin.passwd' => 'PASSWD',
        'AdminTableMap::COL_PASSWD' => 'PASSWD',
        'COL_PASSWD' => 'PASSWD',
        'Type' => 'TYPE',
        'Admin.Type' => 'TYPE',
        'type' => 'TYPE',
        'admin.type' => 'TYPE',
        'AdminTableMap::COL_TYPE' => 'TYPE',
        'COL_TYPE' => 'TYPE',
        'Structure' => 'STRUCTURE',
        'Admin.Structure' => 'STRUCTURE',
        'structure' => 'STRUCTURE',
        'admin.structure' => 'STRUCTURE',
        'AdminTableMap::COL_STRUCTURE' => 'STRUCTURE',
        'COL_STRUCTURE' => 'STRUCTURE',
        'Status' => 'STATUS',
        'Admin.Status' => 'STATUS',
        'status' => 'STATUS',
        'admin.status' => 'STATUS',
        'AdminTableMap::COL_STATUS' => 'STATUS',
        'COL_STATUS' => 'STATUS',
        'LastAddress' => 'LAST_ADDRESS',
        'Admin.LastAddress' => 'LAST_ADDRESS',
        'lastAddress' => 'LAST_ADDRESS',
        'admin.lastAddress' => 'LAST_ADDRESS',
        'AdminTableMap::COL_LAST_ADDRESS' => 'LAST_ADDRESS',
        'COL_LAST_ADDRESS' => 'LAST_ADDRESS',
        'last_address' => 'LAST_ADDRESS',
        'admin.last_address' => 'LAST_ADDRESS',
        'CallMeBotApiKey' => 'CALLMEBOT_APIKEY',
        'Admin.CallMeBotApiKey' => 'CALLMEBOT_APIKEY',
        'callMeBotApiKey' => 'CALLMEBOT_APIKEY',
        'admin.callMeBotApiKey' => 'CALLMEBOT_APIKEY',
        'AdminTableMap::COL_CALLMEBOT_APIKEY' => 'CALLMEBOT_APIKEY',
        'COL_CALLMEBOT_APIKEY' => 'CALLMEBOT_APIKEY',
        'callmebot_apikey' => 'CALLMEBOT_APIKEY',
        'admin.callmebot_apikey' => 'CALLMEBOT_APIKEY',
        'CreatedAt' => 'CREATED_AT',
        'Admin.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'admin.createdAt' => 'CREATED_AT',
        'AdminTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'admin.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'Admin.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'admin.updatedAt' => 'UPDATED_AT',
        'AdminTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'admin.updated_at' => 'UPDATED_AT',
    ];

    /**
     * The enumerated values for this table
     *
     * @var array<string, array<string>>
     */
    protected static $enumValueSets = [
                AdminTableMap::COL_TYPE => [
                            self::COL_TYPE_UNSET,
            self::COL_TYPE_OWNER,
            self::COL_TYPE_PARTNER,
        ],
                AdminTableMap::COL_STATUS => [
                            self::COL_STATUS_DISABLED,
            self::COL_STATUS_ENABLED,
        ],
    ];

    /**
     * Gets the list of values for all ENUM and SET columns
     * @return array
     */
    public static function getValueSets(): array
    {
      return static::$enumValueSets;
    }

    /**
     * Gets the list of values for an ENUM or SET column
     * @param string $colname
     * @return array list of possible values for the column
     */
    public static function getValueSet(string $colname): array
    {
        $valueSets = self::getValueSets();

        return $valueSets[$colname];
    }

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function initialize(): void
    {
        // attributes
        $this->setName('admin');
        $this->setPhpName('Admin');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\PropelService\\Admin');
        $this->setPackage('PropelService');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('int_id', 'IntId', 'INTEGER', true, null, null);
        $this->addColumn('fullname', 'Fullname', 'LONGVARCHAR', false, null, null);
        $this->addColumn('phonenumber', 'Phonenumber', 'LONGVARCHAR', false, null, null);
        $this->addColumn('email', 'Email', 'LONGVARCHAR', true, null, null);
        $this->addColumn('passwd', 'Passwd', 'LONGVARCHAR', true, null, null);
        $this->addColumn('type', 'Type', 'ENUM', true, null, 'OWNER');
        $this->getColumn('type')->setValueSet(array (
  0 => 'UNSET',
  1 => 'OWNER',
  2 => 'PARTNER',
));
        $this->addColumn('structure', 'Structure', 'LONGVARCHAR', false, null, null);
        $this->addColumn('status', 'Status', 'ENUM', true, null, 'ENABLED');
        $this->getColumn('status')->setValueSet(array (
  0 => 'DISABLED',
  1 => 'ENABLED',
));
        $this->addColumn('last_address', 'LastAddress', 'LONGVARCHAR', true, null, null);
        $this->addColumn('callmebot_apikey', 'CallMeBotApiKey', 'LONGVARCHAR', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('AdminSession', '\\PropelService\\AdminSession', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':admin_id',
    1 => ':int_id',
  ),
), 'CASCADE', null, 'AdminSessions', false);
        $this->addRelation('AdminHistory', '\\PropelService\\AdminHistory', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':admin_id',
    1 => ':int_id',
  ),
), 'CASCADE', null, 'AdminHistories', false);
    }

    /**
     *
     * Gets the list of behaviors registered for this table
     *
     * @return array<string, array> Associative array (name => parameters) of behaviors
     */
    public function getBehaviors(): array
    {
        return [
            'timestampable' => ['create_column' => 'created_at', 'update_column' => 'updated_at', 'disable_created_at' => 'false', 'disable_updated_at' => 'false'],
        ];
    }

    /**
     * Method to invalidate the instance pool of all tables related to admin     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool(): void
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        AdminSessionTableMap::clearInstancePool();
        AdminHistoryTableMap::clearInstancePool();
    }

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array $row Resultset row.
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string|null The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): ?string
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IntId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IntId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IntId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IntId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IntId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IntId', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array $row Resultset row.
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('IntId', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param bool $withPrefix Whether to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass(bool $withPrefix = true): string
    {
        return $withPrefix ? AdminTableMap::CLASS_DEFAULT : AdminTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array $row Row returned by DataFetcher->fetch().
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array (Admin object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = AdminTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = AdminTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + AdminTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = AdminTableMap::OM_CLASS;
            /** @var Admin $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            AdminTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array<object>
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher): array
    {
        $results = [];

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = AdminTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = AdminTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Admin $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                AdminTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria Object containing the columns to add.
     * @param string|null $alias Optional table alias
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return void
     */
    public static function addSelectColumns(Criteria $criteria, ?string $alias = null): void
    {
        if (null === $alias) {
            $criteria->addSelectColumn(AdminTableMap::COL_INT_ID);
            $criteria->addSelectColumn(AdminTableMap::COL_FULLNAME);
            $criteria->addSelectColumn(AdminTableMap::COL_PHONENUMBER);
            $criteria->addSelectColumn(AdminTableMap::COL_EMAIL);
            $criteria->addSelectColumn(AdminTableMap::COL_PASSWD);
            $criteria->addSelectColumn(AdminTableMap::COL_TYPE);
            $criteria->addSelectColumn(AdminTableMap::COL_STRUCTURE);
            $criteria->addSelectColumn(AdminTableMap::COL_STATUS);
            $criteria->addSelectColumn(AdminTableMap::COL_LAST_ADDRESS);
            $criteria->addSelectColumn(AdminTableMap::COL_CALLMEBOT_APIKEY);
            $criteria->addSelectColumn(AdminTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(AdminTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.int_id');
            $criteria->addSelectColumn($alias . '.fullname');
            $criteria->addSelectColumn($alias . '.phonenumber');
            $criteria->addSelectColumn($alias . '.email');
            $criteria->addSelectColumn($alias . '.passwd');
            $criteria->addSelectColumn($alias . '.type');
            $criteria->addSelectColumn($alias . '.structure');
            $criteria->addSelectColumn($alias . '.status');
            $criteria->addSelectColumn($alias . '.last_address');
            $criteria->addSelectColumn($alias . '.callmebot_apikey');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
        }
    }

    /**
     * Remove all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be removed as they are only loaded on demand.
     *
     * @param Criteria $criteria Object containing the columns to remove.
     * @param string|null $alias Optional table alias
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return void
     */
    public static function removeSelectColumns(Criteria $criteria, ?string $alias = null): void
    {
        if (null === $alias) {
            $criteria->removeSelectColumn(AdminTableMap::COL_INT_ID);
            $criteria->removeSelectColumn(AdminTableMap::COL_FULLNAME);
            $criteria->removeSelectColumn(AdminTableMap::COL_PHONENUMBER);
            $criteria->removeSelectColumn(AdminTableMap::COL_EMAIL);
            $criteria->removeSelectColumn(AdminTableMap::COL_PASSWD);
            $criteria->removeSelectColumn(AdminTableMap::COL_TYPE);
            $criteria->removeSelectColumn(AdminTableMap::COL_STRUCTURE);
            $criteria->removeSelectColumn(AdminTableMap::COL_STATUS);
            $criteria->removeSelectColumn(AdminTableMap::COL_LAST_ADDRESS);
            $criteria->removeSelectColumn(AdminTableMap::COL_CALLMEBOT_APIKEY);
            $criteria->removeSelectColumn(AdminTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(AdminTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.int_id');
            $criteria->removeSelectColumn($alias . '.fullname');
            $criteria->removeSelectColumn($alias . '.phonenumber');
            $criteria->removeSelectColumn($alias . '.email');
            $criteria->removeSelectColumn($alias . '.passwd');
            $criteria->removeSelectColumn($alias . '.type');
            $criteria->removeSelectColumn($alias . '.structure');
            $criteria->removeSelectColumn($alias . '.status');
            $criteria->removeSelectColumn($alias . '.last_address');
            $criteria->removeSelectColumn($alias . '.callmebot_apikey');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap(): TableMap
    {
        return Propel::getServiceContainer()->getDatabaseMap(AdminTableMap::DATABASE_NAME)->getTable(AdminTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Admin or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Admin object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ?ConnectionInterface $con = null): int
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(AdminTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \PropelService\Admin) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(AdminTableMap::DATABASE_NAME);
            $criteria->add(AdminTableMap::COL_INT_ID, (array) $values, Criteria::IN);
        }

        $query = AdminQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            AdminTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                AdminTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the admin table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return AdminQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Admin or Criteria object.
     *
     * @param mixed $criteria Criteria or Admin object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(AdminTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Admin object
        }

        if ($criteria->containsKey(AdminTableMap::COL_INT_ID) && $criteria->keyContainsValue(AdminTableMap::COL_INT_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.AdminTableMap::COL_INT_ID.')');
        }


        // Set the correct dbName
        $query = AdminQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
