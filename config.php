<?php

define("DB_HOST", "localhost");
define("DB_NAME", "chkautomacao");
define("DB_USER", "root");
define("DB_PASSWORD", "");

$_SERVER ['DOCUMENT_ROOT'] = "C:/xampp/htdocs/chkList_old";

define ( "PATH", $_SERVER ['DOCUMENT_ROOT'] );


define ( "PATH_MODEL_BI", PATH . '/model/bi/' );
define ( "PATH_MODEL_DAO", PATH . '/model/dao/' );
define ( "PATH_MODEL_ENTITIES", PATH . '/model/entities/' );
define ( "PATH_CONTROLLER", PATH . '/controller/' );
define ( "PATH_INCLUDES", PATH . '/include/' );