<?php
/**
 * Email : binhlt@netlink.vn
 * Yahoo : kph_kph@yahoo.com
 * Skype : kw_kenchan
 * Facebook : facebook.com/kenny.netlink
 * Phone : +84902245620
 * 
 * Init define value , load base package                                          
 *
 * @author         $Author: kenchan ak binhlt $
 * @copyright    (c) kenchan
 * @package        K-CMS
 * @since        Tue. 06th April 2010  
 *
 */
 
//-----------------------------------------
// define global value
//-----------------------------------------

// root
define('PATH_APP_ROOT', __DIR__ . DS );
define('PATH_APP_BASE', __DIR__ . DS . '..' . DS . 'base' . DS );
// config
define('PATH_APP_CONFIGS', PATH_APP_ROOT . 'src' . DS . 'configs' . DS );
define('PATH_APP_LANGS', PATH_APP_ROOT . 'src' . DS . 'langs' . DS );
define('PATH_APP_TEMPLATE', PATH_APP_ROOT . 'html' . DS . 'templates' . DS);
define('PATH_APP_TEMPLATE_CACHE', PATH_APP_ROOT . 'cache' . DS . 'templates' . DS);
define('PATH_APP_SQLERROR', PATH_APP_ROOT . 'cache' . DS . 'sqlerror' . DS);
define('PATH_APP_MODULE', PATH_APP_ROOT . 'src' . DS . 'modules' . DS);      

// base
define('PATH_APP_BASE_MODEL', PATH_APP_BASE . 'models' . DS);
define('PATH_APP_BASE_HELPER', PATH_APP_BASE . 'helpers' . DS);
define('PATH_APP_BASE_BEAN', PATH_APP_BASE . 'beans' . DS);
 //lib excel
//writer_root
define('PATH_EXPORT_PHPEXCEL', PATH_APP_BASE_HELPER .'writer'. DS . 'PHPExcel.php');
define('PATH_EXPORT_WORKSHEETINTERATOR',PATH_APP_BASE_HELPER.'writer'.DS.'WorksheetIterator.php');
define('PATH_EXPORT_HASHTABLE',PATH_APP_BASE_HELPER.'writer'.DS.'HashTable.php');
define('PATH_EXPORT_SETTINGS',PATH_APP_BASE_HELPER.'writer'.DS.'Settings.php');
define('PATH_EXPORT_PDF', PATH_APP_BASE_HELPER . 'writer' . DS . 'PDF.php'); 
define('PATH_EXPORT_IOFACTORY', PATH_APP_BASE_HELPER . 'writer' . DS . 'IOFactory.php');
define('PATH_EXPORT_HTML', PATH_APP_BASE_HELPER . 'writer' . DS . 'HTML.php');

//shared
define('PATH_EXPORT_ZIPSTREAMWRAPPER', PATH_APP_BASE_HELPER . 'writer' .DS. 'shared'.DS.'ZipStreamWrapper.php');
define('PATH_EXPORT_STRING',PATH_APP_BASE_HELPER . 'writer' . DS.'shared'.DS.'String.php');
define('PATH_EXPORT_XMLWRITER',PATH_APP_BASE_HELPER . 'writer' . DS.'shared'.DS.'XMLWriter.php');
define('PATH_EXPORT_DATE',PATH_APP_BASE_HELPER . 'writer' . DS.'shared'.DS.'Date.php');
define('PATH_EXPORT_PDF_TCPDF',PATH_APP_BASE_HELPER . 'writer' . DS.'shared'.DS.'PDF'.DS.'tcpdf.php');
define('PATH_EXPORT_PDF_CONFIG',PATH_APP_BASE_HELPER . 'writer' . DS.'shared'.DS.'PDF'.DS.'config'.DS.'tcpdf_config.php');

//calculation
define('PATH_EXPORT_CALCULATION', PATH_APP_BASE_HELPER . 'writer' . DS . 'Calculation.php');
define('PATH_EXPORT_CALCULATION_FUNCTION', PATH_APP_BASE_HELPER . 'writer'.DS.'Calculation'.DS.'Function.php');
define('PATH_EXPORT_CALCULATION_FUNCTIONS', PATH_APP_BASE_HELPER . 'writer'.DS.'Calculation'.DS.'Functions.php');

//autoloader
define('PATH_EXPORT_AUTOLOADER',PATH_APP_BASE_HELPER.'writer'.DS.'Autoloader.php');

//excel2007
define('PATH_EXPORT_EXCEL2007', PATH_APP_BASE_HELPER . 'writer' . DS . 'Excel2007.php');
define('PATH_EXPORT_STRINGTABLE',PATH_APP_BASE_HELPER.'writer'.DS.'excel2007'.DS. 'StringTable.php');
define('PATH_EXPORT_WRITEPART',PATH_APP_BASE_HELPER.'writer'.DS.'excel2007'.DS. 'WriterPart.php');
define('PATH_EXPORT_CONTENTTYPES',PATH_APP_BASE_HELPER.'writer'.DS.'excel2007'.DS.'ContentTypes.php');
define('PATH_EXPORT_DOCPROPS',PATH_APP_BASE_HELPER.'writer'.DS.'excel2007'.DS.'DocProps.php');
define('PATH_EXPORT_RELS',PATH_APP_BASE_HELPER.'writer'.DS.'excel2007'.DS.'Rels.php');
define('PATH_EXPORT_THEME',PATH_APP_BASE_HELPER.'writer'.DS.'excel2007'.DS.'Theme.php');
define('PATH_EXPORT_EXCELL2007_STYLE',PATH_APP_BASE_HELPER.'writer'.DS.'excel2007'.DS.'Style.php');
define('PATH_EXPORT_EXCELL2007_WORKBOOK',PATH_APP_BASE_HELPER.'writer'.DS.'excel2007'.DS.'Workbook.php');
define('PATH_EXPORT_EXCELL2007_WORKSHEET',PATH_APP_BASE_HELPER.'writer'.DS.'excel2007'.DS.'Worksheet.php');
define('PATH_EXPORT_EXCELL2007_DRAWING',PATH_APP_BASE_HELPER.'writer'.DS.'excel2007'.DS.'Drawing.php');
define('PATH_EXPORT_EXCELL2007_COMMENTS',PATH_APP_BASE_HELPER.'writer'.DS.'excel2007'.DS.'Comments.php');

//worksheet
define('PATH_EXPORT_WORKSHEET', PATH_APP_BASE_HELPER . 'writer' . DS . 'Worksheet.php');
define('PATH_EXPORT_REFERENCEHELPER',PATH_APP_BASE_HELPER . 'writer'.DS.'worksheet'.DS.'ReferenceHelper.php');
define('PATH_EXPORT_COSF',PATH_APP_BASE_HELPER . 'writer' . DS .'worksheet'.DS.'CachedObjectStorageFactory.php');
define('PATH_EXPORT_MEMORY', PATH_APP_BASE_HELPER . 'writer' . DS . 'worksheet'.DS.'Memory.php');
define('PATH_EXPORT_PAGESETUP', PATH_APP_BASE_HELPER . 'writer' . DS . 'worksheet'.DS.'PageSetup.php');
define('PATH_EXPORT_PAGEMARGINS', PATH_APP_BASE_HELPER . 'writer' . DS .'worksheet'.DS.'PageMargins.php');
define('PATH_EXPORT_HEADERFOOTER', PATH_APP_BASE_HELPER . 'writer' . DS .'worksheet'.DS.'HeaderFooter.php');
define('PATH_EXPORT_SHEETVIEW', PATH_APP_BASE_HELPER . 'writer' . DS .'worksheet'.DS.'SheetView.php');
define('PATH_EXPORT_PROTECTION', PATH_APP_BASE_HELPER . 'writer' . DS .'worksheet'.DS.'Protection.php');
define('PATH_EXPORT_ROWDIMENSION', PATH_APP_BASE_HELPER . 'writer' . DS .'worksheet'.DS.'RowDimension.php');
define('PATH_EXPORT_COLUMNDIMENSION', PATH_APP_BASE_HELPER . 'writer' . DS .'worksheet'.DS.'ColumnDimension.php');
define('PATH_EXPORT_DOCUMENTPROPERTIES', PATH_APP_BASE_HELPER . 'writer' . DS.'worksheet'.DS.'DocumentProperties.php');
define('PATH_EXPORT_DOCUMENTSECURITY', PATH_APP_BASE_HELPER . 'writer' . DS.'worksheet'.DS.'DocumentSecurity.php');

//style
define('PATH_EXPORT_STYLE', PATH_APP_BASE_HELPER . 'writer' . DS . 'Style.php');
define('PATH_EXPORT_FONT', PATH_APP_BASE_HELPER . 'writer' . DS . 'style' . DS. 'Font.php');
define('PATH_EXPORT_COLOR', PATH_APP_BASE_HELPER . 'writer' . DS . 'style' .DS.'Color.php');
define('PATH_EXPORT_FILL', PATH_APP_BASE_HELPER . 'writer' . DS . 'style' .DS.'Fill.php');
define('PATH_EXPORT_BORDERS', PATH_APP_BASE_HELPER . 'writer' . DS . 'style' .DS. 'Borders.php');
define('PATH_EXPORT_BORDER', PATH_APP_BASE_HELPER . 'writer' . DS . 'style' .DS. 'Border.php');
define('PATH_EXPORT_ALIGNMENT', PATH_APP_BASE_HELPER . 'writer' . DS . 'style' .DS. 'Alignment.php');
define('PATH_EXPORT_NUMBERFORMAT', PATH_APP_BASE_HELPER . 'writer' . DS . 'style' .DS. 'NumberFormat.php');
define('PATH_EXPORT_STYLE_PROTECTION',PATH_APP_BASE_HELPER . 'writer' . DS . 'style' .DS. 'Protection.php');

//cell
define('PATH_EXPORT_CELL', PATH_APP_BASE_HELPER . 'writer' . DS . 'Cell.php');
define('PATH_EXPORT_CELL_DATATYPE', PATH_APP_BASE_HELPER . 'writer' .DS. 'cell' .DS. 'DataType.php');
define('PATH_EXPORT_CELL_DEFAULT_VALUE_BINDER', PATH_APP_BASE_HELPER . 'writer' .DS. 'cell' .DS. 'DefaultValueBinder.php');
define('PATH_EXPORT_CELL_I_VALUE_BINDER', PATH_APP_BASE_HELPER . 'writer' .DS. 'cell' .DS. 'IValueBinder.php');

//FPDF
define('PATH_EXPORT_FPDF', PATH_APP_BASE_HELPER .'writer'.DS.'FPDF'.DS.'fpdf.php');

date_default_timezone_set('Asia/Bangkok');
ini_set('session.name', "cms_ndt1");
//ini_set("session.cookie_domain","admincms.nguoiduatin.vn");
//session_set_cookie_params(3600*24, '/', 'admincms.nguoiduatin.vn');
?>
