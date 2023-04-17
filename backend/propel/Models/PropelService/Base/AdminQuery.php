<?php

namespace PropelService\Base;

use \Exception;
use \PDO;
use PropelService\Admin as ChildAdmin;
use PropelService\AdminQuery as ChildAdminQuery;
use PropelService\Map\AdminTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the `admin` table.
 *
 * @method     ChildAdminQuery orderByIntId($order = Criteria::ASC) Order by the int_id column
 * @method     ChildAdminQuery orderByFullname($order = Criteria::ASC) Order by the fullname column
 * @method     ChildAdminQuery orderByPhonenumber($order = Criteria::ASC) Order by the phonenumber column
 * @method     ChildAdminQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method     ChildAdminQuery orderByPasswd($order = Criteria::ASC) Order by the passwd column
 * @method     ChildAdminQuery orderByType($order = Criteria::ASC) Order by the type column
 * @method     ChildAdminQuery orderByStructure($order = Criteria::ASC) Order by the structure column
 * @method     ChildAdminQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildAdminQuery orderByLastAddress($order = Criteria::ASC) Order by the last_address column
 * @method     ChildAdminQuery orderByCallMeBotApiKey($order = Criteria::ASC) Order by the callmebot_apikey column
 * @method     ChildAdminQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildAdminQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildAdminQuery groupByIntId() Group by the int_id column
 * @method     ChildAdminQuery groupByFullname() Group by the fullname column
 * @method     ChildAdminQuery groupByPhonenumber() Group by the phonenumber column
 * @method     ChildAdminQuery groupByEmail() Group by the email column
 * @method     ChildAdminQuery groupByPasswd() Group by the passwd column
 * @method     ChildAdminQuery groupByType() Group by the type column
 * @method     ChildAdminQuery groupByStructure() Group by the structure column
 * @method     ChildAdminQuery groupByStatus() Group by the status column
 * @method     ChildAdminQuery groupByLastAddress() Group by the last_address column
 * @method     ChildAdminQuery groupByCallMeBotApiKey() Group by the callmebot_apikey column
 * @method     ChildAdminQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildAdminQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildAdminQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildAdminQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildAdminQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildAdminQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildAdminQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildAdminQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildAdminQuery leftJoinAdminSession($relationAlias = null) Adds a LEFT JOIN clause to the query using the AdminSession relation
 * @method     ChildAdminQuery rightJoinAdminSession($relationAlias = null) Adds a RIGHT JOIN clause to the query using the AdminSession relation
 * @method     ChildAdminQuery innerJoinAdminSession($relationAlias = null) Adds a INNER JOIN clause to the query using the AdminSession relation
 *
 * @method     ChildAdminQuery joinWithAdminSession($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the AdminSession relation
 *
 * @method     ChildAdminQuery leftJoinWithAdminSession() Adds a LEFT JOIN clause and with to the query using the AdminSession relation
 * @method     ChildAdminQuery rightJoinWithAdminSession() Adds a RIGHT JOIN clause and with to the query using the AdminSession relation
 * @method     ChildAdminQuery innerJoinWithAdminSession() Adds a INNER JOIN clause and with to the query using the AdminSession relation
 *
 * @method     ChildAdminQuery leftJoinAdminHistory($relationAlias = null) Adds a LEFT JOIN clause to the query using the AdminHistory relation
 * @method     ChildAdminQuery rightJoinAdminHistory($relationAlias = null) Adds a RIGHT JOIN clause to the query using the AdminHistory relation
 * @method     ChildAdminQuery innerJoinAdminHistory($relationAlias = null) Adds a INNER JOIN clause to the query using the AdminHistory relation
 *
 * @method     ChildAdminQuery joinWithAdminHistory($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the AdminHistory relation
 *
 * @method     ChildAdminQuery leftJoinWithAdminHistory() Adds a LEFT JOIN clause and with to the query using the AdminHistory relation
 * @method     ChildAdminQuery rightJoinWithAdminHistory() Adds a RIGHT JOIN clause and with to the query using the AdminHistory relation
 * @method     ChildAdminQuery innerJoinWithAdminHistory() Adds a INNER JOIN clause and with to the query using the AdminHistory relation
 *
 * @method     \PropelService\AdminSessionQuery|\PropelService\AdminHistoryQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildAdmin|null findOne(?ConnectionInterface $con = null) Return the first ChildAdmin matching the query
 * @method     ChildAdmin findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildAdmin matching the query, or a new ChildAdmin object populated from the query conditions when no match is found
 *
 * @method     ChildAdmin|null findOneByIntId(int $int_id) Return the first ChildAdmin filtered by the int_id column
 * @method     ChildAdmin|null findOneByFullname(string $fullname) Return the first ChildAdmin filtered by the fullname column
 * @method     ChildAdmin|null findOneByPhonenumber(string $phonenumber) Return the first ChildAdmin filtered by the phonenumber column
 * @method     ChildAdmin|null findOneByEmail(string $email) Return the first ChildAdmin filtered by the email column
 * @method     ChildAdmin|null findOneByPasswd(string $passwd) Return the first ChildAdmin filtered by the passwd column
 * @method     ChildAdmin|null findOneByType(int $type) Return the first ChildAdmin filtered by the type column
 * @method     ChildAdmin|null findOneByStructure(string $structure) Return the first ChildAdmin filtered by the structure column
 * @method     ChildAdmin|null findOneByStatus(int $status) Return the first ChildAdmin filtered by the status column
 * @method     ChildAdmin|null findOneByLastAddress(string $last_address) Return the first ChildAdmin filtered by the last_address column
 * @method     ChildAdmin|null findOneByCallMeBotApiKey(string $callmebot_apikey) Return the first ChildAdmin filtered by the callmebot_apikey column
 * @method     ChildAdmin|null findOneByCreatedAt(string $created_at) Return the first ChildAdmin filtered by the created_at column
 * @method     ChildAdmin|null findOneByUpdatedAt(string $updated_at) Return the first ChildAdmin filtered by the updated_at column
 *
 * @method     ChildAdmin requirePk($key, ?ConnectionInterface $con = null) Return the ChildAdmin by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAdmin requireOne(?ConnectionInterface $con = null) Return the first ChildAdmin matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAdmin requireOneByIntId(int $int_id) Return the first ChildAdmin filtered by the int_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAdmin requireOneByFullname(string $fullname) Return the first ChildAdmin filtered by the fullname column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAdmin requireOneByPhonenumber(string $phonenumber) Return the first ChildAdmin filtered by the phonenumber column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAdmin requireOneByEmail(string $email) Return the first ChildAdmin filtered by the email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAdmin requireOneByPasswd(string $passwd) Return the first ChildAdmin filtered by the passwd column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAdmin requireOneByType(int $type) Return the first ChildAdmin filtered by the type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAdmin requireOneByStructure(string $structure) Return the first ChildAdmin filtered by the structure column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAdmin requireOneByStatus(int $status) Return the first ChildAdmin filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAdmin requireOneByLastAddress(string $last_address) Return the first ChildAdmin filtered by the last_address column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAdmin requireOneByCallMeBotApiKey(string $callmebot_apikey) Return the first ChildAdmin filtered by the callmebot_apikey column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAdmin requireOneByCreatedAt(string $created_at) Return the first ChildAdmin filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAdmin requireOneByUpdatedAt(string $updated_at) Return the first ChildAdmin filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAdmin[]|Collection find(?ConnectionInterface $con = null) Return ChildAdmin objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildAdmin> find(?ConnectionInterface $con = null) Return ChildAdmin objects based on current ModelCriteria
 *
 * @method     ChildAdmin[]|Collection findByIntId(int|array<int> $int_id) Return ChildAdmin objects filtered by the int_id column
 * @psalm-method Collection&\Traversable<ChildAdmin> findByIntId(int|array<int> $int_id) Return ChildAdmin objects filtered by the int_id column
 * @method     ChildAdmin[]|Collection findByFullname(string|array<string> $fullname) Return ChildAdmin objects filtered by the fullname column
 * @psalm-method Collection&\Traversable<ChildAdmin> findByFullname(string|array<string> $fullname) Return ChildAdmin objects filtered by the fullname column
 * @method     ChildAdmin[]|Collection findByPhonenumber(string|array<string> $phonenumber) Return ChildAdmin objects filtered by the phonenumber column
 * @psalm-method Collection&\Traversable<ChildAdmin> findByPhonenumber(string|array<string> $phonenumber) Return ChildAdmin objects filtered by the phonenumber column
 * @method     ChildAdmin[]|Collection findByEmail(string|array<string> $email) Return ChildAdmin objects filtered by the email column
 * @psalm-method Collection&\Traversable<ChildAdmin> findByEmail(string|array<string> $email) Return ChildAdmin objects filtered by the email column
 * @method     ChildAdmin[]|Collection findByPasswd(string|array<string> $passwd) Return ChildAdmin objects filtered by the passwd column
 * @psalm-method Collection&\Traversable<ChildAdmin> findByPasswd(string|array<string> $passwd) Return ChildAdmin objects filtered by the passwd column
 * @method     ChildAdmin[]|Collection findByType(int|array<int> $type) Return ChildAdmin objects filtered by the type column
 * @psalm-method Collection&\Traversable<ChildAdmin> findByType(int|array<int> $type) Return ChildAdmin objects filtered by the type column
 * @method     ChildAdmin[]|Collection findByStructure(string|array<string> $structure) Return ChildAdmin objects filtered by the structure column
 * @psalm-method Collection&\Traversable<ChildAdmin> findByStructure(string|array<string> $structure) Return ChildAdmin objects filtered by the structure column
 * @method     ChildAdmin[]|Collection findByStatus(int|array<int> $status) Return ChildAdmin objects filtered by the status column
 * @psalm-method Collection&\Traversable<ChildAdmin> findByStatus(int|array<int> $status) Return ChildAdmin objects filtered by the status column
 * @method     ChildAdmin[]|Collection findByLastAddress(string|array<string> $last_address) Return ChildAdmin objects filtered by the last_address column
 * @psalm-method Collection&\Traversable<ChildAdmin> findByLastAddress(string|array<string> $last_address) Return ChildAdmin objects filtered by the last_address column
 * @method     ChildAdmin[]|Collection findByCallMeBotApiKey(string|array<string> $callmebot_apikey) Return ChildAdmin objects filtered by the callmebot_apikey column
 * @psalm-method Collection&\Traversable<ChildAdmin> findByCallMeBotApiKey(string|array<string> $callmebot_apikey) Return ChildAdmin objects filtered by the callmebot_apikey column
 * @method     ChildAdmin[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildAdmin objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildAdmin> findByCreatedAt(string|array<string> $created_at) Return ChildAdmin objects filtered by the created_at column
 * @method     ChildAdmin[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildAdmin objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildAdmin> findByUpdatedAt(string|array<string> $updated_at) Return ChildAdmin objects filtered by the updated_at column
 *
 * @method     ChildAdmin[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildAdmin> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class AdminQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \PropelService\Base\AdminQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\PropelService\\Admin', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildAdminQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildAdminQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildAdminQuery) {
            return $criteria;
        }
        $query = new ChildAdminQuery();
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
     * @return ChildAdmin|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(AdminTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = AdminTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildAdmin A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `int_id`, `fullname`, `phonenumber`, `email`, `passwd`, `type`, `structure`, `status`, `last_address`, `callmebot_apikey`, `created_at`, `updated_at` FROM `admin` WHERE `int_id` = :p0';
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
            /** @var ChildAdmin $obj */
            $obj = new ChildAdmin();
            $obj->hydrate($row);
            AdminTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildAdmin|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(AdminTableMap::COL_INT_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(AdminTableMap::COL_INT_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(AdminTableMap::COL_INT_ID, $intId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($intId['max'])) {
                $this->addUsingAlias(AdminTableMap::COL_INT_ID, $intId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AdminTableMap::COL_INT_ID, $intId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the fullname column
     *
     * Example usage:
     * <code>
     * $query->filterByFullname('fooValue');   // WHERE fullname = 'fooValue'
     * $query->filterByFullname('%fooValue%', Criteria::LIKE); // WHERE fullname LIKE '%fooValue%'
     * $query->filterByFullname(['foo', 'bar']); // WHERE fullname IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $fullname The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFullname($fullname = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fullname)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AdminTableMap::COL_FULLNAME, $fullname, $comparison);

        return $this;
    }

    /**
     * Filter the query on the phonenumber column
     *
     * Example usage:
     * <code>
     * $query->filterByPhonenumber('fooValue');   // WHERE phonenumber = 'fooValue'
     * $query->filterByPhonenumber('%fooValue%', Criteria::LIKE); // WHERE phonenumber LIKE '%fooValue%'
     * $query->filterByPhonenumber(['foo', 'bar']); // WHERE phonenumber IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $phonenumber The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPhonenumber($phonenumber = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($phonenumber)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AdminTableMap::COL_PHONENUMBER, $phonenumber, $comparison);

        return $this;
    }

    /**
     * Filter the query on the email column
     *
     * Example usage:
     * <code>
     * $query->filterByEmail('fooValue');   // WHERE email = 'fooValue'
     * $query->filterByEmail('%fooValue%', Criteria::LIKE); // WHERE email LIKE '%fooValue%'
     * $query->filterByEmail(['foo', 'bar']); // WHERE email IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $email The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmail($email = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AdminTableMap::COL_EMAIL, $email, $comparison);

        return $this;
    }

    /**
     * Filter the query on the passwd column
     *
     * Example usage:
     * <code>
     * $query->filterByPasswd('fooValue');   // WHERE passwd = 'fooValue'
     * $query->filterByPasswd('%fooValue%', Criteria::LIKE); // WHERE passwd LIKE '%fooValue%'
     * $query->filterByPasswd(['foo', 'bar']); // WHERE passwd IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $passwd The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPasswd($passwd = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($passwd)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AdminTableMap::COL_PASSWD, $passwd, $comparison);

        return $this;
    }

    /**
     * Filter the query on the type column
     *
     * @param mixed $type The value to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByType($type = null, ?string $comparison = null)
    {
        $valueSet = AdminTableMap::getValueSet(AdminTableMap::COL_TYPE);
        if (is_scalar($type)) {
            if (!in_array($type, $valueSet)) {
                throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $type));
            }
            $type = array_search($type, $valueSet);
        } elseif (is_array($type)) {
            $convertedValues = [];
            foreach ($type as $value) {
                if (!in_array($value, $valueSet)) {
                    throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $value));
                }
                $convertedValues []= array_search($value, $valueSet);
            }
            $type = $convertedValues;
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AdminTableMap::COL_TYPE, $type, $comparison);

        return $this;
    }

    /**
     * Filter the query on the structure column
     *
     * Example usage:
     * <code>
     * $query->filterByStructure('fooValue');   // WHERE structure = 'fooValue'
     * $query->filterByStructure('%fooValue%', Criteria::LIKE); // WHERE structure LIKE '%fooValue%'
     * $query->filterByStructure(['foo', 'bar']); // WHERE structure IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $structure The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStructure($structure = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($structure)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AdminTableMap::COL_STRUCTURE, $structure, $comparison);

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
        $valueSet = AdminTableMap::getValueSet(AdminTableMap::COL_STATUS);
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

        $this->addUsingAlias(AdminTableMap::COL_STATUS, $status, $comparison);

        return $this;
    }

    /**
     * Filter the query on the last_address column
     *
     * Example usage:
     * <code>
     * $query->filterByLastAddress('fooValue');   // WHERE last_address = 'fooValue'
     * $query->filterByLastAddress('%fooValue%', Criteria::LIKE); // WHERE last_address LIKE '%fooValue%'
     * $query->filterByLastAddress(['foo', 'bar']); // WHERE last_address IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $lastAddress The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLastAddress($lastAddress = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($lastAddress)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AdminTableMap::COL_LAST_ADDRESS, $lastAddress, $comparison);

        return $this;
    }

    /**
     * Filter the query on the callmebot_apikey column
     *
     * Example usage:
     * <code>
     * $query->filterByCallMeBotApiKey('fooValue');   // WHERE callmebot_apikey = 'fooValue'
     * $query->filterByCallMeBotApiKey('%fooValue%', Criteria::LIKE); // WHERE callmebot_apikey LIKE '%fooValue%'
     * $query->filterByCallMeBotApiKey(['foo', 'bar']); // WHERE callmebot_apikey IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $callMeBotApiKey The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCallMeBotApiKey($callMeBotApiKey = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($callMeBotApiKey)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AdminTableMap::COL_CALLMEBOT_APIKEY, $callMeBotApiKey, $comparison);

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
                $this->addUsingAlias(AdminTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(AdminTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AdminTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(AdminTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(AdminTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AdminTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \PropelService\AdminSession object
     *
     * @param \PropelService\AdminSession|ObjectCollection $adminSession the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAdminSession($adminSession, ?string $comparison = null)
    {
        if ($adminSession instanceof \PropelService\AdminSession) {
            $this
                ->addUsingAlias(AdminTableMap::COL_INT_ID, $adminSession->getAdminId(), $comparison);

            return $this;
        } elseif ($adminSession instanceof ObjectCollection) {
            $this
                ->useAdminSessionQuery()
                ->filterByPrimaryKeys($adminSession->getPrimaryKeys())
                ->endUse();

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
                ->addUsingAlias(AdminTableMap::COL_INT_ID, $adminHistory->getAdminId(), $comparison);

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
     * @param ChildAdmin $admin Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($admin = null)
    {
        if ($admin) {
            $this->addUsingAlias(AdminTableMap::COL_INT_ID, $admin->getIntId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the admin table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(AdminTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            AdminTableMap::clearInstancePool();
            AdminTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(AdminTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(AdminTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            AdminTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            AdminTableMap::clearRelatedInstancePool();

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
        $this->addUsingAlias(AdminTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by update date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        $this->addDescendingOrderByColumn(AdminTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by update date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        $this->addAscendingOrderByColumn(AdminTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by create date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        $this->addDescendingOrderByColumn(AdminTableMap::COL_CREATED_AT);

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
        $this->addUsingAlias(AdminTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by create date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        $this->addAscendingOrderByColumn(AdminTableMap::COL_CREATED_AT);

        return $this;
    }

}
