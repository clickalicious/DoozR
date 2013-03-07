[BASE]
CONF_BASE_MODULES=purifier,xssfilter,smarty,crypt,cacher,filetool,session,security

[GZIP]
CONF_GZIP_ENABLED=true

[MAGIC_QUOTES]
CONF_MAGIC_QUOTES_GPC=Off

[CHARSET]
CONF_DEFAULT_CHARSET=UTF-8

[TIMEZONE]
CONF_TIMEZONE=Europe/Berlin

[DB]
CONF_DB_ENABLED=false
CONF_DB_DRIVER=mysql
CONF_DB_HOSTNAME=
CONF_DB_NAME=
CONF_DB_TBL_PREFIX=
CONF_DB_USER=
CONF_DB_PASSWORD=
CONF_DB_PCONNECT=false
CONF_DB_TRANSACTIONS=true

[SSL]
CONF_SSL_ENABLED=false

[PRIVATE_KEY]
CONF_PRIVATE_KEYPHRASE=

[SESSION]
CONF_SESSION_NAME=DoozR
CONF_SESSION_LIFETIME=1800
CONF_SESSION_HTTPONLY=true
CONF_SESSION_CRYPT=true
CONF_SESSION_CRYPT_MODE=1

[PHPSETTINGS]
CONF_UPLOAD_MAX_FILESIZE=30M
CONF_POST_MAX_SIZE=2047
CONF_MAX_EXECUTION_TIME=0
CONF_MEMORY_LIMIT=32M

[DEBUG]
CONF_DEBUG_ENABLED=true
CONF_LOGGER_ENABLED=true
CONF_DEBUG_LOG_UNCLASSIFIED=false
CONF_DEBUG_LOG_TO=sos
CONF_DEBUG_LOG_LEVEL=255
CONF_DEBUG_SOS_HOST=127.0.0.1
CONF_DEBUG_SOS_PORT=4444
CONF_DEBUG_SMARTY_ENABLED=false
CONF_DEBUG_SMARTY_COMPILECHECK=false

[ZIP]
CONF_ZIP_COMMENT=true
CONF_ZIP_STRING=zip - created with DoozR - downloaded at DoozR.de

[CACHE]
CONF_CACHE_SMARTY=false
CONF_CACHE_FILES=false
CONF_CACHE_FILER_PHP_LIFETIME=3600

[GARBAGE]
CONF_GC_LIFETIME=1800

[ADMIN]
CONF_ADMIN_USERNAME=
CONF_ADMIN_PASSWORD=
CONF_ADMIN_EMAIL=
