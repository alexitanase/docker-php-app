<?php

namespace PropelService\Map;

use PropelService\AdminSession;
use PropelService\AdminSessionQuery;
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
 * This class defines the structure of the 'admin_session' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class AdminSessionTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'PropelService.Map.AdminSessionTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'admin_session';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'AdminSession';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\PropelService\\AdminSession';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'PropelService.AdminSession';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 8;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 8;

    /**
     * the column name for the int_id field
     */
    public const COL_INT_ID = 'admin_session.int_id';

    /**
     * the column name for the admin_id field
     */
    public const COL_ADMIN_ID = 'admin_session.admin_id';

    /**
     * the column name for the token field
     */
    public const COL_TOKEN = 'admin_session.token';

    /**
     * the column name for the expire_date field
     */
    public const COL_EXPIRE_DATE = 'admin_session.expire_date';

    /**
     * the column name for the status field
     */
    public const COL_STATUS = 'admin_session.status';

    /**
     * the column name for the ip_address field
     */
    public const COL_IP_ADDRESS = 'admin_session.ip_address';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'admin_session.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'admin_session.updated_at';

    /**
     * The default string format for model objects of the related table
     */
    public const DEFAULT_STRING_FORMAT = 'YAML';

    /** The enumerated values for the status field */
    public const COL_STATUS_VALID = 'VALID';
    public const COL_STATUS_INVALID = 'INVALID';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     *
     * @var array<string, mixed>
     */
    protected static $fieldNames = [
        self::TYPE_PHPNAME       => ['IntId', 'AdminId', 'Token', 'ExpireDate', 'Status', 'IpAddress', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['intId', 'adminId', 'token', 'expireDate', 'status', 'ipAddress', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [AdminSessionTableMap::COL_INT_ID, AdminSessionTableMap::COL_ADMIN_ID, AdminSessionTableMap::COL_TOKEN, AdminSessionTableMap::COL_EXPIRE_DATE, AdminSessionTableMap::COL_STATUS, AdminSessionTableMap::COL_IP_ADDRESS, AdminSessionTableMap::COL_CREATED_AT, AdminSessionTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['int_id', 'admin_id', 'token', 'expire_date', 'status', 'ip_address', 'created_at', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, ]
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
        self::TYPE_PHPNAME       => ['IntId' => 0, 'AdminId' => 1, 'Token' => 2, 'ExpireDate' => 3, 'Status' => 4, 'IpAddress' => 5, 'CreatedAt' => 6, 'UpdatedAt' => 7, ],
        self::TYPE_CAMELNAME     => ['intId' => 0, 'adminId' => 1, 'token' => 2, 'expireDate' => 3, 'status' => 4, 'ipAddress' => 5, 'createdAt' => 6, 'updatedAt' => 7, ],
        self::TYPE_COLNAME       => [AdminSessionTableMap::COL_INT_ID => 0, AdminSessionTableMap::COL_ADMIN_ID => 1, AdminSessionTableMap::COL_TOKEN => 2, AdminSessionTableMap::COL_EXPIRE_DATE => 3, AdminSessionTableMap::COL_STATUS => 4, AdminSessionTableMap::COL_IP_ADDRESS => 5, AdminSessionTableMap::COL_CREATED_AT => 6, AdminSessionTableMap::COL_UPDATED_AT => 7, ],
        self::TYPE_FIELDNAME     => ['int_id' => 0, 'admin_id' => 1, 'token' => 2, 'expire_date' => 3, 'status' => 4, 'ip_address' => 5, 'created_at' => 6, 'updated_at' => 7, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IntId' => 'INT_ID',
        'AdminSession.IntId' => 'INT_ID',
        'intId' => 'INT_ID',
        'adminSession.intId' => 'INT_ID',
        'AdminSessionTableMap::COL_INT_ID' => 'INT_ID',
        'COL_INT_ID' => 'INT_ID',
        'int_id' => 'INT_ID',
        'admin_session.int_id' => 'INT_ID',
        'AdminId' => 'ADMIN_ID',
        'AdminSession.AdminId' => 'ADMIN_ID',
        'adminId' => 'ADMIN_ID',
        'adminSession.adminId' => 'ADMIN_ID',
        'AdminSessionTableMap::COL_ADMIN_ID' => 'ADMIN_ID',
        'COL_ADMIN_ID' => 'ADMIN_ID',
        'admin_id' => 'ADMIN_ID',
        'admin_session.admin_id' => 'ADMIN_ID',
        'Token' => 'TOKEN',
        'AdminSession.Token' => 'TOKEN',
        'token' => 'TOKEN',
        'adminSession.token' => 'TOKEN',
        'AdminSessionTableMap::COL_TOKEN' => 'TOKEN',
        'COL_TOKEN' => 'TOKEN',
        'admin_session.token' => 'TOKEN',
        'ExpireDate' => 'EXPIRE_DATE',
        'AdminSession.ExpireDate' => 'EXPIRE_DATE',
        'expireDate' => 'EXPIRE_DATE',
        'adminSession.expireDate' => 'EXPIRE_DATE',
        'AdminSessionTableMap::COL_EXPIRE_DATE' => 'EXPIRE_DATE',
        'COL_EXPIRE_DATE' => 'EXPIRE_DATE',
        'expire_date' => 'EXPIRE_DATE',
        'admin_session.expire_date' => 'EXPIRE_DATE',
        'Status' => 'STATUS',
        'AdminSession.Status' => 'STATUS',
        'status' => 'STATUS',
        'adminSession.status' => 'STATUS',
        'AdminSessionTableMap::COL_STATUS' => 'STATUS',
        'COL_STATUS' => 'STATUS',
        'admin_session.status' => 'STATUS',
        'IpAddress' => 'IP_ADDRESS',
        'AdminSession.IpAddress' => 'IP_ADDRESS',
        'ipAddress' => 'IP_ADDRESS',
        'adminSession.ipAddress' => 'IP_ADDRESS',
        'AdminSessionTableMap::COL_IP_ADDRESS' => 'IP_ADDRESS',
        'COL_IP_ADDRESS' => 'IP_ADDRESS',
        'ip_address' => 'IP_ADDRESS',
        'admin_session.ip_address' => 'IP_ADDRESS',
        'CreatedAt' => 'CREATED_AT',
        'AdminSession.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'adminSession.createdAt' => 'CREATED_AT',
        'AdminSessionTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'admin_session.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'AdminSession.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'adminSession.updatedAt' => 'UPDATED_AT',
        'AdminSessionTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'admin_session.updated_at' => 'UPDATED_AT',
    ];

    /**
     * The enumerated values for this table
     *
     * @var array<string, array<string>>
     */
    protected static $enumValueSets = [
                AdminSessionTableMap::COL_STATUS => [
                            self::COL_STATUS_VALID,
            self::COL_STATUS_INVALID,
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
        $this->setName('admin_session');
        $this->setPhpName('AdminSession');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\PropelService\\AdminSession');
        $this->setPackage('PropelService');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('int_id', 'IntId', 'INTEGER', true, null, null);
        $this->addForeignKey('admin_id', 'AdminId', 'INTEGER', 'admin', 'int_id', true, null, null);
        $this->addColumn('token', 'Token', 'CHAR', true, 40, null);
        $this->addColumn('expire_date', 'ExpireDate', 'TIMESTAMP', true, null, null);
        $this->addColumn('status', 'Status', 'ENUM', true, null, 'VALID');
        $this->getColumn('status')->setValueSet(array (
  0 => 'VALID',
  1 => 'INVALID',
));
        $this->addColumn('ip_address', 'IpAddress', 'LONGVARCHAR', true, null, null);
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
        $this->addRelation('Admin', '\\PropelService\\Admin', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':admin_id',
    1 => ':int_id',
  ),
), 'CASCADE', null, null, false);
        $this->addRelation('AdminHistory', '\\PropelService\\AdminHistory', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':session_id',
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
     * Method to invalidate the instance pool of all tables related to admin_session     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool(): void
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
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
        return $withPrefix ? AdminSessionTableMap::CLASS_DEFAULT : AdminSessionTableMap::OM_CLASS;
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
     * @return array (AdminSession object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = AdminSessionTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = AdminSessionTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + AdminSessionTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = AdminSessionTableMap::OM_CLASS;
            /** @var AdminSession $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            AdminSessionTableMap::addInstanceToPool($obj, $key);
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
            $key = AdminSessionTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = AdminSessionTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var AdminSession $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                AdminSessionTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(AdminSessionTableMap::COL_INT_ID);
            $criteria->addSelectColumn(AdminSessionTableMap::COL_ADMIN_ID);
            $criteria->addSelectColumn(AdminSessionTableMap::COL_TOKEN);
            $criteria->addSelectColumn(AdminSessionTableMap::COL_EXPIRE_DATE);
            $criteria->addSelectColumn(AdminSessionTableMap::COL_STATUS);
            $criteria->addSelectColumn(AdminSessionTableMap::COL_IP_ADDRESS);
            $criteria->addSelectColumn(AdminSessionTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(AdminSessionTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.int_id');
            $criteria->addSelectColumn($alias . '.admin_id');
            $criteria->addSelectColumn($alias . '.token');
            $criteria->addSelectColumn($alias . '.expire_date');
            $criteria->addSelectColumn($alias . '.status');
            $criteria->addSelectColumn($alias . '.ip_address');
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
            $criteria->removeSelectColumn(AdminSessionTableMap::COL_INT_ID);
            $criteria->removeSelectColumn(AdminSessionTableMap::COL_ADMIN_ID);
            $criteria->removeSelectColumn(AdminSessionTableMap::COL_TOKEN);
            $criteria->removeSelectColumn(AdminSessionTableMap::COL_EXPIRE_DATE);
            $criteria->removeSelectColumn(AdminSessionTableMap::COL_STATUS);
            $criteria->removeSelectColumn(AdminSessionTableMap::COL_IP_ADDRESS);
            $criteria->removeSelectColumn(AdminSessionTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(AdminSessionTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.int_id');
            $criteria->removeSelectColumn($alias . '.admin_id');
            $criteria->removeSelectColumn($alias . '.token');
            $criteria->removeSelectColumn($alias . '.expire_date');
            $criteria->removeSelectColumn($alias . '.status');
            $criteria->removeSelectColumn($alias . '.ip_address');
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
        return Propel::getServiceContainer()->getDatabaseMap(AdminSessionTableMap::DATABASE_NAME)->getTable(AdminSessionTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a AdminSession or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or AdminSession object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(AdminSessionTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \PropelService\AdminSession) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(AdminSessionTableMap::DATABASE_NAME);
            $criteria->add(AdminSessionTableMap::COL_INT_ID, (array) $values, Criteria::IN);
        }

        $query = AdminSessionQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            AdminSessionTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                AdminSessionTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the admin_session table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return AdminSessionQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a AdminSession or Criteria object.
     *
     * @param mixed $criteria Criteria or AdminSession object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(AdminSessionTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from AdminSession object
        }

        if ($criteria->containsKey(AdminSessionTableMap::COL_INT_ID) && $criteria->keyContainsValue(AdminSessionTableMap::COL_INT_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.AdminSessionTableMap::COL_INT_ID.')');
        }


        // Set the correct dbName
        $query = AdminSessionQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
