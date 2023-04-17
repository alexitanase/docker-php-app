<?php

namespace PropelService\Map;

use PropelService\Structure;
use PropelService\StructureQuery;
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
 * This class defines the structure of the 'structure' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class StructureTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'PropelService.Map.StructureTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'structure';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'Structure';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\PropelService\\Structure';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'PropelService.Structure';

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
    public const COL_INT_ID = 'structure.int_id';

    /**
     * the column name for the code field
     */
    public const COL_CODE = 'structure.code';

    /**
     * the column name for the name field
     */
    public const COL_NAME = 'structure.name';

    /**
     * the column name for the parent field
     */
    public const COL_PARENT = 'structure.parent';

    /**
     * the column name for the status field
     */
    public const COL_STATUS = 'structure.status';

    /**
     * the column name for the content field
     */
    public const COL_CONTENT = 'structure.content';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'structure.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'structure.updated_at';

    /**
     * The default string format for model objects of the related table
     */
    public const DEFAULT_STRING_FORMAT = 'YAML';

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
        self::TYPE_PHPNAME       => ['IntId', 'Code', 'Name', 'Parent', 'Status', 'Content', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['intId', 'code', 'name', 'parent', 'status', 'content', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [StructureTableMap::COL_INT_ID, StructureTableMap::COL_CODE, StructureTableMap::COL_NAME, StructureTableMap::COL_PARENT, StructureTableMap::COL_STATUS, StructureTableMap::COL_CONTENT, StructureTableMap::COL_CREATED_AT, StructureTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['int_id', 'code', 'name', 'parent', 'status', 'content', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IntId' => 0, 'Code' => 1, 'Name' => 2, 'Parent' => 3, 'Status' => 4, 'Content' => 5, 'CreatedAt' => 6, 'UpdatedAt' => 7, ],
        self::TYPE_CAMELNAME     => ['intId' => 0, 'code' => 1, 'name' => 2, 'parent' => 3, 'status' => 4, 'content' => 5, 'createdAt' => 6, 'updatedAt' => 7, ],
        self::TYPE_COLNAME       => [StructureTableMap::COL_INT_ID => 0, StructureTableMap::COL_CODE => 1, StructureTableMap::COL_NAME => 2, StructureTableMap::COL_PARENT => 3, StructureTableMap::COL_STATUS => 4, StructureTableMap::COL_CONTENT => 5, StructureTableMap::COL_CREATED_AT => 6, StructureTableMap::COL_UPDATED_AT => 7, ],
        self::TYPE_FIELDNAME     => ['int_id' => 0, 'code' => 1, 'name' => 2, 'parent' => 3, 'status' => 4, 'content' => 5, 'created_at' => 6, 'updated_at' => 7, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IntId' => 'INT_ID',
        'Structure.IntId' => 'INT_ID',
        'intId' => 'INT_ID',
        'structure.intId' => 'INT_ID',
        'StructureTableMap::COL_INT_ID' => 'INT_ID',
        'COL_INT_ID' => 'INT_ID',
        'int_id' => 'INT_ID',
        'structure.int_id' => 'INT_ID',
        'Code' => 'CODE',
        'Structure.Code' => 'CODE',
        'code' => 'CODE',
        'structure.code' => 'CODE',
        'StructureTableMap::COL_CODE' => 'CODE',
        'COL_CODE' => 'CODE',
        'Name' => 'NAME',
        'Structure.Name' => 'NAME',
        'name' => 'NAME',
        'structure.name' => 'NAME',
        'StructureTableMap::COL_NAME' => 'NAME',
        'COL_NAME' => 'NAME',
        'Parent' => 'PARENT',
        'Structure.Parent' => 'PARENT',
        'parent' => 'PARENT',
        'structure.parent' => 'PARENT',
        'StructureTableMap::COL_PARENT' => 'PARENT',
        'COL_PARENT' => 'PARENT',
        'Status' => 'STATUS',
        'Structure.Status' => 'STATUS',
        'status' => 'STATUS',
        'structure.status' => 'STATUS',
        'StructureTableMap::COL_STATUS' => 'STATUS',
        'COL_STATUS' => 'STATUS',
        'Content' => 'CONTENT',
        'Structure.Content' => 'CONTENT',
        'content' => 'CONTENT',
        'structure.content' => 'CONTENT',
        'StructureTableMap::COL_CONTENT' => 'CONTENT',
        'COL_CONTENT' => 'CONTENT',
        'CreatedAt' => 'CREATED_AT',
        'Structure.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'structure.createdAt' => 'CREATED_AT',
        'StructureTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'structure.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'Structure.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'structure.updatedAt' => 'UPDATED_AT',
        'StructureTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'structure.updated_at' => 'UPDATED_AT',
    ];

    /**
     * The enumerated values for this table
     *
     * @var array<string, array<string>>
     */
    protected static $enumValueSets = [
                StructureTableMap::COL_STATUS => [
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
        $this->setName('structure');
        $this->setPhpName('Structure');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\PropelService\\Structure');
        $this->setPackage('PropelService');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('int_id', 'IntId', 'INTEGER', true, null, null);
        $this->addColumn('code', 'Code', 'CHAR', true, 40, null);
        $this->addColumn('name', 'Name', 'LONGVARCHAR', true, null, null);
        $this->addColumn('parent', 'Parent', 'CHAR', true, 40, null);
        $this->addColumn('status', 'Status', 'ENUM', true, null, 'ENABLED');
        $this->getColumn('status')->setValueSet(array (
  0 => 'DISABLED',
  1 => 'ENABLED',
));
        $this->addColumn('content', 'Content', 'JSON', false, null, null);
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
        return $withPrefix ? StructureTableMap::CLASS_DEFAULT : StructureTableMap::OM_CLASS;
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
     * @return array (Structure object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = StructureTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = StructureTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + StructureTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = StructureTableMap::OM_CLASS;
            /** @var Structure $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            StructureTableMap::addInstanceToPool($obj, $key);
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
            $key = StructureTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = StructureTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Structure $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                StructureTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(StructureTableMap::COL_INT_ID);
            $criteria->addSelectColumn(StructureTableMap::COL_CODE);
            $criteria->addSelectColumn(StructureTableMap::COL_NAME);
            $criteria->addSelectColumn(StructureTableMap::COL_PARENT);
            $criteria->addSelectColumn(StructureTableMap::COL_STATUS);
            $criteria->addSelectColumn(StructureTableMap::COL_CONTENT);
            $criteria->addSelectColumn(StructureTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(StructureTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.int_id');
            $criteria->addSelectColumn($alias . '.code');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.parent');
            $criteria->addSelectColumn($alias . '.status');
            $criteria->addSelectColumn($alias . '.content');
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
            $criteria->removeSelectColumn(StructureTableMap::COL_INT_ID);
            $criteria->removeSelectColumn(StructureTableMap::COL_CODE);
            $criteria->removeSelectColumn(StructureTableMap::COL_NAME);
            $criteria->removeSelectColumn(StructureTableMap::COL_PARENT);
            $criteria->removeSelectColumn(StructureTableMap::COL_STATUS);
            $criteria->removeSelectColumn(StructureTableMap::COL_CONTENT);
            $criteria->removeSelectColumn(StructureTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(StructureTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.int_id');
            $criteria->removeSelectColumn($alias . '.code');
            $criteria->removeSelectColumn($alias . '.name');
            $criteria->removeSelectColumn($alias . '.parent');
            $criteria->removeSelectColumn($alias . '.status');
            $criteria->removeSelectColumn($alias . '.content');
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
        return Propel::getServiceContainer()->getDatabaseMap(StructureTableMap::DATABASE_NAME)->getTable(StructureTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Structure or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Structure object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(StructureTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \PropelService\Structure) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(StructureTableMap::DATABASE_NAME);
            $criteria->add(StructureTableMap::COL_INT_ID, (array) $values, Criteria::IN);
        }

        $query = StructureQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            StructureTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                StructureTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the structure table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return StructureQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Structure or Criteria object.
     *
     * @param mixed $criteria Criteria or Structure object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(StructureTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Structure object
        }

        if ($criteria->containsKey(StructureTableMap::COL_INT_ID) && $criteria->keyContainsValue(StructureTableMap::COL_INT_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.StructureTableMap::COL_INT_ID.')');
        }


        // Set the correct dbName
        $query = StructureQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
