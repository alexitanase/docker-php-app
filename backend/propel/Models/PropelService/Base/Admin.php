<?php

namespace PropelService\Base;

use \DateTime;
use \Exception;
use \PDO;
use PropelService\Admin as ChildAdmin;
use PropelService\AdminHistory as ChildAdminHistory;
use PropelService\AdminHistoryQuery as ChildAdminHistoryQuery;
use PropelService\AdminQuery as ChildAdminQuery;
use PropelService\AdminSession as ChildAdminSession;
use PropelService\AdminSessionQuery as ChildAdminSessionQuery;
use PropelService\Map\AdminHistoryTableMap;
use PropelService\Map\AdminSessionTableMap;
use PropelService\Map\AdminTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;

/**
 * Base class that represents a row from the 'admin' table.
 *
 *
 *
 * @package    propel.generator.PropelService.Base
 */
abstract class Admin implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\PropelService\\Map\\AdminTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var bool
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var bool
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = [];

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = [];

    /**
     * The value for the int_id field.
     *
     * @var        int
     */
    protected $int_id;

    /**
     * The value for the fullname field.
     *
     * @var        string|null
     */
    protected $fullname;

    /**
     * The value for the phonenumber field.
     *
     * @var        string|null
     */
    protected $phonenumber;

    /**
     * The value for the email field.
     *
     * @var        string
     */
    protected $email;

    /**
     * The value for the passwd field.
     *
     * @var        string
     */
    protected $passwd;

    /**
     * The value for the type field.
     *
     * Note: this column has a database default value of: 1
     * @var        int
     */
    protected $type;

    /**
     * The value for the structure field.
     *
     * @var        string|null
     */
    protected $structure;

    /**
     * The value for the status field.
     *
     * Note: this column has a database default value of: 1
     * @var        int
     */
    protected $status;

    /**
     * The value for the last_address field.
     *
     * @var        string
     */
    protected $last_address;

    /**
     * The value for the callmebot_apikey field.
     *
     * @var        string|null
     */
    protected $callmebot_apikey;

    /**
     * The value for the created_at field.
     *
     * @var        DateTime|null
     */
    protected $created_at;

    /**
     * The value for the updated_at field.
     *
     * @var        DateTime|null
     */
    protected $updated_at;

    /**
     * @var        ObjectCollection|ChildAdminSession[] Collection to store aggregation of ChildAdminSession objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildAdminSession> Collection to store aggregation of ChildAdminSession objects.
     */
    protected $collAdminSessions;
    protected $collAdminSessionsPartial;

    /**
     * @var        ObjectCollection|ChildAdminHistory[] Collection to store aggregation of ChildAdminHistory objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildAdminHistory> Collection to store aggregation of ChildAdminHistory objects.
     */
    protected $collAdminHistories;
    protected $collAdminHistoriesPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildAdminSession[]
     * @phpstan-var ObjectCollection&\Traversable<ChildAdminSession>
     */
    protected $adminSessionsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildAdminHistory[]
     * @phpstan-var ObjectCollection&\Traversable<ChildAdminHistory>
     */
    protected $adminHistoriesScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues(): void
    {
        $this->type = 1;
        $this->status = 1;
    }

    /**
     * Initializes internal state of PropelService\Base\Admin object.
     * @see applyDefaults()
     */
    public function __construct()
    {
        $this->applyDefaultValues();
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return bool True if the object has been modified.
     */
    public function isModified(): bool
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param string $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return bool True if $col has been modified.
     */
    public function isColumnModified(string $col): bool
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns(): array
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return bool True, if the object has never been persisted.
     */
    public function isNew(): bool
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param bool $b the state of the object.
     */
    public function setNew(bool $b): void
    {
        $this->new = $b;
    }

    /**
     * Whether this object has been deleted.
     * @return bool The deleted state of this object.
     */
    public function isDeleted(): bool
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param bool $b The deleted state of this object.
     * @return void
     */
    public function setDeleted(bool $b): void
    {
        $this->deleted = $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified(?string $col = null): void
    {
        if (null !== $col) {
            unset($this->modifiedColumns[$col]);
        } else {
            $this->modifiedColumns = [];
        }
    }

    /**
     * Compares this with another <code>Admin</code> instance.  If
     * <code>obj</code> is an instance of <code>Admin</code>, delegates to
     * <code>equals(Admin)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param mixed $obj The object to compare to.
     * @return bool Whether equal to the object specified.
     */
    public function equals($obj): bool
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns(): array
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param string $name The virtual column name
     * @return bool
     */
    public function hasVirtualColumn(string $name): bool
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param string $name The virtual column name
     * @return mixed
     *
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getVirtualColumn(string $name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of nonexistent virtual column `%s`.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name The virtual column name
     * @param mixed $value The value to give to the virtual column
     *
     * @return $this The current object, for fluid interface
     */
    public function setVirtualColumn(string $name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param string $msg
     * @param int $priority One of the Propel::LOG_* logging levels
     * @return void
     */
    protected function log(string $msg, int $priority = Propel::LOG_INFO): void
    {
        Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param \Propel\Runtime\Parser\AbstractParser|string $parser An AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param bool $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @param string $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME, TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM. Defaults to TableMap::TYPE_PHPNAME.
     * @return string The exported data
     */
    public function exportTo($parser, bool $includeLazyLoadColumns = true, string $keyType = TableMap::TYPE_PHPNAME): string
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray($keyType, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     *
     * @return array<string>
     */
    public function __sleep(): array
    {
        $this->clearAllReferences();

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));

        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }

        return $propertyNames;
    }

    /**
     * Get the [int_id] column value.
     *
     * @return int
     */
    public function getIntId()
    {
        return $this->int_id;
    }

    /**
     * Get the [fullname] column value.
     *
     * @return string|null
     */
    public function getFullname()
    {
        return $this->fullname;
    }

    /**
     * Get the [phonenumber] column value.
     *
     * @return string|null
     */
    public function getPhonenumber()
    {
        return $this->phonenumber;
    }

    /**
     * Get the [email] column value.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the [passwd] column value.
     *
     * @return string
     */
    public function getPasswd()
    {
        return $this->passwd;
    }

    /**
     * Get the [type] column value.
     *
     * @return string|null
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getType()
    {
        if (null === $this->type) {
            return null;
        }
        $valueSet = AdminTableMap::getValueSet(AdminTableMap::COL_TYPE);
        if (!isset($valueSet[$this->type])) {
            throw new PropelException('Unknown stored enum key: ' . $this->type);
        }

        return $valueSet[$this->type];
    }

    /**
     * Get the [structure] column value.
     *
     * @return string|null
     */
    public function getStructure()
    {
        return $this->structure;
    }

    /**
     * Get the [status] column value.
     *
     * @return string|null
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getStatus()
    {
        if (null === $this->status) {
            return null;
        }
        $valueSet = AdminTableMap::getValueSet(AdminTableMap::COL_STATUS);
        if (!isset($valueSet[$this->status])) {
            throw new PropelException('Unknown stored enum key: ' . $this->status);
        }

        return $valueSet[$this->status];
    }

    /**
     * Get the [last_address] column value.
     *
     * @return string
     */
    public function getLastAddress()
    {
        return $this->last_address;
    }

    /**
     * Get the [callmebot_apikey] column value.
     *
     * @return string|null
     */
    public function getCallMeBotApiKey()
    {
        return $this->callmebot_apikey;
    }

    /**
     * Get the [optionally formatted] temporal [created_at] column value.
     *
     *
     * @param string|null $format The date/time format string (either date()-style or strftime()-style).
     *   If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime|null Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00.
     *
     * @throws \Propel\Runtime\Exception\PropelException - if unable to parse/validate the date/time value.
     *
     * @psalm-return ($format is null ? DateTime|null : string|null)
     */
    public function getCreatedAt($format = null)
    {
        if ($format === null) {
            return $this->created_at;
        } else {
            return $this->created_at instanceof \DateTimeInterface ? $this->created_at->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [updated_at] column value.
     *
     *
     * @param string|null $format The date/time format string (either date()-style or strftime()-style).
     *   If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime|null Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00.
     *
     * @throws \Propel\Runtime\Exception\PropelException - if unable to parse/validate the date/time value.
     *
     * @psalm-return ($format is null ? DateTime|null : string|null)
     */
    public function getUpdatedAt($format = null)
    {
        if ($format === null) {
            return $this->updated_at;
        } else {
            return $this->updated_at instanceof \DateTimeInterface ? $this->updated_at->format($format) : null;
        }
    }

    /**
     * Set the value of [int_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIntId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->int_id !== $v) {
            $this->int_id = $v;
            $this->modifiedColumns[AdminTableMap::COL_INT_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [fullname] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFullname($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->fullname !== $v) {
            $this->fullname = $v;
            $this->modifiedColumns[AdminTableMap::COL_FULLNAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [phonenumber] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPhonenumber($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->phonenumber !== $v) {
            $this->phonenumber = $v;
            $this->modifiedColumns[AdminTableMap::COL_PHONENUMBER] = true;
        }

        return $this;
    }

    /**
     * Set the value of [email] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setEmail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->email !== $v) {
            $this->email = $v;
            $this->modifiedColumns[AdminTableMap::COL_EMAIL] = true;
        }

        return $this;
    }

    /**
     * Set the value of [passwd] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPasswd($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->passwd !== $v) {
            $this->passwd = $v;
            $this->modifiedColumns[AdminTableMap::COL_PASSWD] = true;
        }

        return $this;
    }

    /**
     * Set the value of [type] column.
     *
     * @param string $v new value
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setType($v)
    {
        if ($v !== null) {
            $valueSet = AdminTableMap::getValueSet(AdminTableMap::COL_TYPE);
            if (!in_array($v, $valueSet)) {
                throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $v));
            }
            $v = array_search($v, $valueSet);
        }

        if ($this->type !== $v) {
            $this->type = $v;
            $this->modifiedColumns[AdminTableMap::COL_TYPE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [structure] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setStructure($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->structure !== $v) {
            $this->structure = $v;
            $this->modifiedColumns[AdminTableMap::COL_STRUCTURE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [status] column.
     *
     * @param string $v new value
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setStatus($v)
    {
        if ($v !== null) {
            $valueSet = AdminTableMap::getValueSet(AdminTableMap::COL_STATUS);
            if (!in_array($v, $valueSet)) {
                throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $v));
            }
            $v = array_search($v, $valueSet);
        }

        if ($this->status !== $v) {
            $this->status = $v;
            $this->modifiedColumns[AdminTableMap::COL_STATUS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [last_address] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setLastAddress($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->last_address !== $v) {
            $this->last_address = $v;
            $this->modifiedColumns[AdminTableMap::COL_LAST_ADDRESS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [callmebot_apikey] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCallMeBotApiKey($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->callmebot_apikey !== $v) {
            $this->callmebot_apikey = $v;
            $this->modifiedColumns[AdminTableMap::COL_CALLMEBOT_APIKEY] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            if ($this->created_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->created_at->format("Y-m-d H:i:s.u")) {
                $this->created_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[AdminTableMap::COL_CREATED_AT] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            if ($this->updated_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->updated_at->format("Y-m-d H:i:s.u")) {
                $this->updated_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[AdminTableMap::COL_UPDATED_AT] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return bool Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues(): bool
    {
            if ($this->type !== 1) {
                return false;
            }

            if ($this->status !== 1) {
                return false;
            }

        // otherwise, everything was equal, so return TRUE
        return true;
    }

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array $row The row returned by DataFetcher->fetch().
     * @param int $startcol 0-based offset column which indicates which resultset column to start with.
     * @param bool $rehydrate Whether this object is being re-hydrated from the database.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int next starting column
     * @throws \Propel\Runtime\Exception\PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate(array $row, int $startcol = 0, bool $rehydrate = false, string $indexType = TableMap::TYPE_NUM): int
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : AdminTableMap::translateFieldName('IntId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->int_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : AdminTableMap::translateFieldName('Fullname', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fullname = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : AdminTableMap::translateFieldName('Phonenumber', TableMap::TYPE_PHPNAME, $indexType)];
            $this->phonenumber = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : AdminTableMap::translateFieldName('Email', TableMap::TYPE_PHPNAME, $indexType)];
            $this->email = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : AdminTableMap::translateFieldName('Passwd', TableMap::TYPE_PHPNAME, $indexType)];
            $this->passwd = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : AdminTableMap::translateFieldName('Type', TableMap::TYPE_PHPNAME, $indexType)];
            $this->type = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : AdminTableMap::translateFieldName('Structure', TableMap::TYPE_PHPNAME, $indexType)];
            $this->structure = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : AdminTableMap::translateFieldName('Status', TableMap::TYPE_PHPNAME, $indexType)];
            $this->status = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : AdminTableMap::translateFieldName('LastAddress', TableMap::TYPE_PHPNAME, $indexType)];
            $this->last_address = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : AdminTableMap::translateFieldName('CallMeBotApiKey', TableMap::TYPE_PHPNAME, $indexType)];
            $this->callmebot_apikey = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : AdminTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : AdminTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 12; // 12 = AdminTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\PropelService\\Admin'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function ensureConsistency(): void
    {
    }

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param bool $deep (optional) Whether to also de-associated any related objects.
     * @param ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload(bool $deep = false, ?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(AdminTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildAdminQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collAdminSessions = null;

            $this->collAdminHistories = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see Admin::setDeleted()
     * @see Admin::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(AdminTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildAdminQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param ConnectionInterface $con
     * @return int The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws \Propel\Runtime\Exception\PropelException
     * @see doSave()
     */
    public function save(?ConnectionInterface $con = null): int
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($this->alreadyInSave) {
            return 0;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(AdminTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior
                $time = time();
                $highPrecision = \Propel\Runtime\Util\PropelDateTime::createHighPrecision();
                if (!$this->isColumnModified(AdminTableMap::COL_CREATED_AT)) {
                    $this->setCreatedAt($highPrecision);
                }
                if (!$this->isColumnModified(AdminTableMap::COL_UPDATED_AT)) {
                    $this->setUpdatedAt($highPrecision);
                }
            } else {
                $ret = $ret && $this->preUpdate($con);
                // timestampable behavior
                if ($this->isModified() && !$this->isColumnModified(AdminTableMap::COL_UPDATED_AT)) {
                    $this->setUpdatedAt(\Propel\Runtime\Util\PropelDateTime::createHighPrecision());
                }
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                AdminTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param ConnectionInterface $con
     * @return int The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws \Propel\Runtime\Exception\PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con): int
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            if ($this->adminSessionsScheduledForDeletion !== null) {
                if (!$this->adminSessionsScheduledForDeletion->isEmpty()) {
                    \PropelService\AdminSessionQuery::create()
                        ->filterByPrimaryKeys($this->adminSessionsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->adminSessionsScheduledForDeletion = null;
                }
            }

            if ($this->collAdminSessions !== null) {
                foreach ($this->collAdminSessions as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->adminHistoriesScheduledForDeletion !== null) {
                if (!$this->adminHistoriesScheduledForDeletion->isEmpty()) {
                    \PropelService\AdminHistoryQuery::create()
                        ->filterByPrimaryKeys($this->adminHistoriesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->adminHistoriesScheduledForDeletion = null;
                }
            }

            if ($this->collAdminHistories !== null) {
                foreach ($this->collAdminHistories as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    }

    /**
     * Insert the row in the database.
     *
     * @param ConnectionInterface $con
     *
     * @throws \Propel\Runtime\Exception\PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con): void
    {
        $modifiedColumns = [];
        $index = 0;

        $this->modifiedColumns[AdminTableMap::COL_INT_ID] = true;
        if (null !== $this->int_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . AdminTableMap::COL_INT_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(AdminTableMap::COL_INT_ID)) {
            $modifiedColumns[':p' . $index++]  = '`int_id`';
        }
        if ($this->isColumnModified(AdminTableMap::COL_FULLNAME)) {
            $modifiedColumns[':p' . $index++]  = '`fullname`';
        }
        if ($this->isColumnModified(AdminTableMap::COL_PHONENUMBER)) {
            $modifiedColumns[':p' . $index++]  = '`phonenumber`';
        }
        if ($this->isColumnModified(AdminTableMap::COL_EMAIL)) {
            $modifiedColumns[':p' . $index++]  = '`email`';
        }
        if ($this->isColumnModified(AdminTableMap::COL_PASSWD)) {
            $modifiedColumns[':p' . $index++]  = '`passwd`';
        }
        if ($this->isColumnModified(AdminTableMap::COL_TYPE)) {
            $modifiedColumns[':p' . $index++]  = '`type`';
        }
        if ($this->isColumnModified(AdminTableMap::COL_STRUCTURE)) {
            $modifiedColumns[':p' . $index++]  = '`structure`';
        }
        if ($this->isColumnModified(AdminTableMap::COL_STATUS)) {
            $modifiedColumns[':p' . $index++]  = '`status`';
        }
        if ($this->isColumnModified(AdminTableMap::COL_LAST_ADDRESS)) {
            $modifiedColumns[':p' . $index++]  = '`last_address`';
        }
        if ($this->isColumnModified(AdminTableMap::COL_CALLMEBOT_APIKEY)) {
            $modifiedColumns[':p' . $index++]  = '`callmebot_apikey`';
        }
        if ($this->isColumnModified(AdminTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`created_at`';
        }
        if ($this->isColumnModified(AdminTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`updated_at`';
        }

        $sql = sprintf(
            'INSERT INTO `admin` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`int_id`':
                        $stmt->bindValue($identifier, $this->int_id, PDO::PARAM_INT);
                        break;
                    case '`fullname`':
                        $stmt->bindValue($identifier, $this->fullname, PDO::PARAM_STR);
                        break;
                    case '`phonenumber`':
                        $stmt->bindValue($identifier, $this->phonenumber, PDO::PARAM_STR);
                        break;
                    case '`email`':
                        $stmt->bindValue($identifier, $this->email, PDO::PARAM_STR);
                        break;
                    case '`passwd`':
                        $stmt->bindValue($identifier, $this->passwd, PDO::PARAM_STR);
                        break;
                    case '`type`':
                        $stmt->bindValue($identifier, $this->type, PDO::PARAM_INT);
                        break;
                    case '`structure`':
                        $stmt->bindValue($identifier, $this->structure, PDO::PARAM_STR);
                        break;
                    case '`status`':
                        $stmt->bindValue($identifier, $this->status, PDO::PARAM_INT);
                        break;
                    case '`last_address`':
                        $stmt->bindValue($identifier, $this->last_address, PDO::PARAM_STR);
                        break;
                    case '`callmebot_apikey`':
                        $stmt->bindValue($identifier, $this->callmebot_apikey, PDO::PARAM_STR);
                        break;
                    case '`created_at`':
                        $stmt->bindValue($identifier, $this->created_at ? $this->created_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case '`updated_at`':
                        $stmt->bindValue($identifier, $this->updated_at ? $this->updated_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setIntId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param ConnectionInterface $con
     *
     * @return int Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con): int
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param string $name name
     * @param string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName(string $name, string $type = TableMap::TYPE_PHPNAME)
    {
        $pos = AdminTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos Position in XML schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition(int $pos)
    {
        switch ($pos) {
            case 0:
                return $this->getIntId();

            case 1:
                return $this->getFullname();

            case 2:
                return $this->getPhonenumber();

            case 3:
                return $this->getEmail();

            case 4:
                return $this->getPasswd();

            case 5:
                return $this->getType();

            case 6:
                return $this->getStructure();

            case 7:
                return $this->getStatus();

            case 8:
                return $this->getLastAddress();

            case 9:
                return $this->getCallMeBotApiKey();

            case 10:
                return $this->getCreatedAt();

            case 11:
                return $this->getUpdatedAt();

            default:
                return null;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param string $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param bool $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param bool $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array An associative array containing the field names (as keys) and field values
     */
    public function toArray(string $keyType = TableMap::TYPE_PHPNAME, bool $includeLazyLoadColumns = true, array $alreadyDumpedObjects = [], bool $includeForeignObjects = false): array
    {
        if (isset($alreadyDumpedObjects['Admin'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['Admin'][$this->hashCode()] = true;
        $keys = AdminTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getIntId(),
            $keys[1] => $this->getFullname(),
            $keys[2] => $this->getPhonenumber(),
            $keys[3] => $this->getEmail(),
            $keys[4] => $this->getPasswd(),
            $keys[5] => $this->getType(),
            $keys[6] => $this->getStructure(),
            $keys[7] => $this->getStatus(),
            $keys[8] => $this->getLastAddress(),
            $keys[9] => $this->getCallMeBotApiKey(),
            $keys[10] => $this->getCreatedAt(),
            $keys[11] => $this->getUpdatedAt(),
        ];
        if ($result[$keys[10]] instanceof \DateTimeInterface) {
            $result[$keys[10]] = $result[$keys[10]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[11]] instanceof \DateTimeInterface) {
            $result[$keys[11]] = $result[$keys[11]]->format('Y-m-d H:i:s.u');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collAdminSessions) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'adminSessions';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'admin_sessions';
                        break;
                    default:
                        $key = 'AdminSessions';
                }

                $result[$key] = $this->collAdminSessions->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collAdminHistories) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'adminHistories';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'admin_histories';
                        break;
                    default:
                        $key = 'AdminHistories';
                }

                $result[$key] = $this->collAdminHistories->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param string $name
     * @param mixed $value field value
     * @param string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this
     */
    public function setByName(string $name, $value, string $type = TableMap::TYPE_PHPNAME)
    {
        $pos = AdminTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        $this->setByPosition($pos, $value);

        return $this;
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @param mixed $value field value
     * @return $this
     */
    public function setByPosition(int $pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setIntId($value);
                break;
            case 1:
                $this->setFullname($value);
                break;
            case 2:
                $this->setPhonenumber($value);
                break;
            case 3:
                $this->setEmail($value);
                break;
            case 4:
                $this->setPasswd($value);
                break;
            case 5:
                $valueSet = AdminTableMap::getValueSet(AdminTableMap::COL_TYPE);
                if (isset($valueSet[$value])) {
                    $value = $valueSet[$value];
                }
                $this->setType($value);
                break;
            case 6:
                $this->setStructure($value);
                break;
            case 7:
                $valueSet = AdminTableMap::getValueSet(AdminTableMap::COL_STATUS);
                if (isset($valueSet[$value])) {
                    $value = $valueSet[$value];
                }
                $this->setStatus($value);
                break;
            case 8:
                $this->setLastAddress($value);
                break;
            case 9:
                $this->setCallMeBotApiKey($value);
                break;
            case 10:
                $this->setCreatedAt($value);
                break;
            case 11:
                $this->setUpdatedAt($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param array $arr An array to populate the object from.
     * @param string $keyType The type of keys the array uses.
     * @return $this
     */
    public function fromArray(array $arr, string $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = AdminTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIntId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setFullname($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setPhonenumber($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setEmail($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setPasswd($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setType($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setStructure($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setStatus($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setLastAddress($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setCallMeBotApiKey($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setCreatedAt($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setUpdatedAt($arr[$keys[11]]);
        }

        return $this;
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this The current object, for fluid interface
     */
    public function importFrom($parser, string $data, string $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return \Propel\Runtime\ActiveQuery\Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria(): Criteria
    {
        $criteria = new Criteria(AdminTableMap::DATABASE_NAME);

        if ($this->isColumnModified(AdminTableMap::COL_INT_ID)) {
            $criteria->add(AdminTableMap::COL_INT_ID, $this->int_id);
        }
        if ($this->isColumnModified(AdminTableMap::COL_FULLNAME)) {
            $criteria->add(AdminTableMap::COL_FULLNAME, $this->fullname);
        }
        if ($this->isColumnModified(AdminTableMap::COL_PHONENUMBER)) {
            $criteria->add(AdminTableMap::COL_PHONENUMBER, $this->phonenumber);
        }
        if ($this->isColumnModified(AdminTableMap::COL_EMAIL)) {
            $criteria->add(AdminTableMap::COL_EMAIL, $this->email);
        }
        if ($this->isColumnModified(AdminTableMap::COL_PASSWD)) {
            $criteria->add(AdminTableMap::COL_PASSWD, $this->passwd);
        }
        if ($this->isColumnModified(AdminTableMap::COL_TYPE)) {
            $criteria->add(AdminTableMap::COL_TYPE, $this->type);
        }
        if ($this->isColumnModified(AdminTableMap::COL_STRUCTURE)) {
            $criteria->add(AdminTableMap::COL_STRUCTURE, $this->structure);
        }
        if ($this->isColumnModified(AdminTableMap::COL_STATUS)) {
            $criteria->add(AdminTableMap::COL_STATUS, $this->status);
        }
        if ($this->isColumnModified(AdminTableMap::COL_LAST_ADDRESS)) {
            $criteria->add(AdminTableMap::COL_LAST_ADDRESS, $this->last_address);
        }
        if ($this->isColumnModified(AdminTableMap::COL_CALLMEBOT_APIKEY)) {
            $criteria->add(AdminTableMap::COL_CALLMEBOT_APIKEY, $this->callmebot_apikey);
        }
        if ($this->isColumnModified(AdminTableMap::COL_CREATED_AT)) {
            $criteria->add(AdminTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(AdminTableMap::COL_UPDATED_AT)) {
            $criteria->add(AdminTableMap::COL_UPDATED_AT, $this->updated_at);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return \Propel\Runtime\ActiveQuery\Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria(): Criteria
    {
        $criteria = ChildAdminQuery::create();
        $criteria->add(AdminTableMap::COL_INT_ID, $this->int_id);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int|string Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getIntId();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getIntId();
    }

    /**
     * Generic method to set the primary key (int_id column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setIntId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getIntId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \PropelService\Admin (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setFullname($this->getFullname());
        $copyObj->setPhonenumber($this->getPhonenumber());
        $copyObj->setEmail($this->getEmail());
        $copyObj->setPasswd($this->getPasswd());
        $copyObj->setType($this->getType());
        $copyObj->setStructure($this->getStructure());
        $copyObj->setStatus($this->getStatus());
        $copyObj->setLastAddress($this->getLastAddress());
        $copyObj->setCallMeBotApiKey($this->getCallMeBotApiKey());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getAdminSessions() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addAdminSession($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getAdminHistories() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addAdminHistory($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIntId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \PropelService\Admin Clone of current object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function copy(bool $deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName): void
    {
        if ('AdminSession' === $relationName) {
            $this->initAdminSessions();
            return;
        }
        if ('AdminHistory' === $relationName) {
            $this->initAdminHistories();
            return;
        }
    }

    /**
     * Clears out the collAdminSessions collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addAdminSessions()
     */
    public function clearAdminSessions()
    {
        $this->collAdminSessions = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collAdminSessions collection loaded partially.
     *
     * @return void
     */
    public function resetPartialAdminSessions($v = true): void
    {
        $this->collAdminSessionsPartial = $v;
    }

    /**
     * Initializes the collAdminSessions collection.
     *
     * By default this just sets the collAdminSessions collection to an empty array (like clearcollAdminSessions());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initAdminSessions(bool $overrideExisting = true): void
    {
        if (null !== $this->collAdminSessions && !$overrideExisting) {
            return;
        }

        $collectionClassName = AdminSessionTableMap::getTableMap()->getCollectionClassName();

        $this->collAdminSessions = new $collectionClassName;
        $this->collAdminSessions->setModel('\PropelService\AdminSession');
    }

    /**
     * Gets an array of ChildAdminSession objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildAdmin is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildAdminSession[] List of ChildAdminSession objects
     * @phpstan-return ObjectCollection&\Traversable<ChildAdminSession> List of ChildAdminSession objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getAdminSessions(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collAdminSessionsPartial && !$this->isNew();
        if (null === $this->collAdminSessions || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collAdminSessions) {
                    $this->initAdminSessions();
                } else {
                    $collectionClassName = AdminSessionTableMap::getTableMap()->getCollectionClassName();

                    $collAdminSessions = new $collectionClassName;
                    $collAdminSessions->setModel('\PropelService\AdminSession');

                    return $collAdminSessions;
                }
            } else {
                $collAdminSessions = ChildAdminSessionQuery::create(null, $criteria)
                    ->filterByAdmin($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collAdminSessionsPartial && count($collAdminSessions)) {
                        $this->initAdminSessions(false);

                        foreach ($collAdminSessions as $obj) {
                            if (false == $this->collAdminSessions->contains($obj)) {
                                $this->collAdminSessions->append($obj);
                            }
                        }

                        $this->collAdminSessionsPartial = true;
                    }

                    return $collAdminSessions;
                }

                if ($partial && $this->collAdminSessions) {
                    foreach ($this->collAdminSessions as $obj) {
                        if ($obj->isNew()) {
                            $collAdminSessions[] = $obj;
                        }
                    }
                }

                $this->collAdminSessions = $collAdminSessions;
                $this->collAdminSessionsPartial = false;
            }
        }

        return $this->collAdminSessions;
    }

    /**
     * Sets a collection of ChildAdminSession objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $adminSessions A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setAdminSessions(Collection $adminSessions, ?ConnectionInterface $con = null)
    {
        /** @var ChildAdminSession[] $adminSessionsToDelete */
        $adminSessionsToDelete = $this->getAdminSessions(new Criteria(), $con)->diff($adminSessions);


        $this->adminSessionsScheduledForDeletion = $adminSessionsToDelete;

        foreach ($adminSessionsToDelete as $adminSessionRemoved) {
            $adminSessionRemoved->setAdmin(null);
        }

        $this->collAdminSessions = null;
        foreach ($adminSessions as $adminSession) {
            $this->addAdminSession($adminSession);
        }

        $this->collAdminSessions = $adminSessions;
        $this->collAdminSessionsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related AdminSession objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related AdminSession objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countAdminSessions(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collAdminSessionsPartial && !$this->isNew();
        if (null === $this->collAdminSessions || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collAdminSessions) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getAdminSessions());
            }

            $query = ChildAdminSessionQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAdmin($this)
                ->count($con);
        }

        return count($this->collAdminSessions);
    }

    /**
     * Method called to associate a ChildAdminSession object to this object
     * through the ChildAdminSession foreign key attribute.
     *
     * @param ChildAdminSession $l ChildAdminSession
     * @return $this The current object (for fluent API support)
     */
    public function addAdminSession(ChildAdminSession $l)
    {
        if ($this->collAdminSessions === null) {
            $this->initAdminSessions();
            $this->collAdminSessionsPartial = true;
        }

        if (!$this->collAdminSessions->contains($l)) {
            $this->doAddAdminSession($l);

            if ($this->adminSessionsScheduledForDeletion and $this->adminSessionsScheduledForDeletion->contains($l)) {
                $this->adminSessionsScheduledForDeletion->remove($this->adminSessionsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildAdminSession $adminSession The ChildAdminSession object to add.
     */
    protected function doAddAdminSession(ChildAdminSession $adminSession): void
    {
        $this->collAdminSessions[]= $adminSession;
        $adminSession->setAdmin($this);
    }

    /**
     * @param ChildAdminSession $adminSession The ChildAdminSession object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeAdminSession(ChildAdminSession $adminSession)
    {
        if ($this->getAdminSessions()->contains($adminSession)) {
            $pos = $this->collAdminSessions->search($adminSession);
            $this->collAdminSessions->remove($pos);
            if (null === $this->adminSessionsScheduledForDeletion) {
                $this->adminSessionsScheduledForDeletion = clone $this->collAdminSessions;
                $this->adminSessionsScheduledForDeletion->clear();
            }
            $this->adminSessionsScheduledForDeletion[]= clone $adminSession;
            $adminSession->setAdmin(null);
        }

        return $this;
    }

    /**
     * Clears out the collAdminHistories collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addAdminHistories()
     */
    public function clearAdminHistories()
    {
        $this->collAdminHistories = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collAdminHistories collection loaded partially.
     *
     * @return void
     */
    public function resetPartialAdminHistories($v = true): void
    {
        $this->collAdminHistoriesPartial = $v;
    }

    /**
     * Initializes the collAdminHistories collection.
     *
     * By default this just sets the collAdminHistories collection to an empty array (like clearcollAdminHistories());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initAdminHistories(bool $overrideExisting = true): void
    {
        if (null !== $this->collAdminHistories && !$overrideExisting) {
            return;
        }

        $collectionClassName = AdminHistoryTableMap::getTableMap()->getCollectionClassName();

        $this->collAdminHistories = new $collectionClassName;
        $this->collAdminHistories->setModel('\PropelService\AdminHistory');
    }

    /**
     * Gets an array of ChildAdminHistory objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildAdmin is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildAdminHistory[] List of ChildAdminHistory objects
     * @phpstan-return ObjectCollection&\Traversable<ChildAdminHistory> List of ChildAdminHistory objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getAdminHistories(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collAdminHistoriesPartial && !$this->isNew();
        if (null === $this->collAdminHistories || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collAdminHistories) {
                    $this->initAdminHistories();
                } else {
                    $collectionClassName = AdminHistoryTableMap::getTableMap()->getCollectionClassName();

                    $collAdminHistories = new $collectionClassName;
                    $collAdminHistories->setModel('\PropelService\AdminHistory');

                    return $collAdminHistories;
                }
            } else {
                $collAdminHistories = ChildAdminHistoryQuery::create(null, $criteria)
                    ->filterByAdmin($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collAdminHistoriesPartial && count($collAdminHistories)) {
                        $this->initAdminHistories(false);

                        foreach ($collAdminHistories as $obj) {
                            if (false == $this->collAdminHistories->contains($obj)) {
                                $this->collAdminHistories->append($obj);
                            }
                        }

                        $this->collAdminHistoriesPartial = true;
                    }

                    return $collAdminHistories;
                }

                if ($partial && $this->collAdminHistories) {
                    foreach ($this->collAdminHistories as $obj) {
                        if ($obj->isNew()) {
                            $collAdminHistories[] = $obj;
                        }
                    }
                }

                $this->collAdminHistories = $collAdminHistories;
                $this->collAdminHistoriesPartial = false;
            }
        }

        return $this->collAdminHistories;
    }

    /**
     * Sets a collection of ChildAdminHistory objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $adminHistories A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setAdminHistories(Collection $adminHistories, ?ConnectionInterface $con = null)
    {
        /** @var ChildAdminHistory[] $adminHistoriesToDelete */
        $adminHistoriesToDelete = $this->getAdminHistories(new Criteria(), $con)->diff($adminHistories);


        $this->adminHistoriesScheduledForDeletion = $adminHistoriesToDelete;

        foreach ($adminHistoriesToDelete as $adminHistoryRemoved) {
            $adminHistoryRemoved->setAdmin(null);
        }

        $this->collAdminHistories = null;
        foreach ($adminHistories as $adminHistory) {
            $this->addAdminHistory($adminHistory);
        }

        $this->collAdminHistories = $adminHistories;
        $this->collAdminHistoriesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related AdminHistory objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related AdminHistory objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countAdminHistories(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collAdminHistoriesPartial && !$this->isNew();
        if (null === $this->collAdminHistories || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collAdminHistories) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getAdminHistories());
            }

            $query = ChildAdminHistoryQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAdmin($this)
                ->count($con);
        }

        return count($this->collAdminHistories);
    }

    /**
     * Method called to associate a ChildAdminHistory object to this object
     * through the ChildAdminHistory foreign key attribute.
     *
     * @param ChildAdminHistory $l ChildAdminHistory
     * @return $this The current object (for fluent API support)
     */
    public function addAdminHistory(ChildAdminHistory $l)
    {
        if ($this->collAdminHistories === null) {
            $this->initAdminHistories();
            $this->collAdminHistoriesPartial = true;
        }

        if (!$this->collAdminHistories->contains($l)) {
            $this->doAddAdminHistory($l);

            if ($this->adminHistoriesScheduledForDeletion and $this->adminHistoriesScheduledForDeletion->contains($l)) {
                $this->adminHistoriesScheduledForDeletion->remove($this->adminHistoriesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildAdminHistory $adminHistory The ChildAdminHistory object to add.
     */
    protected function doAddAdminHistory(ChildAdminHistory $adminHistory): void
    {
        $this->collAdminHistories[]= $adminHistory;
        $adminHistory->setAdmin($this);
    }

    /**
     * @param ChildAdminHistory $adminHistory The ChildAdminHistory object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeAdminHistory(ChildAdminHistory $adminHistory)
    {
        if ($this->getAdminHistories()->contains($adminHistory)) {
            $pos = $this->collAdminHistories->search($adminHistory);
            $this->collAdminHistories->remove($pos);
            if (null === $this->adminHistoriesScheduledForDeletion) {
                $this->adminHistoriesScheduledForDeletion = clone $this->collAdminHistories;
                $this->adminHistoriesScheduledForDeletion->clear();
            }
            $this->adminHistoriesScheduledForDeletion[]= clone $adminHistory;
            $adminHistory->setAdmin(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Admin is new, it will return
     * an empty collection; or if this Admin has previously
     * been saved, it will retrieve related AdminHistories from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Admin.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildAdminHistory[] List of ChildAdminHistory objects
     * @phpstan-return ObjectCollection&\Traversable<ChildAdminHistory}> List of ChildAdminHistory objects
     */
    public function getAdminHistoriesJoinAdminSession(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildAdminHistoryQuery::create(null, $criteria);
        $query->joinWith('AdminSession', $joinBehavior);

        return $this->getAdminHistories($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     *
     * @return $this
     */
    public function clear()
    {
        $this->int_id = null;
        $this->fullname = null;
        $this->phonenumber = null;
        $this->email = null;
        $this->passwd = null;
        $this->type = null;
        $this->structure = null;
        $this->status = null;
        $this->last_address = null;
        $this->callmebot_apikey = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->applyDefaultValues();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);

        return $this;
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param bool $deep Whether to also clear the references on all referrer objects.
     * @return $this
     */
    public function clearAllReferences(bool $deep = false)
    {
        if ($deep) {
            if ($this->collAdminSessions) {
                foreach ($this->collAdminSessions as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collAdminHistories) {
                foreach ($this->collAdminHistories as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collAdminSessions = null;
        $this->collAdminHistories = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(AdminTableMap::DEFAULT_STRING_FORMAT);
    }

    // timestampable behavior

    /**
     * Mark the current object so that the update date doesn't get updated during next save
     *
     * @return $this The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[AdminTableMap::COL_UPDATED_AT] = true;

        return $this;
    }

    /**
     * Code to be run before persisting the object
     * @param ConnectionInterface|null $con
     * @return bool
     */
    public function preSave(?ConnectionInterface $con = null): bool
    {
                return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface|null $con
     * @return void
     */
    public function postSave(?ConnectionInterface $con = null): void
    {
            }

    /**
     * Code to be run before inserting to database
     * @param ConnectionInterface|null $con
     * @return bool
     */
    public function preInsert(?ConnectionInterface $con = null): bool
    {
                return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface|null $con
     * @return void
     */
    public function postInsert(?ConnectionInterface $con = null): void
    {
            }

    /**
     * Code to be run before updating the object in database
     * @param ConnectionInterface|null $con
     * @return bool
     */
    public function preUpdate(?ConnectionInterface $con = null): bool
    {
                return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface|null $con
     * @return void
     */
    public function postUpdate(?ConnectionInterface $con = null): void
    {
            }

    /**
     * Code to be run before deleting the object in database
     * @param ConnectionInterface|null $con
     * @return bool
     */
    public function preDelete(?ConnectionInterface $con = null): bool
    {
                return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface|null $con
     * @return void
     */
    public function postDelete(?ConnectionInterface $con = null): void
    {
            }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);
            $inputData = $params[0];
            $keyType = $params[1] ?? TableMap::TYPE_PHPNAME;

            return $this->importFrom($format, $inputData, $keyType);
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = $params[0] ?? true;
            $keyType = $params[1] ?? TableMap::TYPE_PHPNAME;

            return $this->exportTo($format, $includeLazyLoadColumns, $keyType);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
