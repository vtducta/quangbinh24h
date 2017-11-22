<?php     
/**      
 *
 * Email : kph.acc@gmail.com
 * Yahoo : kph_kph@yahoo.com
 * Phone : +84902245620
 * 
 * Interface database driver                                           
 *
 * @author         $Author: kenchan ak binhlt $
 * @copyright    (c) kenchan
 * @package        K-CMS
 * @since        Tue. 06th April 2010 
 *
 * Basic Usage Examples
 * <code>
 * $db = new db_driver();
 * Update:
 * $db->update( 'table', array( 'field' => 'value', 'field2' => 'value2' ), 'id=1' );
 * Insert
 * $db->insert( 'table', array( 'field' => 'value', 'field2' => 'value2' ) );
 * Delete
 * $db->delete( 'table', 'id=1' );
 * Select
 * $db->build( array( 'select' => '*',
 *                           'from'   => 'table',
 *                           'where'  => 'id=2 and mid=1',
 *                           'order'  => 'date DESC',
 *                           'limit'  => array( 0, 30 ) ) );
 * $db->execute();
 * while( $row = $db->fetch() ) { .... }
 * Select with join
 * $db->build( array( 'select'   => 'd.*',
 *                            'from'     => array( 'dnames_change' => 'd' ),
 *                            'where'    => 'dname_member_id='.$id,
 *                            'add_join' => array( 0 => array( 'select' => 'm.members_display_name',
 *                                                      'from'   => array( 'members' => 'm' ),
 *                                                      'where'  => 'm.member_id=d.dname_member_id',
 *                                                      'type'   => 'inner' ) ),
 *                            'order'    => 'dname_date DESC' ) );
 *  $db->execute();
 * </code>
 */

/**
 * This can be overridden by using
 * $DB->allow_sub_select = 1;
 * before any query construct
 */            
define( 'DB_ALLOW_SUB_SELECTS', 0 );

/**
 * Database interface
 */
interface IDatabaseDriver
{
    /**
     * Connect to database server
     *
     * @return    @e boolean
     */
    public function connect();

    /**
     * Return the connection ID
     *
     * @return    @e resource
     */
    public function getConnectionId();
    
    /**
     * Close database connection
     *
     * @return    @e boolean
     */
    public function disconnect();
    
    /**
     * Returns the currently formed SQL query
     *
     * @return    @e string
     */
    public function fetchSqlString();

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
    public function delete( $table, $where='', $orderBy='', $limit=array(), $shutdown=false );
    
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
    public function update( $table, $set, $where='', $shutdown=false, $preformatted=false, $add_join=array() );
    
    /**
     * Insert data into a table
     *
     * @param    string         Table name
     * @param    array         Array of field => values
     * @param    boolean        [Optional] Run on shutdown
     * @return    @e resource
     */
    public function insert( $table, $set, $shutdown=false );
    
    /**
     * Insert record into table if not present, otherwise update existing record
     *
     * @param    string         Table name
     * @param    array         Array of field => values
     * @param    array         Array of fields to check
     * @param    boolean        [Optional] Run on shutdown
     * @return    @e resource
     */
    public function replace( $table, $set, $shutdown=false );
    
    /**
     * Run a "kill" statement
     *
     * @param    integer     Thread ID
     * @return    @e resource
     */
    public function kill( $threadId );

    /**
     * Takes array of set commands and generates a SQL formatted query
     *
     * @param    array        Set commands (select, from, where, order, limit, etc)
     * @return    @e void
     */
    public function build( $data );
    
    /**
     * Build a query based on template from cache file
     *
     * @param    string        Name of query file method to use
     * @param    array        Optional arguments to be parsed inside query function
     * @param    string        Optional class name
     * @return    @e void
     */
    public function buildFromCache( $method, $args=array(), $class='sql_queries' );
    
    /**
     * Executes stored SQL query
     *
     * @return    @e resource
     */
    public function execute();
    
    /**
     * Stores a query for shutdown execution
     *
     * @return    @e mixed
     */
    public function executeOnShutdown();
    
    /**
     * Generates and executes SQL query, and returns the first result
     *
     * @param    array        Set commands (select, from, where, order, limit, etc)
     * @return    @e array
     */
    public function buildAndFetch( $data );
    
    /**
     * Generates and executes SQL query, and returns the all results in an array
     *
     * @param    array        Set commands (select, from, where, order, limit, etc)
     * @param    string        Key to index array on (member_id, for example)
     * @return    @e array
     */
    public function buildAndFetchAll( $data, $arrayIndex=null );
    
    /**
     * Execute a direct database query
     *
     * @param    string        Database query                   
     * @return    @e resource
     */
    public function query( $the_query);

    /**
     * Retrieve number of rows affected by last query
     *
     * @return    @e integer
     */
    public function getAffectedRows();
    
    /**
     * Retrieve number of rows in result set
     *
     * @param    resource    [Optional] Query id
     * @return    @e integer
     */
    public function getTotalRows( $query_id=null );
    
    /**
     * Retrieve latest autoincrement insert id
     *
     * @return    @e integer
     */
    public function getInsertId();
    
    /**
     * Retrieve the current thread id
     *
     * @return    @e integer
     */
    public function getThreadId();
    
    /**
     * Free result set from memory
     *
     * @param    resource    [Optional] Query id
     * @return    @e void
     */
    public function freeResult( $query_id=null );

    /**
     * Retrieve row from database
     *
     * @param    resource    [Optional] Query result id
     * @return    @e mixed
     */
    public function fetch( $query_id=null );
    
    /**
     * Return the number calculated rows (as if there was no limit clause)
     *
     * @param    string         [ alias name for the count(*) ]
     * @return    @e integer
     */
    public function fetchCalculatedRows( $alias='count' );
    
    /**
     * Get array of fields in result set
     *
     * @param    resource    [Optional] Query id
     * @return    @e array
     */
    public function getResultFields( $query_id=null );

    /**
     * Subqueries supported by driver?
     *
     * @return    @e boolean
     */
    public function checkSubquerySupport();
    
    /**
     * Fulltext searching supported by driver?
     *
     * @return    @e boolean
     */
    public function checkFulltextSupport();
    
    /**
     * Boolean fulltext searching supported by driver?
     *
     * @return    @e boolean
     */
    public function checkBooleanFulltextSupport();
    
    /**
     * Test to see whether an index exists in a table
     *
     * @param    string        Index name
     * @param    string        Table name
     * @return    @e boolean
     */
    public function checkForIndex( $index, $table );

    /**
     * Test to see whether a field exists in a table
     *
     * @param    string        Field name
     * @param    string        Table name
     * @return    @e boolean
     */
    public function checkForField( $field, $table );
    
    /**
     * Test to see whether a table exists
     *
     * @param    string        Table name
     * @return    @e boolean
     */
    public function checkForTable( $table );
    
    /**
     * Drop database table
     *
     * @param    string        Table to drop
     * @return    @e resource
     */
    public function dropTable( $table );
    
    /**
     * Drop field in database table
     *
     * @param    string        Table name
     * @param    string        Field to drop
     * @return    @e resource
     */
    public function dropField( $table, $field );
    
    /**
     * Add field to table in database
     *
     * @param    string        Table name
     * @param    string        Field to add
     * @param    string        Field type
     * @param    string        [Optional] Default value
     * @return    @e resource
     */
    public function addField( $table, $field, $type, $default=NULL );
    
    /**
     * Add index to database column
     *
     * @param    string        Table name        table
     * @param    string        Index name        multicol
     * @param    string        Fieldlist        col1, col2
     * @param    bool        Is primary key?
     * @return    @e resource
     * @todo     [Future] Add support for fulltext indexes (right now can only do generic index or primary key)
     * @see        addFulltextIndex()
     */
    public function addIndex( $table, $name, $fieldlist, $isPrimary=false );
    
    /**
     * Change field in database table
     *
     * @param    string        Table name
     * @param    string        Existing field name
     * @param    string        New field name
     * @param    string        [Optional] Field type
     * @param    string        [Optional] Default value
     * @return    @e resource
     */
    public function changeField( $table, $old_field, $new_field, $type='', $default=NULL );
    
    /**
     * Optimize database table
     *
     * @param    string        Table name
     * @return    @e resource
     */
    public function optimize( $table );
    
    /**
     * Add fulltext index to database column
     *
     * @param    string        Table name
     * @param    string        Field name
     * @return    @e resource
     */
    public function addFulltextIndex( $table, $field );
    
    /**
     * Get table schematic
     *
     * @param    string        Table name
     * @return    @e array
     */
    public function getTableSchematic( $table );
    
    /**
     * Get array of table names in database
     *
     * @return    @e array
     */
    public function getTableNames();
    
    /**
     * Get array of field names in table
     *
     * @param    string        Table name
     * @return    @e array
     */
    public function getFieldNames( $table );
    
    /**
     * Determine if table already has a fulltext index
     *
     * @param    string        Table name
     * @return    @e boolean
     */
    public function getFulltextStatus( $table );
    
    /**
     * Retrieve SQL server version
     *
     * @return    @e string
     */
    public function getSqlVersion();     
    
    /**
     * Returns current number queries run
     *
     * @return    @e integer
     */
    public function getQueryCount();
    
    /**
     * Flushes the currently queued query
     *
     * @return    @e void
     */
    public function flushQuery();

    /**
     * Load extra SQL query file
     *
     * @param    string         File name
     * @param    string         Classname of file
     * @return    @e void
     */
    public function loadCacheFile( $filepath, $classname );
    
    /**
     * Checks to see if a query file has been loaded
     *
     * @param    string         Classname of file
     * @return    @e void
     */
    public function hasLoadedCacheFile( $classname );

    /**
     * Set fields that shouldn't be escaped
     *
     * @param    array         SQL table fields
     * @return    @e void
     */
    public function preventAddSlashes( $fields=array() );
    
    /**
     * Compiles SQL fields for insertion
     *
     * @param    array        Array of field => value pairs
     * @return    @e array
     */
    public function compileInsertString( $data );
    
    /**
     * Compiles SQL fields for update query
     *
     * @param    array        Array of field => value pairs
     * @return    @e string
     */
    public function compileUpdateString( $data );
    
    /**
     * Escape strings for DB insertion
     *
     * @param    string        Text to escape
     * @return    @e string
     */
    public function addSlashes( $t );

    /**
     * Build concat string
     *
     * @param    array        Array of data to concat
     * @return    @e string
     */
    public function buildConcat( $data );
    
    /**
     * Build CAST string
     *
     * @param    string        Value to CAST
     * @param    string        Type to cast to
     * @return    @e string
     */
    public function buildCast( $data, $columnType );
    
    /**
     * Build between statement
     *
     * @param    string        Column
     * @param    integer        Value 1
     * @param    integer        Value 2
     * @return    @e string
     */
    public function buildBetween( $column, $value1, $value2 );
    
    /**
     * Build regexp 'or'
     *
     * @param    string        Column
     * @param    array        Array of values to allow
     * @return    @e string
     */
    public function buildRegexp( $column, $data );
    
    /**
     * Build LIKE CHAIN string (ONLY supports a regexp equivalent of "or field like value")
     *
     * @param    string        Database column
     * @param    array        Array of values to allow
     * @return    @e string
     */
    public function buildLikeChain( $column, $data );
    
    /**
     * Build instr string
     *
     * @param    string        String to look in
     * @param    string        String to look for
     * @return    @e string
     */
    public function buildInstring( $look_in, $look_for );
    
    /**
     * Build substr string
     *
     * @param    string        String of characters/Column
     * @param    integer        Offset
     * @param    integer        [Optional] Number of chars
     * @return    @e string
     */
    public function buildSubstring( $look_for, $offset, $length=0 );
    
    /**
     * Build distinct string
     *
     * @param    string        Column name
     * @return    @e string
     */
    public function buildDistinct( $column );
    
    /**
     * Build length string
     *
     * @param    string        Column name
     * @return    @e string
     */
    public function buildLength( $column );
    
    /**
     * Build lower string
     *
     * @param    string        Column name
     * @return    @e string
     */
    public function buildLower( $column );
    
    /**
     * Build right string
     *
     * @param    string        Column name
     * @param    integer        Number of chars
     * @return    @e string
     */
    public function buildRight( $column, $chars );
    
    /**
     * Build left string
     *
     * @param    string        Column name
     * @param    integer        Number of chars
     * @return    @e string
     */
    public function buildLeft( $column, $chars );

    /**
     * Builds a call to MD5 equivalent
     *
     * @param    string        Column name or value to MD5-hash
     * @return    @e string
     */
    public function buildMd5Statement( $statement );
    
    /**
     * Build "is null" and "is not null" string
     *
     * @param    boolean        is null flag
     * @return    @e string
     */
    public function buildIsNull( $is_null=true );

    /**
     * Build coalesce statement
     *
     * @param    array        Values to check
     * @return    @e string
     */
    public function buildCoalesce( $values=array() );
    
    /**
     * Build from_unixtime string
     *
     * @param    string        Column name
     * @param    string        [Optional] Format
     * @return    @e string
     */
    public function buildFromUnixtime( $column, $format='' );

    /**
     * Build unix_timestamp string
     *
     * @param    string        Column name
     * @return    @e string
     */
    public function buildUnixTimestamp( $column );
    
    /**
     * Build date_format string
     *
     * @param    string        Date string
     * @param    string        Format
     * @return    @e string
     */
    public function buildDateFormat( $column, $format );
    
    /**
     * Build rand() string
     *
     * @return    @e string
     */
    public function buildRandomOrder();
    
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
    public function buildSearchStatement( $column, $keyword, $booleanMode=true, $returnRanking=false, $useFulltext=true );

    /**
     * Prints SQL error message
     *
     * @param    string        Additional error message
     * @return    @e mixed
     */
    public function throwFatalError( $the_error='' );
    
    /**
     * Returns a portion of a WHERE query suitable for use.
     * Specific to tables with a field that has a comma separated list of IDs.
     *
     * @param    array        Array of perm IDs
     * @param    string        DB field to search in
     * @param    boolean        check for '*' in the field to denote 'global'
     * @return    @e mixed
     */
    public function buildWherePermission( array $ids, $field='', $incStarCheck=true );

    /**
     * Set Timezone
     *
     * @param    float        UTC Offset (e.g. 6 or -4.5)
     * @return    @e void
     */
    public function setTimeZone( $offset );    
}  
?>