<?php
class uploadHelper extends Helper
{
    /**
    * file permisssion
    */
    const FILE_PERMISSION = 0777;
    
    /**
    * folder permission
    */
    const FOLDER_PERMISSION = 0777;
    
    /**
     * Name of upload form field
     *
     * @var        string
     */
    public $upload_form_field    = 'FILE_UPLOAD';
    
    /**
     * Out filename *without* extension
     * (Leave blank to retain user filename)
     *
     * @var        string
     */
    public $out_file_name        = '';
    
    /**
     * Out dir (./upload) - no trailing slash
     *
     * @var        string
     */
    public $out_file_dir        = './';
    
    /**
     * Maximum file size of this upload
     *
     * @var        integer
     */
    public $max_file_size        = 0;
    
    /**
     * Forces PHP, CGI, etc to text
     *
     * @var        integer
     */
    public $make_script_safe    = 1;
    
    /**
     * Force non-img file extenstion (leave blank if not) (ex: 'ibf' makes upload.doc => upload.ibf)
     *
     * @var        string
     */
    public $force_data_ext        = '';
    
    /**
     * Allowed file extensions array( 'gif', 'jpg', 'jpeg', 'pdf', 'pdfx', 'doc', 'mp4', 'docx'..)
     *
     * @var        array
     */
    public $allowed_file_ext     = array();
    
    /**
     * Check file extension allowed
     *
     * @var        boolean
     */
    public $check_file_ext         = true;
    
    /**
     * Array of IMAGE file extensions
     *
     * @var        array
     */
    public $image_ext            = array( 'gif', 'jpeg', 'jpg', 'jpe', 'png', 'pdf', 'pdfx', 'doc', 'mp4', 'docx' );
    
    /**
     * Check to make sure an image is an image
     *
     * @var        boolean
     */
    public $image_check            = true;
    
    /**
     * Returns current file extension    
     *
     * @var        string
     */
    public $file_extension        = '';
    
    /**
     * If force_data_ext == 1, this will return the 'real' extension
     * and $file_extension will return the 'force_data_ext'
     *
     * @var        string
     */
    public $real_file_extension    = '';
    
    /**
     * Returns error number [1-5]
     *
     * @var        integer
     */
    public $error_no            = 0;
    
    /**
     * Returns if upload is img or not
     *
     * @var        boolean
     */
    public $is_image            = 0;
    
    /**
     * Returns file name as was uploaded by user
     *
     * @var        string
     */
    public $original_file_name    = "";
    
    /**
     * Returns final file name as is saved on disk. (no path info)
     *
     * @var        string
     */
    public $parsed_file_name    = "";
    
    /**
     * Returns final file name with path info
     *
     * @var        string
     */
    public $saved_upload_name    = "";
    
    /**
    * constructor
    * 
    */
    public function __construct()
    {
        parent::__construct();
        $this->out_file_dir = isset(Application::$config['global']['Server']['upload_path']) ? Application::$config['global']['Server']['upload_path'] : './';
        $this->max_file_size = '100000000';
        $this->make_script_safe = 1;
        $this->allowed_file_ext = array( 'gif', 'jpg', 'jpeg', 'png', 'pdf', 'pdfx', 'doc', 'mp4', 'docx' );  
    }
    
    /**
    * set allow file type
    * 
    * default array( 'gif', 'jpg', 'jpeg', 'png', 'pdf', 'pdfx', 'doc', 'mp4', 'docx' );
    * 
    * @param array $allowed_file_ext
    */
    public function set_allowed_file_ext($allowed_file_ext)
    {
        $this->allowed_file_ext = $allowed_file_ext;
    }
    
    /**
    * set upload from field
    * 
    * default FILE_UPLOAD
    * 
    * @param string $upload_form_field
    */
    public function set_upload_form_field($upload_form_field)
    {
        $this->upload_form_field = $upload_form_field;
    }
    
    /**
    * set output name
    * 
    * default current file
    * 
    * @param string $name
    */
    public function set_output_name($name)
    {
        $this->out_file_name = $name;
    }
    
    /**
    * set output dir
    * 
    * default from config
    * 
    * @param string $dir
    */
    public function set_output_dir($dir)
    {
        $this->out_file_dir = $dir;
    }
    
    /**
    * set max file size ( bytes)
    * 
    * default 100000000 = 100mb
    * 
    * @param int $max_file_size
    */
    public function set_max_file_size($max_file_size)
    {
        $this->max_file_size = $max_file_size;
    }
    
    /**
    * set make script safe
    * 
    * default 1
    * 
    * @param int(0,1) $make_script_safe
    */
    public function set_make_script_safe($make_script_safe)
    {
        $this->make_script_safe = $make_script_safe;
    }
    
    /**
    * set extension    
    * 
    * @param string $ext
    */
    public function set_force_data_ext($ext)
    {
        $this->force_data_ext = $ext;
    }
    
    /**
     * Processes the upload
     *
     * @return    @e boolean
     */
    public function process()
    {
        $this->_cleanPaths();
        
        //-------------------------------------------------
        // Check for getimagesize
        //-------------------------------------------------
        if ( ! function_exists( 'getimagesize' ) )
        {
            $this->image_check = 0;
        }
        if (!@is_dir($this->out_file_dir)){
            if(!mkdir($this->out_file_dir,uploadHelper::FOLDER_PERMISSION,true)){
                die($this->out_file_dir);
            }
        }
        //-------------------------------------------------
        // Set up some variables to stop carpals developing
        //-------------------------------------------------       
        
        
        $FILE_NAME = str_replace( array( '<', '>' ), '-', isset($_FILES[ $this->upload_form_field ]['name']) ? $_FILES[ $this->upload_form_field ]['name'] : '' );
        $FILE_NAME = str_replace( chr(160), ' ', $FILE_NAME );
        $FILE_NAME = str_replace( chr(173), ' ', $FILE_NAME );
        
        $FILE_SIZE = isset($_FILES[ $this->upload_form_field ]['size']) ? $_FILES[ $this->upload_form_field ]['size'] : '';
        $FILE_TYPE = isset($_FILES[ $this->upload_form_field ]['type']) ? $_FILES[ $this->upload_form_field ]['type'] : '';

        //-------------------------------------------------
        // Naughty Opera adds the filename on the end of the
        // mime type - we don't want this.
        //-------------------------------------------------
        
        $FILE_TYPE = preg_replace( "/^(.+?);.*$/", "\\1", $FILE_TYPE );
        
        //-------------------------------------------------
        // Naughty Mozilla likes to use "none" to indicate an empty upload field.
        // I love universal languages that aren't universal.
        //-------------------------------------------------
        
        if ( !isset($_FILES[ $this->upload_form_field ]['name'])
            or $_FILES[ $this->upload_form_field ]['name'] == ""
            or !$_FILES[ $this->upload_form_field ]['name']
            or !$_FILES[ $this->upload_form_field ]['size']
            or $_FILES[ $this->upload_form_field ]['name'] == "none"
            )
        {
            if( $_FILES[ $this->upload_form_field ]['error'] == 2 )
            {
                $this->error_no = 3;
            }
            else if( $_FILES[ $this->upload_form_field ]['error'] == 1 )
            {
                $this->error_no = 3;
            }
            else
            {
                $this->error_no = 1;
            }
                        
            return false;
        }
        
        if( !is_uploaded_file( $_FILES[ $this->upload_form_field ]['tmp_name'] ) )
        {
            $this->error_no = 1;
            return false;
        }
                
        //-------------------------------------------------
        // Do we have allowed file_extensions?
        //-------------------------------------------------
        
        if( $this->check_file_ext )
        {
            if ( ! is_array( $this->allowed_file_ext ) or ! count( $this->allowed_file_ext ) )
            {
                $this->error_no = 2;
                return false;
            }
        }
        
        $this->allowed_file_ext = array_map( 'strtolower', $this->allowed_file_ext );
        
        //-------------------------------------------------
        // Get file extension
        //-------------------------------------------------
        
        $this->file_extension = $this->_getFileExtension( $FILE_NAME );

        if ( ! $this->file_extension )
        {
            $this->error_no = 2;
            return false;
        }
        
        $this->real_file_extension = $this->file_extension;
        
        //-------------------------------------------------
        // Valid extension?
        //-------------------------------------------------
        
        if ( $this->check_file_ext AND !in_array( $this->file_extension, $this->allowed_file_ext ) )
        {
            $this->error_no = 2;
            return false;
        }
        
        //-------------------------------------------------
        // Check the file size
        //-------------------------------------------------
        
        if ( ( $this->max_file_size ) and ( $FILE_SIZE > $this->max_file_size ) )
        {
            $this->error_no = 3;
            return false;
        }
        
        //-------------------------------------------------
        // Make the uploaded file safe
        // Storing original_file_name before replacements
        //-------------------------------------------------
        
        $this->original_file_name = $FILE_NAME;
        
        $FILE_NAME = preg_replace( '/[^\w\.]/', "_", $FILE_NAME );

        //-------------------------------------------------
        // Convert file name?
        // In any case, file name is WITHOUT extension
        //-------------------------------------------------
        
        if ( $this->out_file_name )
        {
            $this->parsed_file_name = $this->out_file_name;
        }
        else
        {
            $this->parsed_file_name = str_replace( '.' . $this->file_extension, "", $FILE_NAME );
        }
        
        //-------------------------------------------------
        // Make safe?
        //-------------------------------------------------
        
        $renamed = 0;
        
        if ( $this->make_script_safe )
        {
            if ( preg_match( '/\.(cgi|pl|js|asp|php|html|htm|jsp|jar)(\.|$)/i', $FILE_NAME ) )
            {
                $FILE_TYPE                 = 'text/plain';
                $this->file_extension      = 'txt';
                $this->parsed_file_name       = preg_replace( '/\.(cgi|pl|js|asp|php|html|htm|jsp|jar)(\.|$)/i', "$2", $this->parsed_file_name );
                
                $renamed = 1;
            }
        }
        
        //-------------------------------------------------
        // Is it an image?
        //-------------------------------------------------

        if ( is_array( $this->image_ext ) and count( $this->image_ext ) )
        {
            if ( in_array( $this->real_file_extension, $this->image_ext ) )
            {
                $this->is_image = 1;
            }
        }

        //-------------------------------------------------
        // Add on the extension...
        //-------------------------------------------------
        
        if ( $this->force_data_ext and ! $this->is_image )
        {
            $this->file_extension = str_replace( ".", "", $this->force_data_ext ); 
        }
        
        $this->parsed_file_name .= '.' . $this->file_extension;
        
        //-------------------------------------------------
        // Copy the upload to the uploads directory
        // ^^ We need to do this before checking the img
        //    size for the openbasedir restriction peeps
        //    We'll just unlink if it doesn't checkout
        //-------------------------------------------------
        
        $this->saved_upload_name = $this->out_file_dir . '/' . $this->parsed_file_name;
        
        if ( ! @move_uploaded_file( $_FILES[ $this->upload_form_field ]['tmp_name'], $this->saved_upload_name ) )
        {
            $this->error_no = 4;
            return;
        }
        else
        {
            @chmod( $this->saved_upload_name, uploadHelper::FILE_PERMISSION );
        }
        
        if( ! $renamed AND $this->file_extension != 'txt' )
        {
            $this->_checkXSSInfile();
            
            if( $this->error_no )
            {
                return false;
            }
        }
        
        //-------------------------------------------------
        // Is it an image?
        //-------------------------------------------------
        
        if ( $this->is_image )
        {
            //-------------------------------------------------
            // Are we making sure its an image?
            //-------------------------------------------------
            
            if ( $this->image_check )
            {
                $img_attributes = @getimagesize( $this->saved_upload_name );
                
                if ( ! is_array( $img_attributes ) or !count( $img_attributes ) )
                {
                    @unlink( $this->saved_upload_name );
                    $this->error_no = 5;
                    return false;
                }
                else if ( ! $img_attributes[2] )
                {
                    @unlink( $this->saved_upload_name );
                    $this->error_no = 5;
                    return false;
                }
                else if ( $img_attributes[2] == 1 AND ( $this->file_extension == 'jpg' OR $this->file_extension == 'jpeg' ) )
                {
                    // Potential XSS attack with a fake GIF header in a JPEG
                    @unlink( $this->saved_upload_name );
                    $this->error_no = 5;
                    return false;
                }
            }
        }
        
        //-------------------------------------------------
        // If filesize and $_FILES['size'] don't match then
        // either file is corrupt, or there was funny
        // business between when it hit tmp and was moved
        //-------------------------------------------------
        
        if( filesize($this->saved_upload_name) != $_FILES[ $this->upload_form_field ]['size'] )
        {
            @unlink( $this->saved_upload_name );
            
            $this->error_no = 1;
            return false;
        }
    }
    
    public function get_file_name(){
        return $this->parsed_file_name;
    }

    /**
    * Checks for XSS inside file.  If found, deletes file, sets error_no to 5 and returns
    *
    * @return    @e boolean
    */
    protected function _checkXSSInfile()
    {
        // HTML added inside an inline file is not good in IE...
        $fh = fopen( $this->saved_upload_name, 'rb' ); 
        
        $file_check = fread( $fh, 512 ); 

        fclose( $fh ); 
        
        if ( ! $file_check )
        {
            @unlink( $this->saved_upload_name );
            $this->error_no = 5;
            return false;
        }
        else if( preg_match( '#<script|<html|<head|<title|<body|<pre|<table|<a\s+href|<img|<plaintext|<cross\-domain\-policy#si', $file_check ) )
        {
            @unlink( $this->saved_upload_name );
            $this->error_no = 5;
            return false;
        }

        return true;
    }
    
    /**
     * Returns the file extension of the current filename
     *
     * @param    string        Filename
     * @return    @e string
     */
    public function _getFileExtension( $file )
    {     
        return ( strstr( $file, '.' ) ) ? strtolower( str_replace( ".", "", substr( $file, strrpos( $file, '.' ) ) ) ) : strtolower( $file );
    }

    /**
     * Trims off trailing slashes
     *
     * @return    @e void
     */
    protected function _cleanPaths()
    {
        $this->out_file_dir = rtrim( $this->out_file_dir, '/' );
    }
}  
?>