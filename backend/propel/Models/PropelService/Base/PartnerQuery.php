<?php

namespace PropelService\Base;

use \Exception;
use \PDO;
use PropelService\Partner as ChildPartner;
use PropelService\PartnerQuery as ChildPartnerQuery;
use PropelService\Map\PartnerTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the `partner` table.
 *
 * @method     ChildPartnerQuery orderByIntId($order = Criteria::ASC) Order by the int_id column
 * @method     ChildPartnerQuery orderByCode($order = Criteria::ASC) Order by the code column
 * @method     ChildPartnerQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildPartnerQuery orderByLogo($order = Criteria::ASC) Order by the logo column
 * @method     ChildPartnerQuery orderByStructure($order = Criteria::ASC) Order by the structure column
 * @method     ChildPartnerQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildPartnerQuery orderByOptions($order = Criteria::ASC) Order by the options column
 * @method     ChildPartnerQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildPartnerQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildPartnerQuery groupByIntId() Group by the int_id column
 * @method     ChildPartnerQuery groupByCode() Group by the code column
 * @method     ChildPartnerQuery groupByName() Group by the name column
 * @method     ChildPartnerQuery groupByLogo() Group by the logo column
 * @method     ChildPartnerQuery groupByStructure() Group by the structure column
 * @method     ChildPartnerQuery groupByStatus() Group by the status column
 * @method     ChildPartnerQuery groupByOptions() Group by the options column
 * @method     ChildPartnerQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildPartnerQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildPartnerQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPartnerQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPartnerQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPartnerQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPartnerQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPartnerQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPartner|null findOne(?ConnectionInterface $con = null) Return the first ChildPartner matching the query
 * @method     ChildPartner findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildPartner matching the query, or a new ChildPartner object populated from the query conditions when no match is found
 *
 * @method     ChildPartner|null findOneByIntId(int $int_id) Return the first ChildPartner filtered by the int_id column
 * @method     ChildPartner|null findOneByCode(string $code) Return the first ChildPartner filtered by the code column
 * @method     ChildPartner|null findOneByName(string $name) Return the first ChildPartner filtered by the name column
 * @method     ChildPartner|null findOneByLogo(string $logo) Return the first ChildPartner filtered by the logo column
 * @method     ChildPartner|null findOneByStructure(string $structure) Return the first ChildPartner filtered by the structure column
 * @method     ChildPartner|null findOneByStatus(int $status) Return the first ChildPartner filtered by the status column
 * @method     ChildPartner|null findOneByOptions(string $options) Return the first ChildPartner filtered by the options column
 * @method     ChildPartner|null findOneByCreatedAt(string $created_at) Return the first ChildPartner filtered by the created_at column
 * @method     ChildPartner|null findOneByUpdatedAt(string $updated_at) Return the first ChildPartner filtered by the updated_at column
 *
 * @method     ChildPartner requirePk($key, ?ConnectionInterface $con = null) Return the ChildPartner by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPartner requireOne(?ConnectionInterface $con = null) Return the first ChildPartner matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPartner requireOneByIntId(int $int_id) Return the first ChildPartner filtered by the int_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPartner requireOneByCode(string $code) Return the first ChildPartner filtered by the code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPartner requireOneByName(string $name) Return the first ChildPartner filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPartner requireOneByLogo(string $logo) Return the first ChildPartner filtered by the logo column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPartner requireOneByStructure(string $structure) Return the first ChildPartner filtered by the structure column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPartner requireOneByStatus(int $status) Return the first ChildPartner filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPartner requireOneByOptions(string $options) Return the first ChildPartner filtered by the options column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPartner requireOneByCreatedAt(string $created_at) Return the first ChildPartner filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPartner requireOneByUpdatedAt(string $updated_at) Return the first ChildPartner filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPartner[]|Collection find(?ConnectionInterface $con = null) Return ChildPartner objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildPartner> find(?ConnectionInterface $con = null) Return ChildPartner objects based on current ModelCriteria
 *
 * @method     ChildPartner[]|Collection findByIntId(int|array<int> $int_id) Return ChildPartner objects filtered by the int_id column
 * @psalm-method Collection&\Traversable<ChildPartner> findByIntId(int|array<int> $int_id) Return ChildPartner objects filtered by the int_id column
 * @method     ChildPartner[]|Collection findByCode(string|array<string> $code) Return ChildPartner objects filtered by the code column
 * @psalm-method Collection&\Traversable<ChildPartner> findByCode(string|array<string> $code) Return ChildPartner objects filtered by the code column
 * @method     ChildPartner[]|Collection findByName(string|array<string> $name) Return ChildPartner objects filtered by the name column
 * @psalm-method Collection&\Traversable<ChildPartner> findByName(string|array<string> $name) Return ChildPartner objects filtered by the name column
 * @method     ChildPartner[]|Collection findByLogo(string|array<string> $logo) Return ChildPartner objects filtered by the logo column
 * @psalm-method Collection&\Traversable<ChildPartner> findByLogo(string|array<string> $logo) Return ChildPartner objects filtered by the logo column
 * @method     ChildPartner[]|Collection findByStructure(string|array<string> $structure) Return ChildPartner objects filtered by the structure column
 * @psalm-method Collection&\Traversable<ChildPartner> findByStructure(string|array<string> $structure) Return ChildPartner objects filtered by the structure column
 * @method     ChildPartner[]|Collection findByStatus(int|array<int> $status) Return ChildPartner objects filtered by the status column
 * @psalm-method Collection&\Traversable<ChildPartner> findByStatus(int|array<int> $status) Return ChildPartner objects filtered by the status column
 * @method     ChildPartner[]|Collection findByOptions(string|array<string> $options) Return ChildPartner objects filtered by the options column
 * @psalm-method Collection&\Traversable<ChildPartner> findByOptions(string|array<string> $options) Return ChildPartner objects filtered by the options column
 * @method     ChildPartner[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildPartner objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildPartner> findByCreatedAt(string|array<string> $created_at) Return ChildPartner objects filtered by the created_at column
 * @method     ChildPartner[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildPartner objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildPartner> findByUpdatedAt(string|array<string> $updated_at) Return ChildPartner objects filtered by the updated_at column
 *
 * @method     ChildPartner[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildPartner> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class PartnerQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \PropelService\Base\PartnerQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\PropelService\\Partner', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPartnerQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPartnerQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildPartnerQuery) {
            return $criteria;
        }
        $query = new ChildPartnerQuery();
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
     * @return ChildPartner|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PartnerTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = PartnerTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildPartner A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `int_id`, `code`, `name`, `logo`, `structure`, `status`, `options`, `created_at`, `updated_at` FROM `partner` WHERE `int_id` = :p0';
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
            /** @var ChildPartner $obj */
            $obj = new ChildPartner();
            $obj->hydrate($row);
            PartnerTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildPartner|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(PartnerTableMap::COL_INT_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(PartnerTableMap::COL_INT_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(PartnerTableMap::COL_INT_ID, $intId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($intId['max'])) {
                $this->addUsingAlias(PartnerTableMap::COL_INT_ID, $intId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PartnerTableMap::COL_INT_ID, $intId, $comparison);

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

        $this->addUsingAlias(PartnerTableMap::COL_CODE, $code, $comparison);

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

        $this->addUsingAlias(PartnerTableMap::COL_NAME, $name, $comparison);

        return $this;
    }

    /**
     * Filter the query on the logo column
     *
     * Example usage:
     * <code>
     * $query->filterByLogo('fooValue');   // WHERE logo = 'fooValue'
     * $query->filterByLogo('%fooValue%', Criteria::LIKE); // WHERE logo LIKE '%fooValue%'
     * $query->filterByLogo(['foo', 'bar']); // WHERE logo IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $logo The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLogo($logo = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($logo)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PartnerTableMap::COL_LOGO, $logo, $comparison);

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

        $this->addUsingAlias(PartnerTableMap::COL_STRUCTURE, $structure, $comparison);

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
        $valueSet = PartnerTableMap::getValueSet(PartnerTableMap::COL_STATUS);
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

        $this->addUsingAlias(PartnerTableMap::COL_STATUS, $status, $comparison);

        return $this;
    }

    /**
     * Filter the query on the options column
     *
     * Example usage:
     * <code>
     * $query->filterByOptions('fooValue');   // WHERE options = 'fooValue'
     * $query->filterByOptions('%fooValue%', Criteria::LIKE); // WHERE options LIKE '%fooValue%'
     * $query->filterByOptions(['foo', 'bar']); // WHERE options IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $options The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOptions($options = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($options)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PartnerTableMap::COL_OPTIONS, $options, $comparison);

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
                $this->addUsingAlias(PartnerTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(PartnerTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PartnerTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(PartnerTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(PartnerTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PartnerTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildPartner $partner Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($partner = null)
    {
        if ($partner) {
            $this->addUsingAlias(PartnerTableMap::COL_INT_ID, $partner->getIntId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the partner table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PartnerTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PartnerTableMap::clearInstancePool();
            PartnerTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PartnerTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PartnerTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PartnerTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PartnerTableMap::clearRelatedInstancePool();

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
        $this->addUsingAlias(PartnerTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by update date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        $this->addDescendingOrderByColumn(PartnerTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by update date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        $this->addAscendingOrderByColumn(PartnerTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by create date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        $this->addDescendingOrderByColumn(PartnerTableMap::COL_CREATED_AT);

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
        $this->addUsingAlias(PartnerTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by create date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        $this->addAscendingOrderByColumn(PartnerTableMap::COL_CREATED_AT);

        return $this;
    }

}
