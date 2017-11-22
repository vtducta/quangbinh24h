<?php
interface IEmail
{
    /**
     * Constructor
     *
     * @param    array    Initiate class parameters
     * @return    @e void
     */
    public function __construct( $opts=array() );

    /**
     * Clear stored data to prepare a new email. Useful
     *    to prevent having to close/reopen SMTP connection
     *    repeatedly.
     *
     * @return    @e void
     */
    public function clearEmail();
    
    /**
     * Clear stored errors to prepare a new email.
     *
     * @return    @e void
     */
    public function clearError();
    
    /**
     * Set the from email address
     *
     * @param    string        From email address
     * @param    string        [Optional] From display
     * @return    @e boolean
     */
    public function setFrom( $email, $display='' );
    
    /**
     * Set the 'to' email address
     *
     * @param    string        To email address
     * @return    @e boolean
     */
    public function setTo( $email );
    
    /**
     * Add cc's
     *
     * @param    string        CC email address
     * @return    @e boolean
     */
    public function addCC( $email );
    
    /**
     * Add bcc's
     *
     * @param    string        BCC email address
     * @return    @e boolean
     */
    public function addBCC( $email );
    
    /**
     * Set the email subject
     *
     * @param    string        Email subject
     * @return    @e boolean
     */
    public function setSubject( $subject );
    
    /**
     * Set the email body
     *
     * @param    string        Email body
     * @return    @e boolean
     */
    public function setBody( $body );
    
    /**
     * Set a header manually
     *
     * @param    string        Header key
     * @param    string        Header value
     * @return    @e boolean
     */
    public function setHeader( $key, $value );
    
    /**
     * Send the mail (All appropriate params must be set by this point)
     *
     * @return    @e boolean
     */
    public function sendMail();
    
    /**
     * Add an attachment to the current email
     *
     * @param    string    File data
     * @param    string    File name
     * @param    string    File type (MIME)
     * @return    @e void
     */
    public function addAttachment( $data="", $name="", $ctype='application/octet-stream' );
}    
?>