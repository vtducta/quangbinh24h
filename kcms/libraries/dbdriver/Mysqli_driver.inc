<?php
/**    
* Email : kph.acc@gmail.com
* Yahoo : kph_kph@yahoo.com
* Phone : +84902245620
* 
* Mysqli driver connection                                           
*
* @author         $Author: kenchan ak binhlt $
* @copyright    (c) kenchan
* @package        K-CMS
* @since        Tue. 06th April 2010  
*
*/  

class Mysqli_DBConnection extends DBMysqlConnection implements IDatabaseDriver
{
    /**
    * Connection failed flag
    *
    * @var         boolean
    */
    protected $connect_failed        = false;

    /**
    * constructor
    *
    * @return    @e void
    */
    public function __construct()
    { 
        $this->connect_vars['mysql_tbl_type'] = "";
    }

    /**
    * Connect to database server
    *
    * @return    @e boolean
    */
    public function connect()
    {   
        $this->_loadCacheFile();

        /* Did we add a port inline? */
        if ( ! $this->obj['sql_port'] AND strstr( $this->obj['sql_host'], ':' ) )
        {
            list( $host, $port ) = explode( ':', $this->obj['sql_host'] );

            $this->obj['sql_host'] = $host;
            $this->obj['sql_port'] = intval( $port );
        }

        /* Persistent connection */
        if( $this->obj['persistent'] )
        {
            $this->obj['sql_host'] = 'p:' . $this->obj['sql_host'];
        }

        /* Use socket if specified */
        if( $this->obj['sql_socket'] )
        {
            if( $this->obj['sql_port'] )
            {
                $this->connection_id = @mysqli_connect( $this->obj['sql_host'],
                $this->obj['sql_user'],
                $this->obj['sql_pass'],
                $this->obj['sql_database'],
                $this->obj['sql_port'],
                $this->obj['sql_socket']
                );
            }
            else
            {
                $this->connection_id = @mysqli_connect( $this->obj['sql_host'],
                $this->obj['sql_user'],
                $this->obj['sql_pass'],
                $this->obj['sql_database'],
                null,
                $this->obj['sql_socket']
                );
            }
        }
        else
        {
            if( $this->obj['sql_port'] )
            {
                $this->connection_id = @mysqli_connect( $this->obj['sql_host'],
                $this->obj['sql_user'],
                $this->obj['sql_pass'],
                $this->obj['sql_database'],
                $this->obj['sql_port']
                );
            }
            else
            {
                $this->connection_id = @mysqli_connect( $this->obj['sql_host'],
                $this->obj['sql_user'],
                $this->obj['sql_pass'],
                $this->obj['sql_database']
                );
            }

        }

        if ( ! $this->connection_id )
        {
            $this->usingClass     = 'DBMysqlConnection';
            $this->connect_failed = true;
            $this->throwFatalError();
            return FALSE;
        }

        mysqli_autocommit( $this->connection_id, TRUE );

        //-----------------------------------------
        // Remove sensitive data
        //-----------------------------------------

        unset( $this->obj['sql_host'] );
        unset( $this->obj['sql_user'] );
        unset( $this->obj['sql_pass'] );

        //-----------------------------------------
        // If there's a charset set, run it
        //-----------------------------------------

        if( $this->obj['sql_charset'] )
        {
            $this->query( "SET NAMES '{$this->obj['sql_charset']}'" );
        }

        parent::connect();

        return TRUE;
    }

    /**
    * Close database connection
    *
    * @return    @e boolean
    */
    public function disconnect()
    {
        if ( $this->connection_id )
        {
            return @mysqli_close( $this->connection_id );
        }
    }

    /**
    * Execute a direct database query
    *
    * @param    string        Database query                     
    * @return    @e resource
    */
    public function query( $the_query )
    {          
        //-----------------------------------------
        // Stop sub selects? (UNION)
        //-----------------------------------------

        if ( ! DB_ALLOW_SUB_SELECTS )
        {
            # On the spot allowance?
            if ( ! $this->allow_sub_select )
            {
                $_tmp = trim(strtolower( $this->_removeAllQuotes($the_query) ));

                if ( preg_match( "#(?:/\*|\*/)#i", $_tmp ) )
                {
                    $this->throwFatalError( "You are not allowed to use comments in your SQL query. Add allow_sub_select=1; before any query construct to allow them" );
                    return false;
                }

                if ( preg_match( "#[^_a-zA-Z]union[^_a-zA-Z]#s", $_tmp ) )
                {
                    $this->throwFatalError( "UNION query joins are not allowed.\nAdd allow_sub_select=1; before any query construct to allow them" );
                    return false;
                }
                else if ( preg_match_all( "#[^_a-zA-Z](select)[^_a-zA-Z]#s", $_tmp, $matches ) )
                    {
                        if ( count( $matches ) > 1 )
                        {
                            $this->throwFatalError( "SUB SELECT query joins are not allowed.Add allow_sub_select=1; before any query construct to allow them" );
                            return false;
                        }
                }
            }
        }           

        //-----------------------------------------
        // Run the query
        //-----------------------------------------
        $this->_tmpQ    = substr( $the_query, 0, 100 ) . '...';
        $this->query_id = mysqli_query($this->connection_id, $the_query );

        //-----------------------------------------
        // Reset array...
        //-----------------------------------------

        $this->resetDataTypes();
        $this->allow_sub_select = false;

        if (! $this->query_id )
        {
            $this->throwFatalError("mySQL query error: $the_query");
        }

        $this->query_count++;

        $this->obj['cached_queries'][] = $the_query;

        return $this->query_id;
    }

    /**
    * Retrieve number of rows affected by last query
    *
    * @return    @e integer
    */
    public function getAffectedRows()
    {
        return mysqli_affected_rows( $this->connection_id );
    }

    /**
    * Retrieve number of rows in result set
    *
    * @param    resource    [Optional] Query id
    * @return    @e integer
    */
    public function getTotalRows( $query_id=null )
    {
        if ( ! $query_id )
        {
            $query_id = $this->query_id;
        }

        return mysqli_num_rows( $query_id );
    }

    /**
    * Retrieve latest autoincrement insert id
    *
    * @return    @e integer
    */
    public function getInsertId()
    {
        return mysqli_insert_id($this->connection_id);
    }

    /**
    * Retrieve the current thread id
    *
    * @return    @e integer
    */
    public function getThreadId()
    {
        return mysqli_thread_id($this->connection_id);
    }

    /**
    * Free result set from memory
    *
    * @param    resource    [Optional] Query id
    * @return    @e void
    */
    public function freeResult( $query_id=null )
    {
        if ( ! $query_id )
        {
            $query_id = $this->query_id;
        }

        @mysqli_free_result( $query_id );
    }

    /**
    * Retrieve row from database
    *
    * @param    resource    [Optional] Query result id
    * @return    @e mixed
    */
    public function fetch( $query_id=null )
    {   

        if ( ! $query_id )
        {
            $query_id = $this->query_id;
        }

        $this->record_row = mysqli_fetch_assoc( $query_id );

        return $this->record_row;
    }

    /**
    * Return the number calculated rows (as if there was no limit clause)
    *
    * @param    string         [ alias name for the count(*) ]
    * @return    @e integer
    */
    public function fetchCalculatedRows( $alias='count' )
    {
        $calcRowsHandle = mysqli_query( $this->connection_id, "SELECT FOUND_ROWS() as " . $alias );

        $this->obj['cached_queries'][] = "SELECT FOUND_ROWS() as " . $alias;

        $val = mysqli_fetch_assoc( $calcRowsHandle );

        return intval( $val[ $alias ] );
    }

    /**
    * Get array of fields in result set
    *
    * @param    resource    [Optional] Query id
    * @return    @e array
    */
    public function getResultFields( $query_id=null )
    {
        $fields = array();

        if ( !$query_id )
        {
            $query_id = $this->query_id;
        }

        while( $field = mysqli_fetch_field($query_id) )
        {
            $fields[] = $field;
        }

        return $fields;
    }

    /**
    * Get array of table names in database
    *
    * @return    @e array
    */
    public function getTableNames()
    {
        if ( is_array( $this->cached_tables ) AND count( $this->cached_tables ) )
        {
            return $this->cached_tables;
        }

        $current            = $this->return_die;
        $this->return_die     = true;

        $qid = $this->query( "SHOW TABLES FROM `{$this->obj['sql_database']}`" );

        $this->return_die     = $current;

        if( $qid AND $this->getTotalRows($qid) )
        {
            while( $result = mysqli_fetch_array($qid) )
            {
                $this->cached_tables[] = $result[0];
            }
        }

        mysqli_free_result($qid);

        return $this->cached_tables;
    }

    /**
    * Retrieve SQL server version
    *
    * @return    @e string
    */
    public function getSqlVersion()
    {
        if ( ! $this->sql_version and ! $this->true_version )
        {
            $version = mysqli_get_server_info($this->connection_id);

            $this->true_version = $version;
            $tmp                = explode( '.', preg_replace( "#[^\d\.]#", "\\1", $version ) );

            $this->sql_version = sprintf('%d%02d%02d', $tmp[0], $tmp[1], $tmp[2] );
        }

        return $this->sql_version;
    }

    /**
    * Escape strings for DB insertion
    *
    * @param    string        Text to escape
    * @return    @e string
    */
    public function addSlashes( $t )
    {
        return @mysqli_real_escape_string( $this->connection_id, $t );
    }

    /**
    * Get SQL error number
    *
    * @return    @e mixed
    */
    protected function _getErrorNumber()
    {
        if( $this->connect_failed )
        {
            return mysqli_connect_errno();
        }
        else
        {
            return mysqli_errno( $this->connection_id );
        }
    }

    /**
    * Get SQL error message
    *
    * @return    @e string
    */
    protected function _getErrorString()
    { 
        if( $this->connect_failed )
        {
            return mysqli_connect_error( );
        }
        else
        {
            return mysqli_error( $this->connection_id );
        }
    }

    /**
    * Test to see whether a table exists
    *
    * @param    string        Table name
    * @return    @e boolean
    */
    public function checkForTable( $table )
    {       
        $table = trim($table );

        $qid = $this->query( "SHOW TABLES FROM `{$this->obj['sql_database']}` LIKE '{$table}'" );

        if( ! $qid OR ! $this->getTotalRows($qid) )
        {
            return false;
        }
        else
        {
            while( $result = mysqli_fetch_array($qid) )
            {
                if( $result[0] == $table )
                {
                    mysqli_free_result($qid);

                    return true;
                }
            }
        }

        return false;
    }
}        
?>