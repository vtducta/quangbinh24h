<?php
/**    
 * Email : kph.acc@gmail.com
 * Yahoo : kph_kph@yahoo.com
 * Phone : +84902245620
 * 
 * Mysql driver connection                                           
 *
 * @author         $Author: kenchan ak binhlt $
 * @copyright    (c) kenchan
 * @package        K-CMS
 * @since        Tue. 06th April 2010  
 *
 */  
 
class Mysql_DBConnection extends DBMysqlConnection implements IDatabaseDriver
{
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
        //-----------------------------------------
        // Load query file
        //-----------------------------------------

        $this->_loadCacheFile();

         //-----------------------------------------
         // Connect
         //-----------------------------------------

        if( $this->obj['sql_socket'] )
        {
            $this->obj['sql_host']    = $this->obj['sql_host'] . ':' . $this->obj['sql_socket'];
        }

        if ( $this->obj['persistent'] )
        {
            $this->connection_id = @mysql_pconnect( $this->obj['sql_host'] ,
                                                   $this->obj['sql_user'] ,
                                                   $this->obj['sql_pass'] ,
                                                   $this->obj['force_new_connection']
                                                );
        }
        else
        {
            $this->connection_id = @mysql_connect( $this->obj['sql_host'] ,
                                                  $this->obj['sql_user'] ,
                                                  $this->obj['sql_pass'] ,
                                                  $this->obj['force_new_connection']
                                                );
        }

        if ( ! $this->connection_id )
        {
            $this->throwFatalError();
            return FALSE;
        }

        if ( ! mysql_select_db($this->obj['sql_database'], $this->connection_id) )
        {
            $this->throwFatalError();
            return FALSE;
        }

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
            return @mysql_close( $this->connection_id );
        }
    }

    /**
     * Execute a direct database query
     *
     * @param    string        Database query              
     * @return    @e resource
     */
    public function query( $the_query)
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
                    $this->throwFatalError( "You are not allowed to use comments in your SQL query.\nAdd allow_sub_select=1; before any query construct to allow them\n{$the_query}" );
                    return false;
                }

                if ( preg_match( "#[^_a-zA-Z]union[^_a-zA-Z]#s", $_tmp ) )
                {
                    $this->throwFatalError( "UNION query joins are not allowed.\nAdd allow_sub_select=1; before any query construct to allow them\n{$the_query}" );
                    return false;
                }
                else if ( preg_match_all( "#[^_a-zA-Z](select)[^_a-zA-Z]#s", $_tmp, $matches ) )
                {
                    if ( count( $matches ) > 1 )
                    {
                        $this->throwFatalError( "SUB SELECT query joins are not allowed.\nAdd allow_sub_select=1; before any query construct to allow them\n{$the_query}" );
                        return false;
                    }
                }
            }
        }

        //-----------------------------------------
        // Run the query
        //-----------------------------------------

        #I had to switch this around... The query goes first, connection id second. Otherwise it just breaks - KF
        #$this->query_id = mysql_query($this->connection_id, $the_query );
        $this->query_id = mysql_query( $the_query, $this->connection_id );

          //-----------------------------------------
          // Reset array...
          //-----------------------------------------

          $this->resetDataTypes();
          $this->allow_sub_select = false;

        if (! $this->query_id )
        {
            $this->throwFatalError("mySQL query error: {$the_query}");
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
        return mysql_affected_rows( $this->connection_id );
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

        return mysql_num_rows( $query_id );
    }

    /**
     * Retrieve latest autoincrement insert id
     *
     * @return    @e integer
     */
    public function getInsertId()
    {
        return mysql_insert_id($this->connection_id);
    }

    /**
     * Retrieve the current thread id
     *
     * @return    @e integer
     */
    public function getThreadId()
    {
        return mysql_thread_id($this->connection_id);
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

        @mysql_free_result( $query_id );
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

        $this->record_row = mysql_fetch_array( $query_id, MYSQL_ASSOC );

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
        $calcRowsHandle = mysql_query( "SELECT FOUND_ROWS() as " . $alias, $this->connection_id );

        $val = mysql_fetch_array( $calcRowsHandle, MYSQL_ASSOC );

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

        while( $field = mysql_fetch_field($query_id) )
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
            while( $result = mysql_fetch_array($qid) )
            {
                $this->cached_tables[] = $result[0];
            }
        }

        mysql_free_result($qid);

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
            $this->query( "SELECT VERSION() AS version" );

            if ( ! $row = $this->fetch() )
            {
                $this->query( "SHOW VARIABLES LIKE 'version' ");
                $row = $this->fetch();
            }

            $this->true_version = $row['version'];
            $tmp                = explode( '.', preg_replace( "#[^\d\.]#", "\\1", $row['version'] ) );

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
        return @mysql_real_escape_string( $t, $this->connection_id );
    }

    /**
     * Get SQL error number
     *
     * @return    @e mixed
     */
    protected function _getErrorNumber()
    {
        if( $this->connection_id )
        {
            return @mysql_errno( $this->connection_id );
        }
        else
        {
            return @mysql_errno();
        }
    }

    /**
     * Get SQL error message
     *
     * @return    @e string
     */
    protected function _getErrorString()
    {
        if( $this->connection_id )
        {
            return @mysql_error( $this->connection_id );
        }
        else
        {
            return @mysql_error();
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
            while( $result = mysql_fetch_array($qid) )
            {
                if( $result[0] == $table )
                {
                    mysql_free_result($qid);

                    return true;
                }
            }
        }

        return false;
    }  
}
?>