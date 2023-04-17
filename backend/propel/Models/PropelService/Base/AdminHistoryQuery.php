<?php

namespace PropelService\Base;

use \Exception;
use \PDO;
use PropelService\AdminHistory as ChildAdminHistory;
use PropelService\AdminHistoryQuery as ChildAdminHistoryQuery;
use PropelService\Map\AdminHistoryTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the `admin_history` table.
 *
 * @method     ChildAdminHistoryQuery orderByIntId($order = Criteria::ASC) Order by the int_id column
 * @method     ChildAdminHistoryQuery orderByAdminId($order = Criteria::ASC) Order by the admin_id column
 * @method     ChildAdminHistoryQuery orderByAction($order = Criteria::ASC) Order by the action column
 * @method     ChildAdminHistoryQuery orderBySessionId($order = Criteria::ASC) Order by the session_id column
 * @method     ChildAdminHistoryQuery orderByAffected($order = Criteria::ASC) Order by the affected column
 * @method     ChildAdminHistoryQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildAdminHistoryQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildAdminHistoryQuery groupByIntId() Group by the int_id column
 * @method     ChildAdminHistoryQuery groupByAdminId() Group by the admin_id column
 * @method     ChildAdminHistoryQuery groupByAction() Group by the action column
 * @method     ChildAdminHistoryQuery groupBySessionId() Group by the session_id column
 * @method     ChildAdminHistoryQuery groupByAffected() Group by the affected column
 * @method     ChildAdminHistoryQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildAdminHistoryQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildAdminHistoryQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildAdminHistoryQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildAdminHistoryQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildAdminHistoryQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildAdminHistoryQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildAdminHistoryQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildAdminHistoryQuery leftJoinAdmin($relationAlias = null) Adds a LEFT JOIN clause to the query using the Admin relation
 * @method     ChildAdminHistoryQuery rightJoinAdmin($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Admin relation
 * @method     ChildAdminHistoryQuery innerJoinAdmin($relationAlias = null) Adds a INNER JOIN clause to the query using the Admin relation
 *
 * @method     ChildAdminHistoryQuery joinWithAdmin($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Admin relation
 *
 * @method     ChildAdminHistoryQuery leftJoinWithAdmin() Adds a LEFT JOIN clause and with to the query using the Admin relation
 * @method     ChildAdminHistoryQuery rightJoinWithAdmin() Adds a RIGHT JOIN clause and with to the query using the Admin relation
 * @method     ChildAdminHistoryQuery innerJoinWithAdmin() Adds a INNER JOIN clause and with to the query using the Admin relation
 *
 * @method     ChildAdminHistoryQuery leftJoinAdminSession($relationAlias = null) Adds a LEFT JOIN clause to the query using the AdminSession relation
 * @method     ChildAdminHistoryQuery rightJoinAdminSession($relationAlias = null) Adds a RIGHT JOIN clause to the query using the AdminSession relation
 * @method     ChildAdminHistoryQuery innerJoinAdminSession($relationAlias = null) Adds a INNER JOIN clause to the query using the AdminSession relation
 *
 * @method     ChildAdminHistoryQuery joinWithAdminSession($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the AdminSession relation
 *
 * @method     ChildAdminHistoryQuery leftJoinWithAdminSession() Adds a LEFT JOIN clause and with to the query using the AdminSession relation
 * @method     ChildAdminHistoryQuery rightJoinWithAdminSession() Adds a RIGHT JOIN clause and with to the query using the AdminSession relation
 * @method     ChildAdminHistoryQuery innerJoinWithAdminSession() Adds a INNER JOIN clause and with to the query using the AdminSession relation
 *
 * @method     \PropelService\AdminQuery|\PropelService\AdminSessionQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildAdminHistory|null findOne(?ConnectionInterface $con = null) Return the first ChildAdminHistory matching the query
 * @method     ChildAdminHistory findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildAdminHistory matching the query, or a new ChildAdminHistory object populated from the query conditions when no match is found
 *
 * @method     ChildAdminHistory|null findOneByIntId(int $int_id) Return the first ChildAdminHistory filtered by the int_id column
 * @method     ChildAdminHistory|null findOneByAdminId(int $admin_id) Return the first ChildAdminHistory filtered by the admin_id column
 * @method     ChildAdminHistory|null findOneByAction(int $action) Return the first ChildAdminHistory filtered by the action column
 * @method     ChildAdminHistory|null findOneBySessionId(int $session_id) Return the first ChildAdminHistory filtered by the session_id column
 * @method     ChildAdminHistory|null findOneByAffected(string $affected) Return the first ChildAdminHistory filtered by the affected column
 * @method     ChildAdminHistory|null findOneByCreatedAt(string $created_at) Return the first ChildAdminHistory filtered by the created_at column
 * @method     ChildAdminHistory|null findOneByUpdatedAt(string $updated_at) Return the first ChildAdminHistory filtered by the updated_at column
 *
 * @method     ChildAdminHistory requirePk($key, ?ConnectionInterface $con = null) Return the ChildAdminHistory by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAdminHistory requireOne(?ConnectionInterface $con = null) Return the first ChildAdminHistory matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAdminHistory requireOneByIntId(int $int_id) Return the first ChildAdminHistory filtered by the int_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAdminHistory requireOneByAdminId(int $admin_id) Return the first ChildAdminHistory filtered by the admin_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAdminHistory requireOneByAction(int $action) Return the first ChildAdminHistory filtered by the action column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAdminHistory requireOneBySessionId(int $session_id) Return the first ChildAdminHistory filtered by the session_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAdminHistory requireOneByAffected(string $affected) Return the first ChildAdminHistory filtered by the affected column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAdminHistory requireOneByCreatedAt(string $created_at) Return the first ChildAdminHistory filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAdminHistory requireOneByUpdatedAt(string $updated_at) Return the first ChildAdminHistory filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAdminHistory[]|Collection find(?ConnectionInterface $con = null) Return ChildAdminHistory objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildAdminHistory> find(?ConnectionInterface $con = null) Return ChildAdminHistory objects based on current ModelCriteria
 *
 * @method     ChildAdminHistory[]|Collection findByIntId(int|array<int> $int_id) Return ChildAdminHistory objects filtered by the int_id column
 * @psalm-method Collection&\Traversable<ChildAdminHistory> findByIntId(int|array<int> $int_id) Return ChildAdminHistory objects filtered by the int_id column
 * @method     ChildAdminHistory[]|Collection findByAdminId(int|array<int> $admin_id) Return ChildAdminHistory objects filtered by the admin_id column
 * @psalm-method Collection&\Traversable<ChildAdminHistory> findByAdminId(int|array<int> $admin_id) Return ChildAdminHistory objects filtered by the admin_id column
 * @method     ChildAdminHistory[]|Collection findByAction(int|array<int> $action) Return ChildAdminHistory objects filtered by the action column
 * @psalm-method Collection&\Traversable<ChildAdminHistory> findByAction(int|array<int> $action) Return ChildAdminHistory objects filtered by the action column
 * @method     ChildAdminHistory[]|Collection findBySessionId(int|array<int> $session_id) Return ChildAdminHistory objects filtered by the session_id column
 * @psalm-method Collection&\Traversable<ChildAdminHistory> findBySessionId(int|array<int> $session_id) Return ChildAdminHistory objects filtered by the session_id column
 * @method     ChildAdminHistory[]|Collection findByAffected(string|array<string> $affected) Return ChildAdminHistory objects filtered by the affected column
 * @psalm-method Collection&\Traversable<ChildAdminHistory> findByAffected(string|array<string> $affected) Return ChildAdminHistory objects filtered by the affected column
 * @method     ChildAdminHistory[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildAdminHistory objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildAdminHistory> findByCreatedAt(string|array<string> $created_at) Return ChildAdminHistory objects filtered by the created_at column
 * @method     ChildAdminHistory[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildAdminHistory objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildAdminHistory> findByUpdatedAt(string|array<string> $updated_at) Return ChildAdminHistory objects filtered by the updated_at column
 *
 * @method     ChildAdminHistory[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildAdminHistory> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class AdminHistoryQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \PropelService\Base\AdminHistoryQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\PropelService\\AdminHistory', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildAdminHistoryQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildAdminHistoryQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildAdminHistoryQuery) {
            return $criteria;
        }
        $query = new ChildAdminHistoryQuery();
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
     * @return ChildAdminHistory|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(AdminHistoryTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = AdminHistoryTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildAdminHistory A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `int_id`, `admin_id`, `action`, `session_id`, `affected`, `created_at`, `updated_at` FROM `admin_history` WHERE `int_id` = :p0';
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
            /** @var ChildAdminHistory $obj */
            $obj = new ChildAdminHistory();
            $obj->hydrate($row);
            AdminHistoryTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildAdminHistory|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(AdminHistoryTableMap::COL_INT_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(AdminHistoryTableMap::COL_INT_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(AdminHistoryTableMap::COL_INT_ID, $intId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($intId['max'])) {
                $this->addUsingAlias(AdminHistoryTableMap::COL_INT_ID, $intId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AdminHistoryTableMap::COL_INT_ID, $intId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the admin_id column
     *
     * Example usage:
     * <code>
     * $query->filterByAdminId(1234); // WHERE admin_id = 1234
     * $query->filterByAdminId(array(12, 34)); // WHERE admin_id IN (12, 34)
     * $query->filterByAdminId(array('min' => 12)); // WHERE admin_id > 12
     * </code>
     *
     * @see       filterByAdmin()
     *
     * @param mixed $adminId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAdminId($adminId = null, ?string $comparison = null)
    {
        if (is_array($adminId)) {
            $useMinMax = false;
            if (isset($adminId['min'])) {
                $this->addUsingAlias(AdminHistoryTableMap::COL_ADMIN_ID, $adminId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($adminId['max'])) {
                $this->addUsingAlias(AdminHistoryTableMap::COL_ADMIN_ID, $adminId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AdminHistoryTableMap::COL_ADMIN_ID, $adminId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the action column
     *
     * Example usage:
     * <code>
     * $query->filterByAction(1234); // WHERE action = 1234
     * $query->filterByAction(array(12, 34)); // WHERE action IN (12, 34)
     * $query->filterByAction(array('min' => 12)); // WHERE action > 12
     * </code>
     *
     * @param mixed $action The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAction($action = null, ?string $comparison = null)
    {
        if (is_array($action)) {
            $useMinMax = false;
            if (isset($action['min'])) {
                $this->addUsingAlias(AdminHistoryTableMap::COL_ACTION, $action['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($action['max'])) {
                $this->addUsingAlias(AdminHistoryTableMap::COL_ACTION, $action['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AdminHistoryTableMap::COL_ACTION, $action, $comparison);

        return $this;
    }

    /**
     * Filter the query on the session_id column
     *
     * Example usage:
     * <code>
     * $query->filterBySessionId(1234); // WHERE session_id = 1234
     * $query->filterBySessionId(array(12, 34)); // WHERE session_id IN (12, 34)
     * $query->filterBySessionId(array('min' => 12)); // WHERE session_id > 12
     * </code>
     *
     * @see       filterByAdminSession()
     *
     * @param mixed $sessionId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySessionId($sessionId = null, ?string $comparison = null)
    {
        if (is_array($sessionId)) {
            $useMinMax = false;
            if (isset($sessionId['min'])) {
                $this->addUsingAlias(AdminHistoryTableMap::COL_SESSION_ID, $sessionId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sessionId['max'])) {
                $this->addUsingAlias(AdminHistoryTableMap::COL_SESSION_ID, $sessionId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AdminHistoryTableMap::COL_SESSION_ID, $sessionId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the affected column
     *
     * Example usage:
     * <code>
     * $query->filterByAffected('fooValue');   // WHERE affected = 'fooValue'
     * $query->filterByAffected('%fooValue%', Criteria::LIKE); // WHERE affected LIKE '%fooValue%'
     * $query->filterByAffected(['foo', 'bar']); // WHERE affected IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $affected The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAffected($affected = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($affected)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AdminHistoryTableMap::COL_AFFECTED, $affected, $comparison);

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
                $this->addUsingAlias(AdminHistoryTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(AdminHistoryTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AdminHistoryTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(AdminHistoryTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(AdminHistoryTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AdminHistoryTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \PropelService\Admin object
     *
     * @param \PropelService\Admin|ObjectCollection $admin The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAdmin($admin, ?string $comparison = null)
    {
        if ($admin instanceof \PropelService\Admin) {
            return $this
                ->addUsingAlias(AdminHistoryTableMap::COL_ADMIN_ID, $admin->getIntId(), $comparison);
        } elseif ($admin instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(AdminHistoryTableMap::COL_ADMIN_ID, $admin->toKeyValue('PrimaryKey', 'IntId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByAdmin() only accepts arguments of type \PropelService\Admin or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Admin relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinAdmin(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Admin');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Admin');
        }

        return $this;
    }

    /**
     * Use the Admin relation Admin object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PropelService\AdminQuery A secondary query class using the current class as primary query
     */
    public function useAdminQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinAdmin($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Admin', '\PropelService\AdminQuery');
    }

    /**
     * Use the Admin relation Admin object
     *
     * @param callable(\PropelService\AdminQuery):\PropelService\AdminQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withAdminQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useAdminQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to Admin table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \PropelService\AdminQuery The inner query object of the EXISTS statement
     */
    public function useAdminExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('Admin', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to Admin table for a NOT EXISTS query.
     *
     * @see useAdminExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \PropelService\AdminQuery The inner query object of the NOT EXISTS statement
     */
    public function useAdminNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('Admin', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \PropelService\AdminSession object
     *
     * @param \PropelService\AdminSession|ObjectCollection $adminSession The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAdminSession($adminSession, ?string $comparison = null)
    {
        if ($adminSession instanceof \PropelService\AdminSession) {
            return $this
                ->addUsingAlias(AdminHistoryTableMap::COL_SESSION_ID, $adminSession->getIntId(), $comparison);
        } elseif ($adminSession instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(AdminHistoryTableMap::COL_SESSION_ID, $adminSession->toKeyValue('PrimaryKey', 'IntId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByAdminSession() only accepts arguments of type \PropelService\AdminSession or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the AdminSession relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinAdminSession(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('AdminSession');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'AdminSession');
        }

        return $this;
    }

    /**
     * Use the AdminSession relation AdminSession object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PropelService\AdminSessionQuery A secondary query class using the current class as primary query
     */
    public function useAdminSessionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinAdminSession($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'AdminSession', '\PropelService\AdminSessionQuery');
    }

    /**
     * Use the AdminSession relation AdminSession object
     *
     * @param callable(\PropelService\AdminSessionQuery):\PropelService\AdminSessionQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withAdminSessionQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useAdminSessionQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to AdminSession table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \PropelService\AdminSessionQuery The inner query object of the EXISTS statement
     */
    public function useAdminSessionExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('AdminSession', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to AdminSession table for a NOT EXISTS query.
     *
     * @see useAdminSessionExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \PropelService\AdminSessionQuery The inner query object of the NOT EXISTS statement
     */
    public function useAdminSessionNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('AdminSession', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Exclude object from result
     *
     * @param ChildAdminHistory $adminHistory Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($adminHistory = null)
    {
        if ($adminHistory) {
            $this->addUsingAlias(AdminHistoryTableMap::COL_INT_ID, $adminHistory->getIntId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the admin_history table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(AdminHistoryTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            AdminHistoryTableMap::clearInstancePool();
            AdminHistoryTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(AdminHistoryTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(AdminHistoryTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            AdminHistoryTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            AdminHistoryTableMap::clearRelatedInstancePool();

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
        $this->addUsingAlias(AdminHistoryTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by update date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        $this->addDescendingOrderByColumn(AdminHistoryTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by update date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        $this->addAscendingOrderByColumn(AdminHistoryTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by create date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        $this->addDescendingOrderByColumn(AdminHistoryTableMap::COL_CREATED_AT);

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
        $this->addUsingAlias(AdminHistoryTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by create date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        $this->addAscendingOrderByColumn(AdminHistoryTableMap::COL_CREATED_AT);

        return $this;
    }

}
