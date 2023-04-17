<?php
use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1670951201.
 * Generated on 2022-12-13 17:06:41 by root 
 */
class PropelMigration_1670951201 
{
    public $comment = '';

    public function preUp(MigrationManager $manager)
    {
        // add the pre-migration code here
    }

    public function postUp(MigrationManager $manager)
    {
        // add the post-migration code here
    }

    public function preDown(MigrationManager $manager)
    {
        // add the pre-migration code here
    }

    public function postDown(MigrationManager $manager)
    {
        // add the post-migration code here
    }

    /**
     * Get the SQL statements for the Up migration
     *
     * @return array list of the SQL strings to execute for the Up migration
     *               the keys being the datasources
     */
    public function getUpSQL()
    {
        $connection_default = <<< 'EOT'

# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

CREATE TABLE `admin`
(
    `int_id` INTEGER NOT NULL AUTO_INCREMENT,
    `fullname` TEXT,
    `phonenumber` TEXT,
    `email` TEXT NOT NULL,
    `passwd` TEXT NOT NULL,
    `type` TINYINT DEFAULT 1 NOT NULL,
    `structure` TEXT,
    `status` TINYINT DEFAULT 1 NOT NULL,
    `last_address` TEXT NOT NULL,
    `callmebot_apikey` TEXT,
    `created_at` TIMESTAMP NULL,
    `updated_at` TIMESTAMP NULL,
    PRIMARY KEY (`int_id`),
    UNIQUE INDEX `int_id` (`int_id`)
) ENGINE=InnoDB;

CREATE TABLE `admin_session`
(
    `int_id` INTEGER NOT NULL AUTO_INCREMENT,
    `admin_id` INTEGER NOT NULL,
    `token` CHAR(40) NOT NULL,
    `expire_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `status` TINYINT DEFAULT 0 NOT NULL,
    `ip_address` TEXT NOT NULL,
    `created_at` TIMESTAMP NULL,
    `updated_at` TIMESTAMP NULL,
    PRIMARY KEY (`int_id`),
    UNIQUE INDEX `admin_session_u_c79c34` (`int_id`),
    INDEX `admin_session_i_dc5a43` (`admin_id`, `token`),
    CONSTRAINT `admin_session_fk_e7df4f`
        FOREIGN KEY (`admin_id`)
        REFERENCES `admin` (`int_id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE `admin_history`
(
    `int_id` INTEGER NOT NULL AUTO_INCREMENT,
    `admin_id` INTEGER NOT NULL,
    `action` INTEGER NOT NULL,
    `session_id` INTEGER NOT NULL,
    `affected` TEXT,
    `created_at` TIMESTAMP NULL,
    `updated_at` TIMESTAMP NULL,
    PRIMARY KEY (`int_id`),
    UNIQUE INDEX `admin_history_u_c79c34` (`int_id`),
    INDEX `admin_history_fi_e7df4f` (`admin_id`),
    INDEX `admin_history_fi_3a780c` (`session_id`),
    CONSTRAINT `admin_history_fk_e7df4f`
        FOREIGN KEY (`admin_id`)
        REFERENCES `admin` (`int_id`)
        ON DELETE CASCADE,
    CONSTRAINT `admin_history_fk_3a780c`
        FOREIGN KEY (`session_id`)
        REFERENCES `admin_session` (`int_id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE `structure`
(
    `int_id` INTEGER NOT NULL AUTO_INCREMENT,
    `code` CHAR(40) NOT NULL,
    `name` TEXT NOT NULL,
    `parent` CHAR(40) NOT NULL,
    `status` TINYINT DEFAULT 1 NOT NULL,
    `content` JSON,
    `created_at` TIMESTAMP NULL,
    `updated_at` TIMESTAMP NULL,
    PRIMARY KEY (`int_id`),
    UNIQUE INDEX `int_id` (`int_id`)
) ENGINE=InnoDB;

CREATE TABLE `partner`
(
    `int_id` INTEGER NOT NULL AUTO_INCREMENT,
    `code` CHAR(40) NOT NULL,
    `name` TEXT NOT NULL,
    `logo` TEXT,
    `structure` CHAR(40) NOT NULL,
    `status` TINYINT DEFAULT 1 NOT NULL,
    `options` JSON,
    `created_at` TIMESTAMP NULL,
    `updated_at` TIMESTAMP NULL,
    PRIMARY KEY (`int_id`),
    UNIQUE INDEX `int_id` (`int_id`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
EOT;

        return array(
            'default' => $connection_default,
        );
    }

    /**
     * Get the SQL statements for the Down migration
     *
     * @return array list of the SQL strings to execute for the Down migration
     *               the keys being the datasources
     */
    public function getDownSQL()
    {
        $connection_default = <<< 'EOT'

# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `admin`;

DROP TABLE IF EXISTS `admin_session`;

DROP TABLE IF EXISTS `admin_history`;

DROP TABLE IF EXISTS `structure`;

DROP TABLE IF EXISTS `partner`;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
EOT;

        return array(
            'default' => $connection_default,
        );
    }

}