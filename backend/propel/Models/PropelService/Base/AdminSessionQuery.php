<?php

namespace PropelService\Base;

use \Exception;
use \PDO;
use PropelService\AdminSession as ChildAdminSession;
use PropelService\AdminSessionQuery as ChildAdminSessionQuery;
use PropelService\Map\AdminSessionTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the `admin_session` table.
 *
 * @method     ChildAdminSessionQuery orderByIntId($order = Criteria::ASC) Order by the int_id column
 * @method     ChildAdminSessionQuery orderByAdminId($order = Criteria::ASC) Order by the admin_id column
 * @method     ChildAdminSessionQuery orderByToken($order = Criteria::ASC) Order by the token column
 * @method     ChildAdminSessionQuery orderByExpireDate($order = Criteria::ASC) Order by the expire_date column
 * @method     ChildAdminSessionQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildAdminSessionQuery orderByIpAddress($order = Criteria::ASC) Order by the ip_address column
 * @method     ChildAdminSessionQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildAdminSessionQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildAdminSessionQuery groupByIntId() Group by the int_id column
 * @method     ChildAdminSessionQuery groupByAdminId() Group by the admin_id column
 * @method     ChildAdminSessionQuery groupByToken() Group by the token column
 * @method     ChildAdminSessionQuery groupByExpireDate() Group by the expire_date column
 * @method     ChildAdminSessionQuery groupByStatus() Group by the status column
 * @method     ChildAdminSessionQuery groupByIpAddress() Group by the ip_address column
 * @method     ChildAdminSessionQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildAdminSessionQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildAdminSessionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildAdminSessionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildAdminSessionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildAdminSessionQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildAdminSessionQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildAdminSessionQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildAdminSessionQuery leftJoinAdmin($relationAlias = null) Adds a LEFT JOIN clause to the query using the Admin relation
 * @method     ChildAdminSessionQuery rightJoinAdmin($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Admin relation
 * @method     ChildAdminSessionQuery innerJoinAdmin($relationAlias = null) Adds a INNER JOIN clause to the query using the Admin relation
 *
 * @method     ChildAdminSessionQuery joinWithAdmin($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Admin relation
 *
 * @method     ChildAdminSessionQuery leftJoinWithAdmin() Adds a LEFT JOIN clause and with to the query using the Admin relation
 * @method     ChildAdminSessionQuery rightJoinWithAdmin() Adds a RIGHT JOIN clause and with to the query using the Admin relation
 * @method     ChildAdminSessionQuery innerJoinWithAdmin() Adds a INNER JOIN clause and with to the query using the Admin relation
 *
 * @method     ChildAdminSessionQuery leftJoinAdminHistory($relationAlias = null) Adds a LEFT JOIN clause to the query using the AdminHistory relation
 * @method     ChildAdminSessionQuery rightJoinAdminHistory($relationAlias = null) Adds a RIGHT JOIN clause to the query using the AdminHistory relation
 * @method     ChildAdminSessionQuery innerJoinAdminHistory($relationAlias = null) Adds a INNER JOIN clause to the query using the AdminHistory relation
 *
 * @method     ChildAdminSessionQuery joinWithAdminHistory($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the AdminHistory relation
 *
 * @method     ChildAdminSessionQuery leftJoinWithAdminHistory() Adds a LEFT JOIN clause and with to the query using the AdminHistory relation
 * @method     ChildAdminSessionQuery rightJoinWithAdminHistory() Adds a RIGHT JOIN clause and with to the query using the AdminHistory relation
 * @method     ChildAdminSessionQuery innerJoinWithAdminHistory() Adds a INNER JOIN clause and with to the query using the AdminHistory relation
 *
 * @method     \PropelService\AdminQuery|\PropelService\AdminHistoryQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildAdminSession|null findOne(?ConnectionInterface $con = null) Return the first ChildAdminSession matching the query
 * @method     ChildAdminSession findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildAdminSession matching the query, or a new ChildAdminSession object populated from the query conditions when no match is found
 *
 * @method     ChildAdminSession|null findOneByIntId(int $int_id) Return the first ChildAdminSession filtered by the int_id column
 * @method     ChildAdminSession|null findOneByAdminId(int $admin_id) Return the first ChildAdminSession filtered by the admin_id column
 * @method     ChildAdminSession|null findOneByToken(string $token) Return the first ChildAdminSession filtered by the token column
 * @method     ChildAdminSession|null findOneByExpireDate(string $expire_date) Return the first ChildAdminSession filtered by the expire_date column
 * @method     ChildAdminSession|null findOneByStatus(int $status) Return the first ChildAdminSession filtered by the status column
 * @method     ChildAdminSession|null findOneByIpAddress(string $ip_address) Return the first ChildAdminSession filtered by the ip_address column
 * @method     ChildAdminSession|null findOneByCreatedAt(string $created_at) Return the first ChildAdminSession filtered by the created_at column
 * @method     ChildAdminSession|null findOneByUpdatedAt(string $updated_at) Return the first ChildAdminSession filtered by the updated_at column
 *
 * @method     ChildAdminSession requirePk($key, ?ConnectionInterface $con = null) Return the ChildAdminSession by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAdminSession requireOne(?ConnectionInterface $con = null) Return the first ChildAdminSession matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAdminSession requireOneByIntId(int $int_id) Return the first ChildAdminSession filtered by the int_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAdminSession requireOneByAdminId(int $admin_id) Return the first ChildAdminSession filtered by the admin_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAdminSession requireOneByToken(string $token) Return the first ChildAdminSession filtered by the token column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAdminSession requireOneByExpireDate(string $expire_date) Return the first ChildAdminSession filtered by the expire_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAdminSession requireOneByStatus(int $status) Return the first ChildAdminSession filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAdminSession requireOneByIpAddress(string $ip_address) Return the first ChildAdminSession filtered by the ip_address column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAdminSession requireOneByCreatedAt(string $created_at) Return the first ChildAdminSession filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAdminSession requireOneByUpdatedAt(string $updated_at) Return the first ChildAdminSession filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAdminSession[]|Collection find(?ConnectionInterface $con = null) Return ChildAdminSession objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildAdminSession> find(?ConnectionInterface $con = null) Return ChildAdminSession objects based on current ModelCriteria
 *
 * @method     ChildAdminSession[]|Collection findByIntId(int|array<int> $int_id) Return ChildAdminSession objects filtered by the int_id column
 * @psalm-method Collection&\Traversable<ChildAdminSession> findByIntId(int|array<int> $int_id) Return ChildAdminSession objects filtered by the int_id column
 * @method     ChildAdminSession[]|Collection findByAdminId(int|array<int> $admin_id) Return ChildAdminSession objects filtered by the admin_id column
 * @psalm-method Collection&\Traversable<ChildAdminSession> findByAdminId(int|array<int> $admin_id) Return ChildAdminSession objects filtered by the admin_id column
 * @method     ChildAdminSession[]|Collection findByToken(string|array<string> $token) Return ChildAdminSession objects filtered by the token column
 * @psalm-method Collection&\Traversable<ChildAdminSession> findByToken(string|array<string> $token) Return ChildAdminSession objects filtered by the token column
 * @method     ChildAdminSession[]|Collection findByExpireDate(string|array<string> $expire_date) Return ChildAdminSession objects filtered by the expire_date column
 * @psalm-method Collection&\Traversable<ChildAdminSession> findByExpireDate(string|array<string> $expire_date) Return ChildAdminSession objects filtered by the expire_date column
 * @method     ChildAdminSession[]|Collection findByStatus(int|array<int> $status) Return ChildAdminSession objects filtered by the status column
 * @psalm-method Collection&\Traversable<ChildAdminSession> findByStatus(int|array<int> $status) Return ChildAdminSession objects filtered by the status column
 * @method     ChildAdminSession[]|Collection findByIpAddress(string|array<string> $ip_address) Return ChildAdminSession objects filtered by the ip_address column
 * @psalm-method Collection&\Traversable<ChildAdminSession> findByIpAddress(string|array<string> $ip_address) Return ChildAdminSession objects filtered by the ip_address column
 * @method     ChildAdminSession[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildAdminSession objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildAdminSession> findByCreatedAt(string|array<string> $created_at) Return ChildAdminSession objects filtered by the created_at column
 * @method     ChildAdminSession[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildAdminSession objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildAdminSession> findByUpdatedAt(string|array<string> $updated_at) Return ChildAdminSession objects filtered by the updated_at column
 *
 * @method     ChildAdminSession[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildAdminSession> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class AdminSessionQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \PropelService\Base\AdminSessionQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\PropelService\\AdminSession', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildAdminSessionQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildAdminSessionQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildAdminSessionQuery) {
            return $criteria;
        }
        $query = new ChildAdminSessionQuery();
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
     * @return ChildAdminSession|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(AdminSessionTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = AdminSessionTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildAdminSession A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `int_id`, `admin_id`, `token`, `expire_date`, `status`, `ip_address`, `created_at`, `updated_at` FROM `admin_session` WHERE `int_id` = :p0';
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
            /** @var ChildAdminSession $obj */
            $obj = new ChildAdminSession();
            $obj->hydrate($row);
            AdminSessionTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildAdminSession|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(AdminSessionTableMap::COL_INT_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(AdminSessionTableMap::COL_INT_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(AdminSessionTableMap::COL_INT_ID, $intId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($intId['max'])) {
                $this->addUsingAlias(AdminSessionTableMap::COL_INT_ID, $intId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AdminSessionTableMap::COL_INT_ID, $intId, $comparison);

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
                $this->addUsingAlias(AdminSessionTableMap::COL_ADMIN_ID, $adminId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($adminId['max'])) {
                $this->addUsingAlias(AdminSessionTableMap::COL_ADMIN_ID, $adminId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AdminSessionTableMap::COL_ADMIN_ID, $adminId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the token column
     *
     * Example usage:
     * <code>
     * $query->filterByToken('fooValue');   // WHERE token = 'fooValue'
     * $query->filterByToken('%fooValue%', Criteria::LIKE); // WHERE token LIKE '%fooValue%'
     * $query->filterByToken(['foo', 'bar']); // WHERE token IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $token The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByToken($token = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($token)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AdminSessionTableMap::COL_TOKEN, $token, $comparison);

        return $this;
    }

    /**
     * Filter the query on the expire_date column
     *
     * Example usage:
     * <code>
     * $query->filterByExpireDate('2011-03-14'); // WHERE expire_date = '2011-03-14'
     * $query->filterByExpireDate('now'); // WHERE expire_date = '2011-03-14'
     * $query->filterByExpireDate(array('max' => 'yesterday')); // WHERE expire_date > '2011-03-13'
     * </code>
     *
     * @param mixed $expireDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpireDate($expireDate = null, ?string $comparison = null)
    {
        if (is_array($expireDate)) {
            $useMinMax = false;
            if (isset($expireDate['min'])) {
                $this->addUsingAlias(AdminSessionTableMap::COL_EXPIRE_DATE, $expireDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($expireDate['max'])) {
                $this->addUsingAlias(AdminSessionTableMap::COL_EXPIRE_DATE, $expireDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AdminSessionTableMap::COL_EXPIRE_DATE, $expireDate, $comparison);

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
        $valueSet = AdminSessionTableMap::getValueSet(AdminSessionTableMap::COL_STATUS);
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

        $this->addUsingAlias(AdminSessionTableMap::COL_STATUS, $status, $comparison);

        return $this;
    }

    /**
     * Filter the query on the ip_address column
     *
     * Example usage:
     * <code>
     * $query->filterByIpAddress('fooValue');   // WHERE ip_address = 'fooValue'
     * $query->filterByIpAddress('%fooValue%', Criteria::LIKE); // WHERE ip_address LIKE '%fooValue%'
     * $query->filterByIpAddress(['foo', 'bar']); // WHERE ip_address IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $ipAddress The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIpAddress($ipAddress = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ipAddress)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AdminSessionTableMap::COL_IP_ADDRESS, $ipAddress, $comparison);

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
                $this->addUsingAlias(AdminSessionTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(AdminSessionTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AdminSessionTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(AdminSessionTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(AdminSessionTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AdminSessionTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

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
                ->addUsingAlias(AdminSessionTableMap::COL_ADMIN_ID, $admin->getIntId(), $comparison);
        } elseif ($admin instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(AdminSessionTableMap::COL_ADMIN_ID, $admin->toKeyValue('PrimaryKey', 'IntId'), $comparison);

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
     * Filter the query by a related \PropelService\AdminHistory object
     *
     * @param \PropelService\AdminHistory|ObjectCollection $adminHistory the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAdminHistory($adminHistory, ?string $comparison = null)
    {
        if ($adminHistory instanceof \PropelService\AdminHistory) {
            $this
                ->addUsingAlias(AdminSessionTableMap::COL_INT_ID, $adminHistory->getSessionId(), $comparison);

            return $this;
        } elseif ($adminHistory instanceof ObjectCollection) {
            $this
                ->useAdminHistoryQuery()
                ->filterByPrimaryKeys($adminHistory->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByAdminHistory() only accepts arguments of type \PropelService\AdminHistory or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the AdminHistory relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinAdminHistory(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('AdminHistory');

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
            $this->addJoinObject($join, 'AdminHistory');
        }

        return $this;
    }

    /**
     * Use the AdminHistory relation AdminHistory object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PropelService\AdminHistoryQuery A secondary query class using the current class as primary query
     */
    public function useAdminHistoryQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinAdminHistory($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'AdminHistory', '\PropelService\AdminHistoryQuery');
    }

    /**
     * Use the AdminHistory relation AdminHistory object
     *
     * @param callable(\PropelService\AdminHistoryQuery):\PropelService\AdminHistoryQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withAdminHistoryQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useAdminHistoryQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to AdminHistory table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \PropelService\AdminHistoryQuery The inner query object of the EXISTS statement
     */
    public function useAdminHistoryExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('AdminHistory', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to AdminHistory table for a NOT EXISTS query.
     *
     * @see useAdminHistoryExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \PropelService\AdminHistoryQuery The inner query object of the NOT EXISTS statement
     */
    public function useAdminHistoryNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('AdminHistory', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Exclude object from result
     *
     * @param ChildAdminSession $adminSession Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($adminSession = null)
    {
        if ($adminSession) {
            $this->addUsingAlias(AdminSessionTableMap::COL_INT_ID, $adminSession->getIntId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the admin_session table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(AdminSessionTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            AdminSessionTableMap::clearInstancePool();
            AdminSessionTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(AdminSessionTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(AdminSessionTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            AdminSessionTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            AdminSessionTableMap::clearRelatedInstancePool();

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
        $this->addUsingAlias(AdminSessionTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by update date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        $this->addDescendingOrderByColumn(AdminSessionTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by update date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        $this->addAscendingOrderByColumn(AdminSessionTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by create date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        $this->addDescendingOrderByColumn(AdminSessionTableMap::COL_CREATED_AT);

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
        $this->addUsingAlias(AdminSessionTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by create date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        $this->addAscendingOrderByColumn(AdminSessionTableMap::COL_CREATED_AT);

        return $this;
    }

}
