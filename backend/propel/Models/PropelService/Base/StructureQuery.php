<?php

namespace PropelService\Base;

use \Exception;
use \PDO;
use PropelService\Structure as ChildStructure;
use PropelService\StructureQuery as ChildStructureQuery;
use PropelService\Map\StructureTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the `structure` table.
 *
 * @method     ChildStructureQuery orderByIntId($order = Criteria::ASC) Order by the int_id column
 * @method     ChildStructureQuery orderByCode($order = Criteria::ASC) Order by the code column
 * @method     ChildStructureQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildStructureQuery orderByParent($order = Criteria::ASC) Order by the parent column
 * @method     ChildStructureQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildStructureQuery orderByContent($order = Criteria::ASC) Order by the content column
 * @method     ChildStructureQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildStructureQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildStructureQuery groupByIntId() Group by the int_id column
 * @method     ChildStructureQuery groupByCode() Group by the code column
 * @method     ChildStructureQuery groupByName() Group by the name column
 * @method     ChildStructureQuery groupByParent() Group by the parent column
 * @method     ChildStructureQuery groupByStatus() Group by the status column
 * @method     ChildStructureQuery groupByContent() Group by the content column
 * @method     ChildStructureQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildStructureQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildStructureQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildStructureQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildStructureQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildStructureQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildStructureQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildStructureQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildStructure|null findOne(?ConnectionInterface $con = null) Return the first ChildStructure matching the query
 * @method     ChildStructure findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildStructure matching the query, or a new ChildStructure object populated from the query conditions when no match is found
 *
 * @method     ChildStructure|null findOneByIntId(int $int_id) Return the first ChildStructure filtered by the int_id column
 * @method     ChildStructure|null findOneByCode(string $code) Return the first ChildStructure filtered by the code column
 * @method     ChildStructure|null findOneByName(string $name) Return the first ChildStructure filtered by the name column
 * @method     ChildStructure|null findOneByParent(string $parent) Return the first ChildStructure filtered by the parent column
 * @method     ChildStructure|null findOneByStatus(int $status) Return the first ChildStructure filtered by the status column
 * @method     ChildStructure|null findOneByContent(string $content) Return the first ChildStructure filtered by the content column
 * @method     ChildStructure|null findOneByCreatedAt(string $created_at) Return the first ChildStructure filtered by the created_at column
 * @method     ChildStructure|null findOneByUpdatedAt(string $updated_at) Return the first ChildStructure filtered by the updated_at column
 *
 * @method     ChildStructure requirePk($key, ?ConnectionInterface $con = null) Return the ChildStructure by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStructure requireOne(?ConnectionInterface $con = null) Return the first ChildStructure matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildStructure requireOneByIntId(int $int_id) Return the first ChildStructure filtered by the int_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStructure requireOneByCode(string $code) Return the first ChildStructure filtered by the code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStructure requireOneByName(string $name) Return the first ChildStructure filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStructure requireOneByParent(string $parent) Return the first ChildStructure filtered by the parent column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStructure requireOneByStatus(int $status) Return the first ChildStructure filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStructure requireOneByContent(string $content) Return the first ChildStructure filtered by the content column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStructure requireOneByCreatedAt(string $created_at) Return the first ChildStructure filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStructure requireOneByUpdatedAt(string $updated_at) Return the first ChildStructure filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildStructure[]|Collection find(?ConnectionInterface $con = null) Return ChildStructure objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildStructure> find(?ConnectionInterface $con = null) Return ChildStructure objects based on current ModelCriteria
 *
 * @method     ChildStructure[]|Collection findByIntId(int|array<int> $int_id) Return ChildStructure objects filtered by the int_id column
 * @psalm-method Collection&\Traversable<ChildStructure> findByIntId(int|array<int> $int_id) Return ChildStructure objects filtered by the int_id column
 * @method     ChildStructure[]|Collection findByCode(string|array<string> $code) Return ChildStructure objects filtered by the code column
 * @psalm-method Collection&\Traversable<ChildStructure> findByCode(string|array<string> $code) Return ChildStructure objects filtered by the code column
 * @method     ChildStructure[]|Collection findByName(string|array<string> $name) Return ChildStructure objects filtered by the name column
 * @psalm-method Collection&\Traversable<ChildStructure> findByName(string|array<string> $name) Return ChildStructure objects filtered by the name column
 * @method     ChildStructure[]|Collection findByParent(string|array<string> $parent) Return ChildStructure objects filtered by the parent column
 * @psalm-method Collection&\Traversable<ChildStructure> findByParent(string|array<string> $parent) Return ChildStructure objects filtered by the parent column
 * @method     ChildStructure[]|Collection findByStatus(int|array<int> $status) Return ChildStructure objects filtered by the status column
 * @psalm-method Collection&\Traversable<ChildStructure> findByStatus(int|array<int> $status) Return ChildStructure objects filtered by the status column
 * @method     ChildStructure[]|Collection findByContent(string|array<string> $content) Return ChildStructure objects filtered by the content column
 * @psalm-method Collection&\Traversable<ChildStructure> findByContent(string|array<string> $content) Return ChildStructure objects filtered by the content column
 * @method     ChildStructure[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildStructure objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildStructure> findByCreatedAt(string|array<string> $created_at) Return ChildStructure objects filtered by the created_at column
 * @method     ChildStructure[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildStructure objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildStructure> findByUpdatedAt(string|array<string> $updated_at) Return ChildStructure objects filtered by the updated_at column
 *
 * @method     ChildStructure[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildStructure> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class StructureQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \PropelService\Base\StructureQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\PropelService\\Structure', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildStructureQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildStructureQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildStructureQuery) {
            return $criteria;
        }
        $query = new ChildStructureQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildStructure|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(StructureTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = StructureTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildStructure A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `int_id`, `code`, `name`, `parent`, `status`, `content`, `created_at`, `updated_at` FROM `structure` WHERE `int_id` = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildStructure $obj */
            $obj = new ChildStructure();
            $obj->hydrate($row);
            StructureTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con A connection object
     *
     * @return ChildStructure|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param array $keys Primary keys to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return Collection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param mixed $key Primary key to use for the query
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        $this->addUsingAlias(StructureTableMap::COL_INT_ID, $key, Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param array|int $keys The list of primary key to use for the query
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        $this->addUsingAlias(StructureTableMap::COL_INT_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the int_id column
     *
     * Example usage:
     * <code>
     * $query->filterByIntId(1234); // WHERE int_id = 1234
     * $query->filterByIntId(array(12, 34)); // WHERE int_id IN (12, 34)
     * $query->filterByIntId(array('min' => 12)); // WHERE int_id > 12
     * </code>
     *
     * @param mixed $intId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIntId($intId = null, ?string $comparison = null)
    {
        if (is_array($intId)) {
            $useMinMax = false;
            if (isset($intId['min'])) {
                $this->addUsingAlias(StructureTableMap::COL_INT_ID, $intId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($intId['max'])) {
                $this->addUsingAlias(StructureTableMap::COL_INT_ID, $intId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StructureTableMap::COL_INT_ID, $intId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the code column
     *
     * Example usage:
     * <code>
     * $query->filterByCode('fooValue');   // WHERE code = 'fooValue'
     * $query->filterByCode('%fooValue%', Criteria::LIKE); // WHERE code LIKE '%fooValue%'
     * $query->filterByCode(['foo', 'bar']); // WHERE code IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $code The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCode($code = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($code)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StructureTableMap::COL_CODE, $code, $comparison);

        return $this;
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%', Criteria::LIKE); // WHERE name LIKE '%fooValue%'
     * $query->filterByName(['foo', 'bar']); // WHERE name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $name The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByName($name = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StructureTableMap::COL_NAME, $name, $comparison);

        return $this;
    }

    /**
     * Filter the query on the parent column
     *
     * Example usage:
     * <code>
     * $query->filterByParent('fooValue');   // WHERE parent = 'fooValue'
     * $query->filterByParent('%fooValue%', Criteria::LIKE); // WHERE parent LIKE '%fooValue%'
     * $query->filterByParent(['foo', 'bar']); // WHERE parent IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $parent The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByParent($parent = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($parent)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StructureTableMap::COL_PARENT, $parent, $comparison);

        return $this;
    }

    /**
     * Filter the query on the status column
     *
     * @param mixed $status The value to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStatus($status = null, ?string $comparison = null)
    {
        $valueSet = StructureTableMap::getValueSet(StructureTableMap::COL_STATUS);
        if (is_scalar($status)) {
            if (!in_array($status, $valueSet)) {
                throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $status));
            }
            $status = array_search($status, $valueSet);
        } elseif (is_array($status)) {
            $convertedValues = [];
            foreach ($status as $value) {
                if (!in_array($value, $valueSet)) {
                    throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $value));
                }
                $convertedValues []= array_search($value, $valueSet);
            }
            $status = $convertedValues;
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StructureTableMap::COL_STATUS, $status, $comparison);

        return $this;
    }

    /**
     * Filter the query on the content column
     *
     * Example usage:
     * <code>
     * $query->filterByContent('fooValue');   // WHERE content = 'fooValue'
     * $query->filterByContent('%fooValue%', Criteria::LIKE); // WHERE content LIKE '%fooValue%'
     * $query->filterByContent(['foo', 'bar']); // WHERE content IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $content The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByContent($content = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($content)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StructureTableMap::COL_CONTENT, $content, $comparison);

        return $this;
    }

    /**
     * Filter the query on the created_at column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatedAt('2011-03-14'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt('now'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt(array('max' => 'yesterday')); // WHERE created_at > '2011-03-13'
     * </code>
     *
     * @param mixed $createdAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, ?string $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(StructureTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(StructureTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StructureTableMap::COL_CREATED_AT, $createdAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the updated_at column
     *
     * Example usage:
     * <code>
     * $query->filterByUpdatedAt('2011-03-14'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt('now'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt(array('max' => 'yesterday')); // WHERE updated_at > '2011-03-13'
     * </code>
     *
     * @param mixed $updatedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, ?string $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(StructureTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(StructureTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StructureTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildStructure $structure Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($structure = null)
    {
        if ($structure) {
            $this->addUsingAlias(StructureTableMap::COL_INT_ID, $structure->getIntId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the structure table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(StructureTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            StructureTableMap::clearInstancePool();
            StructureTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(StructureTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(StructureTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            StructureTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            StructureTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param int $nbDays Maximum age of the latest update in days
     *
     * @return $this The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        $this->addUsingAlias(StructureTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by update date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        $this->addDescendingOrderByColumn(StructureTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by update date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        $this->addAscendingOrderByColumn(StructureTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by create date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        $this->addDescendingOrderByColumn(StructureTableMap::COL_CREATED_AT);

        return $this;
    }

    /**
     * Filter by the latest created
     *
     * @param int $nbDays Maximum age of in days
     *
     * @return $this The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        $this->addUsingAlias(StructureTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by create date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        $this->addAscendingOrderByColumn(StructureTableMap::COL_CREATED_AT);

        return $this;
    }

}
