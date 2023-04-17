<?php

namespace PropelService\Map;

use PropelService\AdminHistory;
use PropelService\AdminHistoryQuery;
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
 * This class defines the structure of the 'admin_history' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class AdminHistoryTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'PropelService.Map.AdminHistoryTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'admin_history';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'AdminHistory';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\PropelService\\AdminHistory';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'PropelService.AdminHistory';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 7;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 7;

    /**
     * the column name for the int_id field
     */
    public const COL_INT_ID = 'admin_history.int_id';

    /**
     * the column name for the admin_id field
     */
    public const COL_ADMIN_ID = 'admin_history.admin_id';

    /**
     * the column name for the action field
     */
    public const COL_ACTION = 'admin_history.action';

    /**
     * the column name for the session_id field
     */
    public const COL_SESSION_ID = 'admin_history.session_id';

    /**
     * the column name for the affected field
     */
    public const COL_AFFECTED = 'admin_history.affected';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'admin_history.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'admin_history.updated_at';

    /**
     * The default string format for model objects of the related table
     */
    public const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     *
     * @var array<string, mixed>
     */
    protected static $fieldNames = [
        self::TYPE_PHPNAME       => ['IntId', 'AdminId', 'Action', 'SessionId', 'Affected', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['intId', 'adminId', 'action', 'sessionId', 'affected', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [AdminHistoryTableMap::COL_INT_ID, AdminHistoryTableMap::COL_ADMIN_ID, AdminHistoryTableMap::COL_ACTION, AdminHistoryTableMap::COL_SESSION_ID, AdminHistoryTableMap::COL_AFFECTED, AdminHistoryTableMap::COL_CREATED_AT, AdminHistoryTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['int_id', 'admin_id', 'action', 'session_id', 'affected', 'created_at', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, ]
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
        self::TYPE_PHPNAME       => ['IntId' => 0, 'AdminId' => 1, 'Action' => 2, 'SessionId' => 3, 'Affected' => 4, 'CreatedAt' => 5, 'UpdatedAt' => 6, ],
        self::TYPE_CAMELNAME     => ['intId' => 0, 'adminId' => 1, 'action' => 2, 'sessionId' => 3, 'affected' => 4, 'createdAt' => 5, 'updatedAt' => 6, ],
        self::TYPE_COLNAME       => [AdminHistoryTableMap::COL_INT_ID => 0, AdminHistoryTableMap::COL_ADMIN_ID => 1, AdminHistoryTableMap::COL_ACTION => 2, AdminHistoryTableMap::COL_SESSION_ID => 3, AdminHistoryTableMap::COL_AFFECTED => 4, AdminHistoryTableMap::COL_CREATED_AT => 5, AdminHistoryTableMap::COL_UPDATED_AT => 6, ],
        self::TYPE_FIELDNAME     => ['int_id' => 0, 'admin_id' => 1, 'action' => 2, 'session_id' => 3, 'affected' => 4, 'created_at' => 5, 'updated_at' => 6, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IntId' => 'INT_ID',
        'AdminHistory.IntId' => 'INT_ID',
        'intId' => 'INT_ID',
        'adminHistory.intId' => 'INT_ID',
        'AdminHistoryTableMap::COL_INT_ID' => 'INT_ID',
        'COL_INT_ID' => 'INT_ID',
        'int_id' => 'INT_ID',
        'admin_history.int_id' => 'INT_ID',
        'AdminId' => 'ADMIN_ID',
        'AdminHistory.AdminId' => 'ADMIN_ID',
        'adminId' => 'ADMIN_ID',
        'adminHistory.adminId' => 'ADMIN_ID',
        'AdminHistoryTableMap::COL_ADMIN_ID' => 'ADMIN_ID',
        'COL_ADMIN_ID' => 'ADMIN_ID',
        'admin_id' => 'ADMIN_ID',
        'admin_history.admin_id' => 'ADMIN_ID',
        'Action' => 'ACTION',
        'AdminHistory.Action' => 'ACTION',
        'action' => 'ACTION',
        'adminHistory.action' => 'ACTION',
        'AdminHistoryTableMap::COL_ACTION' => 'ACTION',
        'COL_ACTION' => 'ACTION',
        'admin_history.action' => 'ACTION',
        'SessionId' => 'SESSION_ID',
        'AdminHistory.SessionId' => 'SESSION_ID',
        'sessionId' => 'SESSION_ID',
        'adminHistory.sessionId' => 'SESSION_ID',
        'AdminHistoryTableMap::COL_SESSION_ID' => 'SESSION_ID',
        'COL_SESSION_ID' => 'SESSION_ID',
        'session_id' => 'SESSION_ID',
        'admin_history.session_id' => 'SESSION_ID',
        'Affected' => 'AFFECTED',
        'AdminHistory.Affected' => 'AFFECTED',
        'affected' => 'AFFECTED',
        'adminHistory.affected' => 'AFFECTED',
        'AdminHistoryTableMap::COL_AFFECTED' => 'AFFECTED',
        'COL_AFFECTED' => 'AFFECTED',
        'admin_history.affected' => 'AFFECTED',
        'CreatedAt' => 'CREATED_AT',
        'AdminHistory.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'adminHistory.createdAt' => 'CREATED_AT',
        'AdminHistoryTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'admin_history.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'AdminHistory.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'adminHistory.updatedAt' => 'UPDATED_AT',
        'AdminHistoryTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'admin_history.updated_at' => 'UPDATED_AT',
    ];

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
        $this->setName('admin_history');
        $this->setPhpName('AdminHistory');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\PropelService\\AdminHistory');
        $this->setPackage('PropelService');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('int_id', 'IntId', 'INTEGER', true, null, null);
        $this->addForeignKey('admin_id', 'AdminId', 'INTEGER', 'admin', 'int_id', true, null, null);
        $this->addColumn('action', 'Action', 'INTEGER', true, null, null);
        $this->addForeignKey('session_id', 'SessionId', 'INTEGER', 'admin_session', 'int_id', true, null, null);
        $this->addColumn('affected', 'Affected', 'LONGVARCHAR', false, null, null);
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
        $this->addRelation('AdminSession', '\\PropelService\\AdminSession', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':session_id',
    1 => ':int_id',
  ),
), 'CASCADE', null, null, false);
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
        return $withPrefix ? AdminHistoryTableMap::CLASS_DEFAULT : AdminHistoryTableMap::OM_CLASS;
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
     * @return array (AdminHistory object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = AdminHistoryTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = AdminHistoryTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + AdminHistoryTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = AdminHistoryTableMap::OM_CLASS;
            /** @var AdminHistory $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            AdminHistoryTableMap::addInstanceToPool($obj, $key);
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
            $key = AdminHistoryTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = AdminHistoryTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var AdminHistory $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                AdminHistoryTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(AdminHistoryTableMap::COL_INT_ID);
            $criteria->addSelectColumn(AdminHistoryTableMap::COL_ADMIN_ID);
            $criteria->addSelectColumn(AdminHistoryTableMap::COL_ACTION);
            $criteria->addSelectColumn(AdminHistoryTableMap::COL_SESSION_ID);
            $criteria->addSelectColumn(AdminHistoryTableMap::COL_AFFECTED);
            $criteria->addSelectColumn(AdminHistoryTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(AdminHistoryTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.int_id');
            $criteria->addSelectColumn($alias . '.admin_id');
            $criteria->addSelectColumn($alias . '.action');
            $criteria->addSelectColumn($alias . '.session_id');
            $criteria->addSelectColumn($alias . '.affected');
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
            $criteria->removeSelectColumn(AdminHistoryTableMap::COL_INT_ID);
            $criteria->removeSelectColumn(AdminHistoryTableMap::COL_ADMIN_ID);
            $criteria->removeSelectColumn(AdminHistoryTableMap::COL_ACTION);
            $criteria->removeSelectColumn(AdminHistoryTableMap::COL_SESSION_ID);
            $criteria->removeSelectColumn(AdminHistoryTableMap::COL_AFFECTED);
            $criteria->removeSelectColumn(AdminHistoryTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(AdminHistoryTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.int_id');
            $criteria->removeSelectColumn($alias . '.admin_id');
            $criteria->removeSelectColumn($alias . '.action');
            $criteria->removeSelectColumn($alias . '.session_id');
            $criteria->removeSelectColumn($alias . '.affected');
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
        return Propel::getServiceContainer()->getDatabaseMap(AdminHistoryTableMap::DATABASE_NAME)->getTable(AdminHistoryTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a AdminHistory or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or AdminHistory object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(AdminHistoryTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \PropelService\AdminHistory) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(AdminHistoryTableMap::DATABASE_NAME);
            $criteria->add(AdminHistoryTableMap::COL_INT_ID, (array) $values, Criteria::IN);
        }

        $query = AdminHistoryQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            AdminHistoryTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                AdminHistoryTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the admin_history table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return AdminHistoryQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a AdminHistory or Criteria object.
     *
     * @param mixed $criteria Criteria or AdminHistory object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(AdminHistoryTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from AdminHistory object
        }

        if ($criteria->containsKey(AdminHistoryTableMap::COL_INT_ID) && $criteria->keyContainsValue(AdminHistoryTableMap::COL_INT_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.AdminHistoryTableMap::COL_INT_ID.')');
        }


        // Set the correct dbName
        $query = AdminHistoryQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
