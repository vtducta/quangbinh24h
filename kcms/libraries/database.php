<?php
/**    
 * Email : kph.acc@gmail.com
 * Yahoo : kph_kph@yahoo.com
 * Phone : +84902245620
 * 
 * Database class manager                                           
 *
 * @author         $Author: kenchan ak binhlt $
 * @copyright    (c) kenchan
 * @package        K-CMS
 * @since        Tue. 06th April 2010  
 *
 */              
 
class Database
{
    /**
    * Get connection from driver
    *
    * @access       public
    * @param        string      driver name         
    * @return       DBConnection
    */
    public static function GetConnect($driver = 'mysql')
    {                 
        $driver_file = $driver . '_driver.inc';
        $class_driver = $driver . '_' . 'driver'; 
        $extention = $driver . '_DBConnection';
                                               
        Loader::import(PATH_LIBRARIES_DATABASE_DIR . $driver_file);             

        $object = new $extention();      
        return $object;   
    }
}   

/**
 * Abstract database class
 */
abstract class DBConnection
{
    /**
     * DB object array
     *
     * @var         array
     */
    public $obj = array(    "sql_database"            => ""            ,
                            "sql_user"                => "root"        ,
                            "sql_pass"                => ""            ,
                            "sql_host"                => "localhost"    ,
                            "sql_port"                => ""            ,
                            "persistent"            => "0"            ,    
                            "cached_queries"        => array()        ,
                            'shutdown_queries'        => array()        ,                            
                            'use_shutdown'            => 1            ,
                            'query_cache_file'        => ''            ,
                            'force_new_connection'    => 0            ,
                            'error_log'                => ''            ,
                            'use_error_log'            => 0            ,   
                            'log_enable'               => 0             ,
                            'session_table'            => ""            ,
                            'log_path'                 => ""            , 
    );
    
    /**
     * Error message
     *
     * @var        string
     */
    public $error                 = "";
    
    /**
     * Error code
     *
     * @var     mixed
     */
    public $error_no            = 0;
    
    /**
     * Return error message or die inline
     *
     * @var     boolean
     */
    public $return_die        = false;
    
    /**
     * DB query failed
     *
     * @var     boolean
     */
    public $failed            = false;
    
    /**
     * Object reference to query cache file
     *
     * @var     object
     */
    protected $sql               = null;
    
    /**
     * Current sql query
     *
     * @var     string
     */
    protected $cur_query         = "";
    
    /**
     * Current DB query ID
     *
     * @var     resource
     */
    protected $query_id          = null;
    
    /**
     * Current DB connection ID
     *
     * @var     resource
     */
    protected $connection_id     = null;
    
    /**
     * Number of queries run so far
     *
     * @var     integer
     */
    public $query_count       = 0;
    
    /**
     * Escape / don't escape slashes during insert ops
     *
     * @var        boolean
     */
    public $manual_addslashes = false;
    
    /**
     * Is a shutdown query
     *
     * @var     boolean
     */
    protected $is_shutdown       = false;                                                       
    
    /**
     * DB record row
     *
     * @var     array
     */
    public $record_row        = array();
    
    /**
     * Extra classes loaded
     *
     * @var     array
     */
    public $loaded_classes    = array();
    
    /**
     * Optimization to stop querying the same loaded cache over and over
     *
     * @var        array
     */
    protected $_triedToLoadCacheFiles = array();
    
    /**
     * Connection variables set when installed
     *
     * @var     array
     */
    public $connect_vars      = array();
    
    /**
     * Over-ride guessed data types in insert/update ops
     *
     * @var     array
     */
    protected $_dataTypes   = array();
    
    /**
     * Select which fields aren't escaped during insert/update ops.  Set using preventAddSlashes()
     *
     * @var     array
     */
    protected $no_escape_fields  = array();
    
    /**
     * Classname of query cache file
     *
     * @var     string
     */
    public $sql_queries_name  = 'sql_queries';
    
    /**
     * SQL server version (human)
     *
     * @var     string
     */
    public $sql_version            = "";
    
    /**
     * SQL server version (long)
     *
     * @var     string
     */
    public $true_version        = 0;
    
    /**
     * Allow sub selects for this query
     *
     * @var     boolean
     */
    public $allow_sub_select = false;
    
    /**
     * Driver Class Name
     * 
     * @var        string
     */
    protected $usingClass = '';
    
    /**
     * Field encapsulation character
     *      
     * @var        string
     */
    public $fieldEncapsulate    = "'";
    
    /**
     * Field name encapsulation character
     * 
     * @var        string
     */
    public $fieldNameEncapsulate    = '';

    /**
     * Is running shut down queries
     * @var    boolean
     */
    private $_isShutDown = '';
    
    /**
     * Defend against unserialize vuln
     */
    public function __wakeup()
    {
        foreach( get_object_vars( $this ) as $k => $v )
        {
            $this->$k = null;
        }
        
        throw new Exception("Cannot unserialize this object");
    }
    
    /**
     * db_driver constructor
     *
     * @return    @e void
     */
    public function __construct()
    {
        //--------------------------------------------
        // Set up any required connect vars here:
        //--------------------------------------------
        
         $this->connect_vars = array();
    }
    
    /**
     * Global connect class
     *
     * @return    @e void
     */
    public function connect()
    {
        $this->usingClass   = strtolower( get_class( $this ) );
    }
    
    /**
     * Returns the currently formed SQL query
     *
     * @return    @e string
     */
    public function fetchSqlString()
    {
        return $this->cur_query;
    }
    
    /**
     * Turns table identity insert on/off
     *
     * @param    string        Table name
     * @param    string        On or Off
     * @return    @e string
     */
    public function setTableIdentityInsert( $tableName, $status='OFF' )
    {
    }
    
    /**
     * Force a column data type
     *
     * @param    mixed    $column    Column name, or an array of column names
     * @param    string    $type    Data type to use
     * @return    @e void
     */
    public function setDataType( $column, $type='string' )
    {
        if( is_array($column) )
        {
            foreach( $column as $_column )
            {
                $this->_dataTypes[ $_column ]    = $type;
            }
        }
        else
        {
            $this->_dataTypes[ $column ]    = $type;
        }
    }
    
    /**
     * Reset forced data types
     *
     * @return    @e void
     */
    public function resetDataTypes()
    {
        $this->_dataTypes    = array();
    }
    
    /**
     * Takes array of set commands and generates a SQL formatted query
     *
     * @param    array        Set commands (select, from, where, order, limit, etc)
     * @return    @e void
     */
    public function build( $data )
    {
        /* Inline build from cache files? Not all drviers may have a cache file.. */
        if ( $this->usingClass != 'db_driver_mysql' AND ( $data['queryKey'] AND $data['queryLocation'] AND $data['queryClass'] ) )
        { 
            if ( self::loadCacheFile( $data['queryLocation'], $data['queryClass'] ) === TRUE )
            {
                self::buildFromCache( $data['queryKey'], $data['queryVars'], $data['queryClass'] );
                return;
            }
        }
        
        if ( !empty($data['select']) )
        {
            $this->_buildSelect( $data['select'], $data['from'], isset($data['where']) ? $data['where'] : '', isset( $data['add_join'] ) ? $data['add_join'] : array(), isset( $data['calcRows'] ) ? $data['calcRows'] : '', $data['forceIndex'] );
        }
        
        if ( !empty($data['update']) )
        {
            $this->update( $data['update'], $data['set'], isset($data['where']) ? $data['where'] : '', false, true, isset( $data['add_join'] ) ? $data['add_join'] : array() );
            return;
        }
        
        if ( !empty($data['delete']) )
        {
            $this->delete( $data['delete'], $data['where'], $data['order'], $data['limit'], false );
            return;
        }
        
        if ( !empty($data['group']) )
        {
            $this->_buildGroupBy( $data['group'] );
        }
        
        if ( !empty($data['having']) )
        {
            $this->_buildHaving( $data['having'] );
        }     
        
        if ( !empty($data['order']) )
        {
            $this->_buildOrderBy( $data['order'] );
        }
        
        if ( isset( $data['calcRows'] ) AND $data['calcRows'] === TRUE )
        {
            $this->_buildCalcRows();
        }
        
        if ( isset($data['limit']) && is_array( $data['limit'] ) )
        {
            $this->_buildLimit( $data['limit'][0], $data['limit'][1] );
        }
    }
    
    /**
     * Build a query based on template from cache file
     *
     * @param    string        Name of query file method to use
     * @param    array        Optional arguments to be parsed inside query function
     * @param    string        Optional class name
     * @return    @e void
     */
    public function buildFromCache( $method, $args=array(), $class='sql_queries' )
    {
        $instance = null;
    
        if ( $class == 'sql_queries' and method_exists( $this->sql, $method ) )
        {
            $instance = $this->sql;
        }
        else if( $class != 'sql_queries' AND method_exists( $this->loaded_classes[ $class ], $method ) )
        {
            $instance = $this->loaded_classes[ $class ];
        }

        if ( $class == 'sql_queries' and !method_exists( $this->sql, $method ) )
        {
            if ( is_array( $this->loaded_classes ) )
            {
                foreach ( $this->loaded_classes as $class_name => $class_instance )
                {
                    if ( method_exists( $this->loaded_classes[ $class_name ], $method ) )
                    {
                        $instance = $this->loaded_classes[ $class_name ];
                        continue;
                    }
                }
            }
        }
        
        if( $instance )
        {
            $this->cur_query .= $instance->$method( $args );
        }
    }
    
    /**
     * Executes stored SQL query
     *
     * @return    @e resource
     */
    public function execute()
    {                                                  
        if ( $this->cur_query != "" )
        {
            $res = $this->query( $this->cur_query );
        }
        
        $this->cur_query       = "";
        $this->is_shutdown     = false;

        return $res;
    }
    
    /**
     * Stores a query for shutdown execution
     *
     * @return    @e mixed
     */
    public function executeOnShutdown()
    {
        if ( ! $this->obj['use_shutdown'] )
        {
            $this->is_shutdown         = true;
            return $this->execute();
        }
        else
        {
            $this->obj['shutdown_queries'][] = $this->cur_query;
            $this->cur_query = "";
        }
    }
    
    /**
     * Generates and executes SQL query, and returns the first result
     *
     * @param    array        Set commands (select, from, where, order, limit, etc)
     * @return    @e array
     */
    public function buildAndFetch( $data )
    {
        $this->build( $data );

        $res = $this->execute();
        
        if ( !empty($data['select']) )
        {
            return $this->fetch( $res );
        }
    }
    
     /**
     * Generates and executes SQL query, and returns the all results in an array
     *
     * @param    array        Set commands (select, from, where, order, limit, etc)
     * @param    string        Key to index array on (member_id, for example)
     * @return    @e array
     */
    public function buildAndFetchAll( $data, $arrayIndex=null )
    {
        $return = array();
        
        $this->build( $data );

        $res = $this->execute();
        
        if ( ! empty( $data['select'] ) )
        {
            while( $row = $this->fetch( $res ) )
            {
                if ( $arrayIndex !== null )
                {
                    if ( ! count( $return ) && ! array_key_exists( $arrayIndex, $row ) )
                    {
                        trigger_error( 'Index ' . $arrayIndex . ' not found in results' );
                    }
                    
                    $return[ $row[ $arrayIndex ] ] = $row;
                }
                else
                {
                    $return[] = $row;
                }
            }
        }
        
        return $return;
    }
    
    /**
     * Determine if query is shutdown and run it
     *
     * @param    string         Query
     * @param    boolean     [Optional] Run on shutdown
     * @return    @e mixed
     */
    protected function _determineShutdownAndRun( $query, $shutdown=false )
    {
        //-----------------------------------------
        // Shut down query?
        //-----------------------------------------   
        
        if ( $shutdown )
        {
            if ( ! $this->obj['use_shutdown'] )
            {
                $current_shutdown            = $this->is_shutdown;
                $this->is_shutdown             = true;
                $return                     = $this->query( $query );
                $this->is_shutdown             = $current_shutdown;
                return $return;
            }
            else
            {
                $this->obj['shutdown_queries'][] = $query;
                $this->cur_query                  = "";
            }
        }
        else
        {
            $return                     = $this->query( $query );
            return $return;
        }
    }

    /**
     * Test to see whether an index exists in a table
     *
     * @param    string        Index name
     * @param    string        Table name
     * @return    @e boolean
     */
    public function checkForIndex( $index, $table )
    {
        return false;
    }
    
    /**
     * Test to see whether a field exists in a table
     *
     * @param    string        Field name
     * @param    string        Table name
     * @return    @e boolean
     */
    public function checkForField( $field, $table )
    {
        $current            = $this->return_die;
        $this->return_die     = true;
        $this->error          = "";
        
        $this->build( array( 'select' => "COUNT({$field}) as count", 'from' => $table ) );
        $this->execute();
        
        $return = true;
        
        if ( $this->failed )
        {
            $return = false;
        }
        
        $this->error        = "";
        $this->return_die    = $current;
        $this->error_no       = 0;
        $this->failed         = false;
        
        return $return;
    }   
    
    /**
     * Returns current number queries run
     *
     * @return    @e integer
     */
    public function getQueryCount()
    {
        return $this->query_count;
    }
    
    /**
     * Flushes the currently queued query
     *
     * @return    @e void
     */
    public function flushQuery()
    {
        $this->cur_query = "";
    }                   
    
    /**
     * Has loaded cache file
     *
     * @param    string         Classname
     * @return    @e boolean
     */
    public function hasLoadedCacheFile( $classname )
    {
        if ( isset( $this->loaded_classes[ $classname ] ) )
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    
    /**
     * Load extra SQL query file
     *
     * @param    string         File name
     * @param    string         Classname of file
     * @param    boolean        Ignore missing files, FALSE $this->error is set, TRUE, nothing happens.
     * @return    @e boolean
     */
    public function loadCacheFile( $filepath, $classname, $ignoreMissing=FALSE )
    {
        /* Tried to load this already? */
        if ( ! isset( $this->_triedToLoadCacheFiles[ $classname ] ) )
        {
            /* Try and load it */
            if ( ! is_file( $filepath ) AND $ignoreMissing === FALSE )
            {
                $this->error    = "Cannot locate {$filepath} - exiting!";

                $this->_triedToLoadCacheFiles[ $classname ] = FALSE;
            }
            else if ( $this->hasLoadedCacheFile( $classname ) !== TRUE )
            {
                require_once( $filepath );/*noLibHook*/
            
                if( class_exists( $classname ) )
                {
                    $this->loaded_classes[ $classname ] = new $classname( $this );
                
                    $this->_triedToLoadCacheFiles[ $classname ] = TRUE;
                }
            }
        }

        return $this->_triedToLoadCacheFiles[ $classname ];
    }
    
    /**
     * Returns a portion of a WHERE query suitable for use.
     * Specific to tables with a field that has a comma separated list of IDs.
     *
     * @param    array        Array of perm IDs
     * @param    string        DB field to search in
     * @param    boolean        check for '*' in the field to denote 'global'
     * @return    @e string
     */
    public function buildWherePermission( array $ids, $field='', $incStarCheck=true )
    {
        /* Just use a LIKE chain for items without a specific implementation */
        $where = '(' . $this->buildLikeChain( $field, $ids ) . ')';
        
        if ( $incStarCheck === true )
        {
            $where .= ' OR ( ' . $field . '=\'*\' )';
        }
        
        return "( " . $where . " )";
    }
    
    /**
     * Load Query cache file
     *
     * @return    @e void
     */
    protected function _loadCacheFile()
    {
        if ( $this->obj['query_cache_file'] )
         {
             require_once( $this->obj['query_cache_file'] );/*noLibHook*/
         
            $sql_queries_name = $this->sql_queries_name ? $this->sql_queries_name : 'sql_queries';

             $this->sql = new $sql_queries_name( $this );
         }
    }

    /**
     * Set fields that shouldn't be escaped
     *
     * @param    array         SQL table fields
     * @return    @e void
     */
    public function preventAddSlashes( $fields=array() )
    {
        $this->no_escape_fields = $fields;
    }
    
    /**
     * Compiles SQL fields for insertion
     *
     * @param    array        Array of field => value pairs
     * @return    @e array
     */
    public function compileInsertString( $data )
    {
//var_dump($data);
//die();
        $field_names    = "";
        $field_values    = "";

        foreach( $data as $k => $v )
        {
	   //  if($v==null)
	//	continue;	
            $add_slashes = 1;
            
            if ( $this->manual_addslashes )
            {
                $add_slashes = 0;
            }
            
            if ( !empty($this->no_escape_fields[ $k ]) )
            {
                $add_slashes = 0;
            }
            
            if ( $add_slashes )
            {
                $v = $this->addSlashes( $v );
            }
            
            $field_names  .= $this->fieldNameEncapsulate . "$k" . $this->fieldNameEncapsulate . ',';
            
            //-----------------------------------------
            // Forcing data type?
            //-----------------------------------------
            
            if ( substr( $v, -1 ) == '\\' )
            {
                $v = preg_replace( '#\\\{1}$#', '&#92;', $v );
            }
                    
            if ( !empty($this->_dataTypes[ $k ]) )
            {
                if ( $this->_dataTypes[ $k ] == 'string' )
                {
                    $field_values .= $this->fieldEncapsulate . $v . $this->fieldEncapsulate . ',';
                }
                else if ( $this->_dataTypes[ $k ] == 'int' )
                {
                    $field_values .= intval($v).",";
                }
                else if ( $this->_dataTypes[ $k ] == 'float' )
                {
                    $field_values .= floatval($v).",";
                }
                if ( $this->_dataTypes[ $k ] == 'null' )
                {
                    $field_values .= "NULL,";
                }
            }
            
            //-----------------------------------------
            // No? best guess it is then..
            //-----------------------------------------
            
            else
            {
                if ( is_numeric( $v ) and strcmp( intval($v), $v ) === 0 )
                {
                    $field_values .= $v.",";
                }
                else
                {
                    $field_values .= $this->fieldEncapsulate . $v . $this->fieldEncapsulate . ',';
                }
            }
        }
        
        $field_names  = rtrim( $field_names, ","  );
        $field_values = rtrim( $field_values, "," );
//var_dump($data);
//echo $field_names;echo "<br>";
//echo $field_values;
//die();
    
        return array( 'FIELD_NAMES'  => $field_names,
                      'FIELD_VALUES' => $field_values,
                    );
    }
    
    /**
     * Compiles SQL fields for update query
     *
     * @param    array        Array of field => value pairs
     * @return    @e string
     */
    public function compileUpdateString( $data )
    {
        $return_string = "";
        
        foreach( $data as $k => $v )
        {
            //-----------------------------------------
            // Adding slashes?
            //-----------------------------------------
            
            $add_slashes = 1;
            
            if ( $this->manual_addslashes )
            {
                $add_slashes = 0;
            }
            
            if ( !empty($this->no_escape_fields[ $k ]) )
            {
                $add_slashes = 0;
            }
            
            if ( $add_slashes )
            {
                $v = $this->addSlashes( $v );
            }
            
            //-----------------------------------------
            // Forcing data type?
            //-----------------------------------------
            
            if ( !empty($this->_dataTypes[ $k ]) )
            {
                if ( $this->_dataTypes[ $k ] == 'string' )
                {
                    if ( substr( $v, -1 ) == '\\' )
                    {
                        $v = preg_replace( '#\\\{1}$#', '&#92;', $v );
                    }
            
                    $return_string .= $k . '=' . $this->fieldEncapsulate . $v . $this->fieldEncapsulate . ',';
                }
                else if ( $this->_dataTypes[ $k ] == 'int' )
                {
                    if ( strstr( $v, 'plus:' ) )
                    {
                        $return_string .= $k . "=" . $k . '+' . intval( str_replace( 'plus:', '', $v ) ).",";
                    }
                    else if ( strstr( $v, 'minus:' ) )
                    {
                        $return_string .= $k . "=" . $k . '-' . intval( str_replace( 'minus:', '', $v ) ).",";
                    }
                    else
                    {
                        $return_string .= $k . "=" . intval($v) . ",";
                    }
                }
                else if ( $this->_dataTypes[ $k ] == 'float' )
                {
                    $return_string .= $k . "=" . floatval($v) . ",";
                }
                else if ( $this->_dataTypes[ $k ] == 'null' )
                {
                    $return_string .= $k . "=NULL,";
                }
            }
            
            //-----------------------------------------
            // No? best guess it is then..
            //-----------------------------------------
            
            else
            {
                if ( is_numeric( $v ) and strcmp( intval($v), $v ) === 0 )
                {
                    $return_string .= $k . "=" . $v . ",";
                }
                else
                {
                    if ( substr( $v, -1 ) == '\\' )
                    {
                        $v = preg_replace( '#\\\{1}$#', '&#92;', $v );
                    }
                    
                    $return_string .= $k . '=' . $this->fieldEncapsulate . $v . $this->fieldEncapsulate . ',';
                }
            }
        }
        
        $return_string = rtrim( $return_string, "," );

        return $return_string;
    }
    
    /**
     * Remove quotes from a DB query
     *
     * @param    string        Raw text
     * @return    @e string
     */
    protected function _removeAllQuotes( $t )
    {
        //-----------------------------------------
        // Remove quotes
        //-----------------------------------------
        
        $t = preg_replace( "#\\\{1,}[\"']#s", "", $t );
        $t = preg_replace( "#'[^']*'#s"    , "", $t );
        $t = preg_replace( "#\"[^\"]*\"#s" , "", $t );
        $t = preg_replace( "#\"\"#s"        , "", $t );
        $t = preg_replace( "#''#s"          , "", $t );

        return $t;
    }
    
    /**
     * Build order by clause
     *
     * @param    string        Order by clause
     * @return    @e void
     */
    abstract protected function _buildOrderBy( $order );

    /**
     * Build having clause
     *
     * @param    string        Having clause
     * @return    @e void
     */
    abstract protected function _buildHaving( $having_clause );
    
    /**
     * Build group by clause
     *
     * @param    string        Group by clause
     * @return    @e void
     */
    abstract protected function _buildGroupBy( $group );

    /**
     * Build limit clause
     *
     * @param    integer        Start offset
     * @param    integer        [Optional] Number of records
     * @return    @e void
     */
    abstract protected function _buildLimit( $offset, $limit=0 );
    
    /**
     * Build select statement
     *
     * @param    string        Columns to retrieve
     * @param    string        Table name
     * @param    string        [Optional] Where clause
     * @param    array         [Optional] Joined table data
     * @param    array        [Optional] Force index
     * @return    @e void
     */
    abstract protected function _buildSelect( $get, $table, $where, $add_join=array(), $calcRows=FALSE, $forceIndex=array() );
    
    /**
     * Generates calc rows in the query if supported / runs count(*) if not
     *
     * @return    @e void        Sets $this->_calcRows
     */
    abstract protected function _buildCalcRows();

    /**
     * Prints SQL error message
     *
     * @param    string        Additional error message
     * @return    @e mixed
     */
    public function throwFatalError( $the_error='' )
    {   
        //-----------------------------------------
        // INIT
        //-----------------------------------------

        $this->error    = $this->_getErrorString();        
        $this->error_no    = $this->_getErrorNumber();  
        
        $_debug   = debug_backtrace();
        $_dString = '';

        if ( is_array( $_debug ) and count( $_debug ) )
        {
            foreach( $_debug as $idx => $data )
            {
                if ( $data['class'] == 'DBConnection' OR $data['class'] == 'Mysql_DBConnection' OR $data['class'] == 'Mysqli_DBConnection' )
                {
                    continue;
                }
                
                $_dbString[ $idx ] = array( 'file'     => $data['file'],
                                            'line'     => $data['line'],
                                            'function' => $data['function'],
                                            'class'    => $data['class'] );
            }
        }            
        
        $remote_addr = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';
        $request_uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
        
        $_error_string  = "\n ------------------------------------------------------------------------------------------";
        $_error_string .= "\n Date: ". date( 'r' );
        $_error_string .= "\n Error: " . $this->error_no . ' - ' . $this->error;
        $_error_string .= "\n IP Address: " . $remote_addr . ' - ' . $request_uri;
        $_error_string .= "\n ------------------------------------------------------------------------------------------";
        $_error_string .= "\n " . $the_error;
        $_error_string .= "\n .----------------------------------------------------------------------------------------.";
        
        if ( count( $_dbString ) )
        {                                                                                             
            $_error_string .= "\n | File                                                      | Function                          | Line No.          |";
            $_error_string .= "\n |-----------------------------------------------------------+-----------------------------------+-------------------|";
            
            foreach( $_dbString as $i => $data )
            {     
                /* Reset */
                $data['func'] = "[" . $data['class'] . '].' . $data['function'];
                
                /* Pad right */
                $data['file'] = str_replace(realpath(PATH_ROOT),'',$data['file']);
                $data['file'] = str_replace(realpath(PATH_APP_ROOT),'',$data['file']);
                $data['file'] = str_replace(realpath(PATH_APP_BASE),'',$data['file']);
                
                $data['file'] = str_pad( $data['file'], 58 );
                $data['func'] = str_pad( $data['func'], 34 );
                $data['line'] = str_pad( $data['line'], 18 );
                
            $_error_string .= "\n | " . $data['file'] . "| " . $data['func'] . '| ' . $data['line'] . '|';
            $_error_string .= "\n '-----------------------------------------------------------+-----------------------------------+-------------------'";
            }
        }
          
        if ( $this->return_die == true )
        {
            $this->error  = ( $this->error == "" ? $the_error : $this->error );
            $this->failed = true;
            return;
        }
        else if ( $this->obj['use_error_log'] AND $this->obj['error_log'] )
        {
            if ( $FH = @fopen( $this->obj['error_log'], 'a' ) )
            {
                @fwrite( $FH, $_error_string );
                @fclose( $FH );
            }
             
            /* Write to latest log also */
            if ( is_dir( PATH_APP_SQLERROR ) )
            {
                @file_put_contents( PATH_APP_SQLERROR . '/sql_error_latest.cgi', trim( $_error_string ) );
            }
            
            if ( isset( $_SERVER['SERVER_PROTOCOL'] ) AND strstr( $_SERVER['SERVER_PROTOCOL'], '/1.0' ) )
            {
                @header( "HTTP/1.0 503 Service Unavailable" );
            }
            else
            {
                @header( "HTTP/1.1 503 Service Unavailable" );
            }                  
        }
        else
        {
            $the_error .= "\n\nSQL error: ".$this->error."\n";
            $the_error .= "SQL error code: ".$this->error_no."\n";
            $the_error .= "Date: ".date("l dS F Y h:i:s A");
            $the_error .= "\n\n" . $_error_string;
            
            if ( isset( $_SERVER['SERVER_PROTOCOL'] ) AND strstr( $_SERVER['SERVER_PROTOCOL'], '/1.0' ) )
            {
                @header( "HTTP/1.0 503 Service Unavailable" );
            }
            else
            {
                @header( "HTTP/1.1 503 Service Unavailable" );
            }   
                    
            
            print "<html><head><title>KCMS SQL Error</title>
                       <style>P,BODY{ font-family:arial,sans-serif; font-size:11px; }</style></head><body>
                       <blockquote><h1>KCMS SQL Error</h1><b>There appears to be an error with the database.</b><br>
                       You can try to refresh the page by clicking <a href=\"javascript:window.location=window.location;\">here</a>.
                       <br><br><b>Error Returned</b><br>
                       <form name='mysql'><textarea style='width:1000px;height:600px'>".htmlspecialchars($the_error)."</textarea></form>
                       <br>We apologise for any inconvenience</blockquote></body></html>";
            
        }
                                                 
        $this->cur_query    = '';
        
        exit();
    }            
    
    /**
     * Return an object handle for a loaded class
     *
     * @param    string         Class to return
     * @return    @e object
     */
    public function fetchLoadedClass( $class )
    {
        return ( is_object( $this->loaded_classes[ $class ] ) ) ? $this->loaded_classes[ $class ] : NULL;
    }
    
    /**
     * Get SQL error number
     *
     * @return    @e mixed
     */
    abstract protected function _getErrorNumber();
    
    /**
     * Get SQL error message
     *
     * @return    @e string
     */
    abstract protected function _getErrorString();
        
    /**
     * db_driver destructor: Runs shutdown queries and closes connection
     *
     * @return    @e void
     */
    public function __destruct()
    {
        $this->return_die  = true;
        $this->_isShutDown = true;
        
        if ( count( $this->obj['shutdown_queries'] ) )
        {
            foreach( $this->obj['shutdown_queries'] as $q )
            {
                $this->query( $q );
            }
        }                  
        $this->obj['shutdown_queries'] = array();
        
        $this->disconnect();
    }
}  

if( !defined('REPLACE_TYPE') )
{
    define( 'REPLACE_TYPE', 2 );
}

abstract class DBMysqlConnection extends DBConnection
{
    /**
    * Cached field names in table
    *
    * @var         array
    */
    protected $cached_fields        = array();

    /**
    * Cached table names in database
    *
    * @var         array
    */
    protected $cached_tables        = array();

    /**
    * Field name encapsulation character
    *
    * @var        string
    */
    public $fieldNameEncapsulate    = '`';

    /**
    * Return the connection ID
    *
    * @return    @e resource
    */
    public function getConnectionId()
    {
        return $this->connection_id;
    }
    
    public function log_query($query,$table = "sessions"){
        if ($table == $this->obj['session_table']){
            return ;
        }
        if ($this->obj['log_enable']){
            $file_name = $this->obj['log_path'] . "sqllog_" . date('Y')."_". date('m').'_'. date('d');
            file_put_contents($file_name, $query . ";\n", FILE_APPEND | LOCK_EX);
        }
    }

    /**
    * Delete data from a table
    *
    * @param    string         Table name
    * @param    string         [Optional] Where clause
    * @param    string        [Optional] Order by
    * @param    array        [Optional] Limit clause
    * @param    boolean        [Optional] Run on shutdown
    * @return    @e resource
    */
    public function delete( $table, $where='', $orderBy='', $limit=array(), $shutdown=false )
    {
        if ( ! $where )
        {
            $this->cur_query = "TRUNCATE TABLE " . $table;
        }
        else
        {
            $this->cur_query = "DELETE FROM " . $table . " WHERE " . $where;
        }

        if ( $where AND $orderBy )
        {
            $this->_buildOrderBy( $orderBy );
        }

        if ( $where AND $limit AND is_array( $limit ) )
        {
            $this->_buildLimit( $limit[0], $limit[1] );
        }

        $result    = $this->_determineShutdownAndRun( $this->cur_query, $shutdown );

        $this->log_query($this->cur_query,$table);
        $this->cur_query    = '';

        return $result;
    }

    /**
    * Update data in a table
    *
    * @param    string         Table name
    * @param    mixed         Array of field => values, or pre-formatted "SET" clause
    * @param    string         [Optional] Where clause
    * @param    boolean        [Optional] Run on shutdown
    * @param    boolean        [Optional] $set is already pre-formatted
    * @param    array         [Optional] Joined table data
    * @return    @e resource
    */
    public function update( $table, $set, $where='', $shutdown=false, $preformatted=false, $add_join=array() )
    {
        //-----------------------------------------
        // Normal
        //-----------------------------------------

        if ( empty( $add_join ) )
        {
            /* Compile the update clause */
            $dba   = $preformatted ? $set : $this->compileUpdateString( $set );

            /* Put it together */
            $query = "UPDATE " . $table . " SET " . $dba;

            /* Add in a where clause if necessary (we don't want to something silly like delete all the tickets...) */
            if ( $where )
            {
                $query .= " WHERE " . $where;
            }
        }

        //-----------------------------------------
        // With joins
        //-----------------------------------------

        else
        {
            //-----------------------------------------
            // OK, here we go...
            //-----------------------------------------

            $from_array     = array();
            $joinleft_array = array();
            $where_array    = array();
            $final_from     = array();
            $from_array[]   = $table;
            $hasLeft        = false;
            $hasInner        = false;

            if ( $where )
            {
                $where_array[]  = $where;
            }

            //-----------------------------------------
            // Loop through JOINs and sort info
            //-----------------------------------------

            if ( is_array( $add_join ) and count( $add_join ) )
            {
                foreach( $add_join as $join )
                {
                    if ( ! is_array( $join ) )
                    {
                        continue;
                    }

                    if ( empty($join['type']) OR $join['type'] == 'left' )
                    {
                        $hasLeft = true;
                        # Join is left or not specified (assume left)
                        $tmp = " LEFT JOIN ";

                        foreach( $join['from'] as $tbl => $alias )
                        {
                            $tmp .=  $tbl.' '.$alias;
                        }

                        if ( $join['where'] )
                        {
                            $tmp .= " ON ( ".$join['where']." ) ";
                        }

                        $joinleft_array[] = $tmp;

                        unset( $tmp );
                    }
                    else if ( $join['type'] == 'inner' )
                        {
                            $hasInner = true;

                            # Join is inline
                            $from_array[]  = $join['from'];

                            if ( $join['where'] )
                            {
                                $where_array[] = $join['where'];
                            }
                    }
                    else
                    {
                        # Not using any other type of join
                    }
                }
            }

            //-----------------------------------------
            // Build it..
            //-----------------------------------------

            foreach( $from_array as $i )
            {
                foreach( $i as $tbl => $alias )
                {
                    $final_from[] = $tbl . ' ' . $alias;
                }
            }

            $table   = ( $hasLeft === true && $hasInner === true ) ? '(' . implode( ",", $final_from ) . ')' : implode( ",", $final_from );
            $where   = implode( " AND " , $where_array    );
            $join    = implode( "\n"    , $joinleft_array );

            $query = "UPDATE {$table}";

            if ( $join )
            {
                $query .= " " . $join . " ";
            }

            $query .= "SET " . ( $preformatted ? $set : $this->compileUpdateString( $set ) );

            if ( $where != "" )
            {
                $query .= " WHERE " . $where;
            }
        }

        //-----------------------------------------
        // Run
        //-----------------------------------------
        $this->log_query($query,$table);
        return $this->_determineShutdownAndRun( $query, $shutdown );
    }

    /**
    * Insert data into a table
    *
    * @param    string         Table name
    * @param    array         Array of field => values
    * @param    boolean        Run on shutdown
    * @return    @e resource
    */
    public function insert( $table, $set, $shutdown=false )
    {
        //-----------------------------------------
        // Form query
        //-----------------------------------------

        $dba   = $this->compileInsertString( $set );

        $query = "INSERT INTO " . $table . " ({$dba['FIELD_NAMES']}) VALUES({$dba['FIELD_VALUES']})";
        $this->log_query($query,$table);
        return $this->_determineShutdownAndRun( $query, $shutdown );
    }

    /**
    * Insert record into table if not present, otherwise update existing record
    *
    * @param    string         Table name
    * @param    array         Array of field => values     
    * @param    boolean        [Optional] Run on shutdown
    * @return    @e resource
    */
    public function replace( $table, $set, $shutdown=false )
    {
        //-----------------------------------------
        // Form query
        //-----------------------------------------

        $dba    = $this->compileInsertString( $set );

        if( REPLACE_TYPE == 1 OR $this->getSqlVersion() < 41000 )
        {
            $query    = "REPLACE INTO " . $table . " ({$dba['FIELD_NAMES']}) VALUES({$dba['FIELD_VALUES']})";
        }
        else
        {
            //$dbb    = $this->compileUpdateString( $set );
            $dbb    = array();

            foreach( $set as $k => $v )
            {
                $dbb[]    = "{$k}=VALUES({$k})";
            }

            $dbb    = implode( ',', $dbb );

            $query    = "INSERT INTO " . $table . " ({$dba['FIELD_NAMES']}) VALUES({$dba['FIELD_VALUES']}) ON DUPLICATE KEY UPDATE " . $dbb;
        }
        $this->log_query($query,$table);
        return $this->_determineShutdownAndRun( $query, $shutdown );
    }

    /**
    * Kill a thread
    *
    * @param    integer     Thread ID
    * @return    @e resource
    */
    public function kill( $threadId )
    {
        return $this->query( "KILL {$threadId}" );
    }

    /**
    * Subqueries supported by driver?
    *
    * @return    @e boolean
    */
    public function checkSubquerySupport()
    {
        $this->getSqlVersion();

        if ( $this->sql_version >= 41000 )
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    /**
    * Fulltext searching supported by driver?
    *
    * @return    @e boolean
    */
    public function checkFulltextSupport()
    {
        $this->getSqlVersion();

        if ( $this->sql_version >= 32323 AND strtolower($this->connect_vars['mysql_tbl_type']) == 'myisam' )
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    /**
    * Boolean fulltext searching supported by driver?
    *
    * @return    @e boolean
    */
    public function checkBooleanFulltextSupport()
    {
        $this->getSqlVersion();

        if ( $this->sql_version >= 40010 AND strtolower($this->connect_vars['mysql_tbl_type']) == 'myisam' )
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    /**
    * Test to see whether an index exists in a table
    *
    * @param    string        Index name
    * @param    string        Table name
    * @return    @e boolean
    */
    public function checkForIndex( $index, $table )
    {
        $current            = $this->return_die;
        $this->return_die     = true;
        $this->error          = "";
        $return               = false;
        $indexes            = array();

        $q = $this->query( "SHOW INDEX FROM " . $table );

        if ( $q AND $this->getTotalRows($q) )
        {
            while( $check = $this->fetch($q) )
            {
                $indexes[ $check['Key_name'] ] = $check['Key_name'];
            }
        }

        $this->error        = "";
        $this->return_die    = $current;
        $this->error_no       = 0;
        $this->failed         = false;

        return ( in_array( $index, $indexes ) ) ? true : false;
    }

    /**
    * Test to see whether a field exists in a table
    *
    * @param    string        Field name
    * @param    string        Table name
    * @return    @e boolean
    */
    public function checkForField( $field, $table )
    {
        if( isset($this->cached_fields[ $table ]) )
        {
            if( in_array( $field, $this->cached_fields[ $table ] ) )
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        $current            = $this->return_die;
        $this->return_die     = true;
        $this->error          = "";
        $return               = false;

        $q = $this->query( "SHOW fields FROM " . $table );

        if( $q AND $this->getTotalRows($q) )
        {
            while( $check = $this->fetch($q) )
            {
                $this->cached_fields[ $table ][] = $check['Field'];
            }
        }

        if ( !$this->failed AND in_array( $field, $this->cached_fields[ $table ] ) )
        {
            $return = true;
        }

        $this->error        = "";
        $this->return_die    = $current;
        $this->error_no       = 0;
        $this->failed         = false;

        return $return;
    }

    /**
    * Drop database table
    *
    * @param    string        Table to drop
    * @return    @e resource
    */
    public function dropTable( $table )
    {
        return $this->query( "DROP TABLE IF EXISTS " .$table );
    }

    /**
    * Drop field in database table
    *
    * @param    string        Table name
    * @param    string        Field to drop
    * @return    @e resource
    */
    public function dropField( $table, $field )
    {
        return $this->query( "ALTER TABLE " . $table . " DROP " . $field );
    }

    /**
    * Add field to table in database
    *
    * @param    string        Table name
    * @param    string        Field to add
    * @param    string        Field type
    * @param    string        [Optional] Default value
    * @return    @e resource
    */
    public function addField( $table, $field, $type, $default=NULL )
    {
        $default = $default !== NULL ? "DEFAULT {$default}" : 'NULL';

        return $this->query( "ALTER TABLE " . $table . " ADD {$field} {$type} {$default}" );
    }

    /**
    * Add index to database column
    *
    * @param    string        Table name        table
    * @param    string        Index name        multicol
    * @param    string        Fieldlist        col1, col2
    * @param    bool        Is primary key?
    * @return    @e resource
    */
    public function addIndex( $table, $name, $fieldlist, $isPrimary=false )
    {
        $fieldlist = ( $fieldlist ) ? $fieldlist : $name;

        if ( $isPrimary )
        {
            return $this->query( "ALTER TABLE " . $table . " ADD PRIMARY KEY  ( " . $fieldlist . ' )' );
        }
        else
        {
            return $this->query( "ALTER TABLE " . $table . " ADD INDEX " . $name . ' ( ' . $fieldlist . ' )' );
        }
    }

    /**
    * Change field in database table
    *
    * @param    string        Table name
    * @param    string        Existing field name
    * @param    string        New field name
    * @param    string        Field type
    * @param    string        [Optional] Default value
    * @return    @e resource
    */
    public function changeField( $table, $old_field, $new_field, $type='', $default=NULL )
    {
        $default = $default !== NULL ? "DEFAULT {$default}" : 'NULL';

        return $this->query( "ALTER TABLE " . $table . " CHANGE {$old_field} {$new_field} {$type} {$default}" );
    }

    /**
    * Optimize database table
    *
    * @param    string        Table name
    * @return    @e resource
    */
    public function optimize( $table )
    {
        return $this->query( "OPTIMIZE TABLE " . $table );
    }

    /**
    * Add fulltext index to database column
    *
    * @param    string        Table name
    * @param    string        Field name
    * @return    @e mixed
    */
    public function addFulltextIndex( $table, $field )
    {
        if( $this->checkFulltextSupport() )
        {
            return $this->query( "ALTER TABLE " . $table . " ADD FULLTEXT({$field})" );
        }
        else
        {
            return null;
        }
    }

    /**
    * Get table schematic
    *
    * @param    string        Table name
    * @return    @e array
    */
    public function getTableSchematic( $table )
    {
        $current            = $this->return_die;
        $this->return_die     = true;

        $qid = $this->query( "SHOW CREATE TABLE " . $table );

        $this->return_die     = $current;

        if( $qid )
        {
            return $this->fetch($qid);
        }
        else
        {
            return array();
        }
    }

    /**
    * Get array of field names in table
    *
    * @param    string        Table name
    * @return    @e array
    */
    public function getFieldNames( $table )
    {
        //-----------------------------------------
        // Inline field name caching
        //-----------------------------------------

        static $_fields        = array();

        if( count($_fields[ $table ]) )
        {
            return $_fields[ $table ];
        }

        $current            = $this->return_die;
        $this->return_die     = true;

        $qid = $this->query( "SHOW FIELDS FROM " . $table );

        $this->return_die     = $current;

        if( $qid )
        {
            while( $r = $this->fetch($qid) )
            {
                $_fields[ $table ][]    = $r['Field'];
            }

            return $_fields[ $table ];
        }
        else
        {
            return array();
        }
    }

    /**
    * Determine if table already has a fulltext index
    *
    * @param    string        Table name
    * @return    @e boolean
    */
    public function getFulltextStatus( $table )
    {
        $result = $this->getTableSchematic( $table );

        if ( preg_match( "/FULLTEXT KEY/i", $result['Create Table'] ) )
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    /**
    * Build order by clause
    *
    * @param    string        Order by clause
    * @return    @e void
    */
    protected function _buildOrderBy( $order )
    {
        if ( $order )
        {
            $this->cur_query .= ' ORDER BY ' . $order;
        }
    }

    /**
    * Build group by clause
    *
    * @param    string        Having clause
    * @return    @e void
    */
    protected function _buildHaving( $having_clause )
    {
        if ( $having_clause )
        {
            $this->cur_query .= ' HAVING ' . $having_clause;
        }
    }

    /**
    * Build having clause
    *
    * @param    string        Group by clause
    * @return    @e void
    */
    protected function _buildGroupBy( $group )
    {
        if ( $group )
        {
            $this->cur_query .= ' GROUP BY ' . $group;
        }
    }

    /**
    * Build limit clause
    *
    * @param    integer        Start offset
    * @param    integer        [Optional] Number of records
    * @return    @e void
    */
    protected function _buildLimit( $offset, $limit=0 )
    {
        //-----------------------------------------
        // INIT
        //-----------------------------------------

        $offset = intval( $offset );
        $offset = ( $offset < 0 ) ? 0 : $offset;
        $limit  = intval( $limit );

        if ( $limit > 0)
        {
            $this->cur_query .= ' LIMIT ' . $offset . ',' . $limit;
        }
        else
        {
            //$this->cur_query .= ' LIMIT ' . $offset;
        }
    }

    /**
    * Build concat string
    *
    * @param    array        Array of data to concat
    * @return    @e string
    */
    public function buildConcat( $data )
    {
        $return_string = '';

        if( is_array($data) AND count($data) )
        {
            $concat = array();

            foreach( $data as $databit )
            {
                $concat[] = $databit[1] == 'string' ? "'" . $databit[0] . "'" : $databit[0];
            }

            if( count($concat) )
            {
                $return_string = "CONCAT(" . implode( ',', $concat ) . ")";
            }
        }

        return $return_string;
    }

    /**
    * Build CAST string
    *
    * @param    string        Value to CAST
    * @param    string        Type to cast to
    * @return    @e string
    */
    public function buildCast( $data, $columnType )
    {
        /* mySQL does not support casting as VARCHAR, but it isn't needed either */
        if( $columnType == 'VARCHAR' )
        {
            return $data;
        }

        return "CAST( {$data} AS {$columnType} )";
    }

    /**
    * Build between statement
    *
    * @param    string        Column
    * @param    integer        Value 1
    * @param    integer        Value 2
    * @return    @e string
    */
    public function buildBetween( $column, $value1, $value2 )
    {
        return "{$column} BETWEEN {$value1} AND {$value2}";
    }

    /**
    * Build regexp string (ONLY supports a regexp equivalent of "or field like value")
    *
    * @param    string        Database column
    * @param    array        Array of values to allow
    * @return    @e string
    */
    public function buildRegexp( $column, $data )
    {
        return "{$column} REGEXP '," . implode( ',|,', $data ) . ',|\\\*\'';
    }

    /**
    * Build LIKE CHAIN string (ONLY supports a regexp equivalent of "or field like value")
    *
    * @param    string        Database column
    * @param    array        Array of values to allow
    * @param    boolean        Treat numerically
    * @return    @e string
    */
    public function buildLikeChain( $column, $data, $isNumerical=true )
    {
        $return = $column . "='*'";
        $comma  = ',';

        if ( ! is_array( $data ) )
        {
            return '1=1';
        }

        if ( ! $isNumerical )
        {
            $comma  = '';
            $first  = array_shift( $data );
            $return = $column . ' LIKE \'%' . $first . '%\'';
        }

        foreach( $data as $id )
        {
            $return .= " OR " . $column . " LIKE '%" . $comma . $id . $comma . "%'";
        }

        return $return;
    }

    /**
    * Returns a portion of a WHERE query suitable for use.
    * Specific to tables with a field that has a comma separated list of IDs.
    *
    * @param    array        Array of perm IDs
    * @param    string        DB field to search in
    * @param    boolean        check for '*' in the field to denote 'global'
    * @return    @e mixed
    */
    public function buildWherePermission( array $ids, $field='', $incStarCheck=true )
    {
        /* Just use a LIKE chain for items without a specific implementation */
        $where = '( ';
        $_or   = array();

        foreach( $ids as $i )
        {
            if ( ! $i )
            {
                continue;
            }

            if ( is_numeric( $i ) )
            {
                $_or[] = "FIND_IN_SET(" . $i . "," . $field . ")";
            }
        }

        if ( count( $_or ) )
        {
            $where .= '( ' . implode( " OR ", $_or ) . ' )';
        }
        else
        {
            $where .= "1 = 1";
        }

        if ( $incStarCheck === true )
        {
            $where .= ' OR ( ' . $field . '=\'*\' )';
        }

        return $where . ' )';
    }

    /**
    * Set Timezone
    *
    * @param    float        UTC Offset (e.g. 6 or -4.5)
    * @return    @e void
    */
    public function setTimeZone( $offset )
    {
        $offset = number_format( floatval( $offset ), 2 );
        $decimal = substr( $offset, strpos( $offset, '.' ) + 1 );
        $offset = ( $offset >= 0 ? '+' . floor( $offset ) : ceil( $offset ) ) . ':' . str_pad( $decimal = ( 60 / 100 ) * $decimal, 2, '0' );

        $this->query( "SET time_zone = '{$offset}';" );
    }

    /**
    * Build instr string
    *
    * @param    string        String to look in
    * @param    string        String to look for
    * @return    @e string
    */
    public function buildInstring( $look_in, $look_for )
    {
        if( $look_for AND $look_in )
        {
            return "INSTR('" . $look_in . "', " . $look_for . ")";
        }
        else
        {
            return '';
        }
    }

    /**
    * Build substr string
    *
    * @param    string        String of characters/Column
    * @param    integer        Offset
    * @param    integer        [Optional] Number of chars
    * @return    @e string
    */
    public function buildSubstring( $look_for, $offset, $length=0 )
    {
        $return = '';

        if( $look_for AND $offset )
        {
            $return = "SUBSTR(" . $look_for . ", " . $offset;

            if( $length )
            {
                $return .= ", " . $length;
            }

            $return .= ")";
        }

        return $return;
    }

    /**
    * Build distinct string
    *
    * @param    string        Column name
    * @return    @e string
    */
    public function buildDistinct( $column )
    {
        return "DISTINCT(" . $column . ")";
    }

    /**
    * Build length string
    *
    * @param    string        Column name
    * @return    @e string
    */
    public function buildLength( $column )
    {
        return "LENGTH(" . $column . ")";
    }

    /**
    * Build lower string
    *
    * @param    string        Column name
    * @return    @e string
    */
    public function buildLower( $column )
    {
        return "LOWER(" . $column . ")";
    }

    /**
    * Build right string
    *
    * @param    string        Column name
    * @param    integer        Number of chars
    * @return    @e string
    */
    public function buildRight( $column, $chars )
    {
        return "RIGHT(" . $column . "," . intval($chars) . ")";
    }

    /**
    * Build left string
    *
    * @param    string        Column name
    * @param    integer        Number of chars
    * @return    @e string
    */
    public function buildLeft( $column, $chars )
    {
        return "LEFT(" . $column . "," . intval($chars) . ")";
    }

    /**
    * Build "is null" and "is not null" string
    *
    * @param    boolean        is null flag
    * @return    @e string
    */
    public function buildIsNull( $is_null=true )
    {
        return $is_null ? " IS NULL " : " IS NOT NULL ";
    }

    /**
    * Build coalesce statement
    *
    * @param    array        Values to check
    * @return    @e string
    */
    public function buildCoalesce( $values=array() )
    {
        if( !count($values) )
        {
            return '';
        }

        return "COALESCE(" . implode( ',', $values ) . ")";
    }

    /**
    * Build from_unixtime string
    *
    * @param    string        Column name
    * @param    string        [Optional] Format
    * @return    @e string
    */
    public function buildFromUnixtime( $column, $format='' )
    {
        if( $format )
        {
            return "FROM_UNIXTIME(" . $column . ", '{$format}')";
        }
        else
        {
            return "FROM_UNIXTIME(" . $column . ")";
        }
    }

    /**
    * Build unix_timestamp string
    *
    * @param    string        Column name
    * @return    @e string
    */
    public function buildUnixTimestamp( $column )
    {
        return "UNIX_TIMESTAMP(" . $column . ")";
    }

    /**
    * Build date_format string
    *
    * @param    string        Date string
    * @param    string        Format
    * @return    @e string
    */
    public function buildDateFormat( $column, $format )
    {
        return "DATE_FORMAT(" . $column . ", '{$format}')";
    }

    /**
    * Build rand() string
    *
    * @return    @e string
    */
    public function buildRandomOrder()
    {
        return "RAND()";
    }

    /**
    * Build fulltext search string
    *
    * @param    string        Column to search against
    * @param    string        String to search
    * @param    boolean        Search in boolean mode
    * @param    boolean        Return a "as ranking" statement from the build
    * @param    boolean        Use fulltext search
    * @return    @e string
    */
    public function buildSearchStatement( $column, $keyword, $booleanMode=true, $returnRanking=false, $useFulltext=true )
    {
        if( !$useFulltext OR strtolower($this->connect_vars['mysql_tbl_type']) != 'myisam' )
        {
            return "{$column} LIKE '%{$keyword}%'";
        }
        else
        {
            return "MATCH( {$column} ) AGAINST( '{$keyword}' " . ( $booleanMode === TRUE ? 'IN BOOLEAN MODE' : '' ) . " )" . ( $returnRanking === TRUE ? ' as ranking' : '' );
        }
    }

    /**
    * Builds a call to MD5 equivalent
    *
    * @param    string        Column name or value to MD5-hash
    * @return    @e string
    */
    public function buildMd5Statement( $statement )
    {
        return "MD5(" . $statement . ")";
    }

    /**
    * Build calc rows 
    * We don't have to do anything for MySQL 4+ as it's handled internally
    * This is always called before the limit is applied
    *
    * @return    @e void
    */
    protected function _buildCalcRows()
    {
        return "";

        /* For other engines */
        /*if ( $this->cur_query )
        {
        $_query = preg_replace( "#SELECT\s{1,}(.+?)\s{1,}FROM\s{1,}#i", "SELECT count(*) as count FROM ", $this->cur_query );

        $this->query( $_query );
        $count = $this->fetch();

        $this->_calcRows = intval( $count['count'] );
        }*/
    }

    /**
    * Build select statement
    *
    * @param    string        Columns to retrieve
    * @param    string        Table name
    * @param    string        [Optional] Where clause
    * @param    array         [Optional] Joined table data
    * @param    boolean        Calculate total rows too
    * @param    array        [Optional] Force index
    * @return    @e void
    */
    protected function _buildSelect( $get, $table, $where, $add_join=array(), $calcRows=FALSE, $forceIndex=array() )
    {
        $_calcRows = ( $calcRows === TRUE ) ? 'SQL_CALC_FOUND_ROWS ' : '';

        if ( !empty( $forceIndex ) )
        {
            $table .= ' FORCE INDEX('. implode( ',', array_map( create_function( '$v', 'return $v == \'PRIMARY\' ? $v : "'.$this->fieldNameEncapsulate.'{$v}'.$this->fieldNameEncapsulate.'";' ), $forceIndex ) ) .')';
        }

        if( !count($add_join) )
        {
            if( is_array( $table ) )
            {
                $_tables    = array();

                foreach( $table as $tbl => $alias )
                {
                    $_tables[] = $tbl . ' ' . $alias;
                }

                $table    = implode( ', ', $_tables );
            }
            else
            {
                $table    = $table;
            }

            $this->cur_query .= "SELECT {$_calcRows}{$get} FROM " . $table;

            if ( $where != "" )
            {
                $this->cur_query .= " WHERE " . $where;
            }

            return;
        }
        else
        {
            //-----------------------------------------
            // OK, here we go...
            //-----------------------------------------

            $select_array   = array();
            $from_array     = array();
            $joinleft_array = array();
            $where_array    = array();
            $final_from     = array();
            $select_array[] = $get;
            $from_array[]   = $table;
            $hasLeft        = false;
            $hasInner        = false;

            if ( $where )
            {
                $where_array[]  = $where;
            }

            //-----------------------------------------
            // Loop through JOINs and sort info
            //-----------------------------------------

            if ( is_array( $add_join ) and count( $add_join ) )
            {
                foreach( $add_join as $join )
                {
                    if ( ! is_array( $join ) )
                    {
                        continue;
                    }

                    # Push join's select to stack
                    if ( !empty($join['select']) )
                    {
                        $select_array[] = $join['select'];
                    }

                    if ( empty($join['type']) OR $join['type'] == 'left' )
                    {
                        $hasLeft = true;
                        # Join is left or not specified (assume left)
                        $tmp = " LEFT JOIN ";

                        foreach( $join['from'] as $tbl => $alias )
                        {
                            $tmp .= $tbl.' '.$alias;
                        }

                        if ( $join['where'] )
                        {
                            $tmp .= " ON ( ".$join['where']." ) ";
                        }

                        $joinleft_array[] = $tmp;

                        unset( $tmp );
                    }
                    else if ( $join['type'] == 'inner' )
                        {
                            $hasInner = true;

                            # Join is inline
                            $from_array[]  = $join['from'];

                            if ( $join['where'] )
                            {
                                $where_array[] = $join['where'];
                            }
                    }
                    else
                    {
                        # Not using any other type of join
                    }
                }
            }

            //-----------------------------------------
            // Build it..
            //-----------------------------------------

            foreach( $from_array as $i )
            {
                foreach( $i as $tbl => $alias )
                {
                    $final_from[] = $tbl . ' ' . $alias;
                }
            }

            $get     = implode( ","     , $select_array   );

            #http://bugs.mysql.com/bug.php?id=37925
            $table   = ( $hasLeft === true && $hasInner === true ) ? '(' . implode( ",", $final_from ) . ')' : implode( ",", $final_from );
            $where   = implode( " AND " , $where_array    );
            $join    = implode( "\n"    , $joinleft_array );

            $this->cur_query .= "SELECT {$_calcRows}{$get} FROM {$table}";

            if ( $join )
            {
                $this->cur_query .= " " . $join . " ";
            }

            if ( $where != "" )
            {
                $this->cur_query .= " WHERE " . $where;
            }
        }
    } 
}
?>