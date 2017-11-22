<?php
/**    
 * Email : kph.acc@gmail.com
 * Yahoo : kph_kph@yahoo.com
 * Phone : +84902245620
 * 
 * Interface module                                            
 *
 * @author         $Author: kenchan ak binhlt $
 * @copyright    (c) kenchan
 * @package        K-CMS
 * @since        Tue. 06th April 2010  
 *
 */
   
interface IModule
{
    /**
    * Constructor
    *
    * @access       public  
    * @param        array       array of params       
    * @return       void
    */
    public function __construct($params);
    
    /**
    * run module
    *
    * @access       public
    * @param        array         
    * @return       void
    */
    public function run();
    
    /**
    * run when module's destroyed
    *
    * @access       public
    * @param        array         
    * @return       void
    */
    public function destroyed();
}
?>