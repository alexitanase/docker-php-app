<?php


namespace App\Controllers\BackofficeController;


use MyCLabs\Enum\Enum;

/**
 * Class RequestTypeEnum
 * @package App\Controllers\BackofficeController
 * @method static RequestTypeEnum LOGIN()
 * @method static RequestTypeEnum LOGOUT()
 * @method static RequestTypeEnum ME()
 * @method static RequestTypeEnum SESSIONS()
 * @method static RequestTypeEnum SESSION_DETAILS()
 * @method static RequestTypeEnum AGENTS_LIST()
 * @method static RequestTypeEnum ADD_AGENT()
 * @method static RequestTypeEnum EDIT_AGENT()
 * @method static RequestTypeEnum STATUS_AGENT()
 * @method static RequestTypeEnum DELETE_AGENT()
 * @method static RequestTypeEnum STRUCTURES_LIST()
 * @method static RequestTypeEnum ADD_STRUCTURE()
 * @method static RequestTypeEnum EDIT_STRUCTURE()
 * @method static RequestTypeEnum STATUS_STRUCTURE()
 * @method static RequestTypeEnum DELETE_STRUCTURE()
 * @method static RequestTypeEnum PARTNERS_LIST()
 * @method static RequestTypeEnum ADD_PARTNER()
 * @method static RequestTypeEnum EDIT_PARTNER()
 * @method static RequestTypeEnum STATUS_PARTNER()
 * @method static RequestTypeEnum DELETE_PARTNER()
 * @method static RequestTypeEnum APPS_LIST()
 * @method static RequestTypeEnum INSTALL_APP()
 * @method static RequestTypeEnum UNINSTALL_APP()
 * @method static RequestTypeEnum EDIT_SECURITY()
 * @method static RequestTypeEnum INVALID()
 */
class RequestTypeEnum extends Enum
{
    //AUTH
    const LOGIN               = 1000;
    const LOGOUT              = 1001;
    const ME                  = 1002;
    const SESSIONS            = 1003;
    const SESSION_DETAILS     = 1004;
    
    //AGENTS
    const AGENTS_LIST         = 1010;
    const ADD_AGENT           = 1011;
    const EDIT_AGENT          = 1012;
    const STATUS_AGENT        = 1013;
    const DELETE_AGENT        = 1014;
    //
    const EDIT_SECURITY       = 1115;

    //STRUCTURES
    const STRUCTURES_LIST     = 1020;
    const ADD_STRUCTURE       = 1021;
    const EDIT_STRUCTURE      = 1022;
    const STATUS_STRUCTURE    = 1023;
    const DELETE_STRUCTURE    = 1024;
    
    //PARTNERS
    const PARTNERS_LIST       = 1025;
    const ADD_PARTNER         = 1026;
    const EDIT_PARTNER        = 1027;
    const STATUS_PARTNER      = 1028;
    const DELETE_PARTNER      = 1029;

    //APPLICATIONS/SERVICES
    const APPS_LIST           = 4000;
    const INSTALL_APP         = 4001;
    const UNINSTALL_APP       = 4002;

    //ERROR/INVALID
    const INVALID             = -1;
    
    public function __construct($value) {
        try {
            parent::__construct((int)$value);
        } catch (\Exception $e) {
            parent::__construct(self::INVALID);
        }
    }
}