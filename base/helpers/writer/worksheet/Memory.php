<?php
/**
 * PHPExcel
 *
 * Copyright (c) 2006 - 2011 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel_CachedObjectStorage
 * @copyright  Copyright (c) 2006 - 2011 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    1.7.6, 2011-02-27
 */


/**
 * PHPExcel_CachedObjectStorage_Memory
 *
 * @category   PHPExcel
 * @package    PHPExcel_CachedObjectStorage
 * @copyright  Copyright (c) 2006 - 2011 PHPExcel (http://www.codeplex.com/PHPExcel)
 */
class PHPExcel_CachedObjectStorage_Memory extends PHPExcel_CachedObjectStorage_CacheBase implements PHPExcel_CachedObjectStorage_ICache {

    /**
     *	Add or Update a cell in cache identified by coordinate address
     *
     *	@param	string			$pCoord		Coordinate address of the cell to update
     *	@param	PHPExcel_Cell	$cell		Cell to update
	 *	@return	void
     *	@throws	Exception
     */
	public function addCacheData($pCoord, PHPExcel_Cell $cell) {
		$this->_cellCache[$pCoord] = $cell;
		return $cell;
	}	//	function addCacheData()


    /**
     * Get cell at a specific coordinate
     *
     * @param 	string 			$pCoord		Coordinate of the cell
     * @throws 	Exception
     * @return 	PHPExcel_Cell 	Cell that was found, or null if not found
     */
	public function getCacheData($pCoord) {
		//	Check if the entry that has been requested actually exists
		if (!isset($this->_cellCache[$pCoord])) {
			//	Return null if requested entry doesn't exist in cache
			return null;
		}

		//	Return requested entry
		return $this->_cellCache[$pCoord];
	}	//	function getCacheData()


	public function copyCellCollection(PHPExcel_Worksheet $parent) {
		parent::copyCellCollection($parent);

		$newCollection = array();
		foreach($this->_cellCache as $k => &$cell) {
			$newCollection[$k] = clone $cell;
			$newCollection[$k]->attach($parent);
		}

		$this->_cellCache = $newCollection;
	}


	public function unsetWorksheetCells() {
		//	Because cells are all stored as intact objects in memory, we need to detach each one from the parent
		foreach($this->_cellCache as $k => &$cell) {
			$cell->detach();
			$this->_cellCache[$k] = null;
		}
		unset($cell);

		$this->_cellCache = array();

		//	detach ourself from the worksheet, so that it can then delete this object successfully
		$this->_parent = null;
	}	//	function unsetWorksheetCells()

}
class PHPExcel_CachedObjectStorage_CacheBase {

    /**
     *    Parent worksheet
     *
     *    @var PHPExcel_Worksheet
     */
    protected $_parent;

    /**
     *    The currently active Cell
     *
     *    @var PHPExcel_Cell
     */
    protected $_currentObject = null;

    /**
     *    Coordinate address of the currently active Cell
     *
     *    @var string
     */
    protected $_currentObjectID = null;


    /**
     *    An array of cells or cell pointers for the worksheet cells held in this cache,
     *        and indexed by their coordinate address within the worksheet
     *
     *    @var array of mixed
     */
    protected $_cellCache = array();


    public function __construct(PHPExcel_Worksheet $parent) {
        //    Set our parent worksheet.
        //    This is maintained within the cache controller to facilitate re-attaching it to PHPExcel_Cell objects when
        //        they are woken from a serialized state
        $this->_parent = $parent;
    }    //    function __construct()


    /**
     *    Is a value set in the current PHPExcel_CachedObjectStorage_ICache for an indexed cell?
     *
     *    @param    string        $pCoord        Coordinate address of the cell to check
     *    @return    void
     *    @return    boolean
     */
    public function isDataSet($pCoord) {
        if ($pCoord === $this->_currentObjectID) {
            return true;
        }
        //    Check if the requested entry exists in the cache
        return isset($this->_cellCache[$pCoord]);
    }    //    function isDataSet()


    /**
     *    Add or Update a cell in cache
     *
     *    @param    PHPExcel_Cell    $cell        Cell to update
     *    @return    void
     *    @throws    Exception
     */
    public function updateCacheData(PHPExcel_Cell $cell) {
        return $this->addCacheData($cell->getCoordinate(),$cell);
    }    //    function updateCacheData()


    /**
     *    Delete a cell in cache identified by coordinate address
     *
     *    @param    string            $pCoord        Coordinate address of the cell to delete
     *    @throws    Exception
     */
    public function deleteCacheData($pCoord) {
        if ($pCoord === $this->_currentObjectID) {
            $this->_currentObject->detach();
            $this->_currentObjectID = $this->_currentObject = null;
        }

        if (is_object($this->_cellCache[$pCoord])) {
            $this->_cellCache[$pCoord]->detach();
            unset($this->_cellCache[$pCoord]);
        }
    }    //    function deleteCacheData()


    /**
     *    Get a list of all cell addresses currently held in cache
     *
     *    @return    array of string
     */
    public function getCellList() {
        return array_keys($this->_cellCache);
    }    //    function getCellList()


    /**
     *    Sort the list of all cell addresses currently held in cache by row and column
     *
     *    @return    void
     */
    public function getSortedCellList() {
        $sortKeys = array();
        foreach (array_keys($this->_cellCache) as $coord) {
            list($column,$row) = sscanf($coord,'%[A-Z]%d');
            $sortKeys[sprintf('%09d%3s',$row,$column)] = $coord;
        }
        ksort($sortKeys);

        return array_values($sortKeys);
    }    //    function sortCellList()


    protected function _getUniqueID() {
        if (function_exists('posix_getpid')) {
            $baseUnique = posix_getpid();
        } else {
            $baseUnique = mt_rand();
        }
        return uniqid($baseUnique,true);
    }

    /**
     *    Clone the cell collection
     *
     *    @return    void
     */
    public function copyCellCollection(PHPExcel_Worksheet $parent) {
        $this->_parent = $parent;
        if ((!is_null($this->_currentObject)) && (is_object($this->_currentObject))) {
            $this->_currentObject->attach($parent);
        }
    }    //    function copyCellCollection()

}
interface PHPExcel_CachedObjectStorage_ICache
{
    /**
     *    Add or Update a cell in cache identified by coordinate address
     *
     *    @param    string            $pCoord        Coordinate address of the cell to update
     *    @param    PHPExcel_Cell    $cell        Cell to update
     *    @return    void
     *    @throws    Exception
     */
    public function addCacheData($pCoord, PHPExcel_Cell $cell);

    /**
     *    Add or Update a cell in cache
     *
     *    @param    PHPExcel_Cell    $cell        Cell to update
     *    @return    void
     *    @throws    Exception
     */
    public function updateCacheData(PHPExcel_Cell $cell);

    /**
     *    Fetch a cell from cache identified by coordinate address
     *
     *    @param    string            $pCoord        Coordinate address of the cell to retrieve
     *    @return PHPExcel_Cell     Cell that was found, or null if not found
     *    @throws    Exception
     */
    public function getCacheData($pCoord);

    /**
     *    Delete a cell in cache identified by coordinate address
     *
     *    @param    string            $pCoord        Coordinate address of the cell to delete
     *    @throws    Exception
     */
    public function deleteCacheData($pCoord);

    /**
     *    Is a value set in the current PHPExcel_CachedObjectStorage_ICache for an indexed cell?
     *
     *    @param    string        $pCoord        Coordinate address of the cell to check
     *    @return    void
     *    @return    boolean
     */
    public function isDataSet($pCoord);

    /**
     *    Get a list of all cell addresses currently held in cache
     *
     *    @return    array of string
     */
    public function getCellList();

    /**
     *    Get the list of all cell addresses currently held in cache sorted by column and row
     *
     *    @return    void
     */
    public function getSortedCellList();

    /**
     *    Clone the cell collection
     *
     *    @return    void
     */
    public function copyCellCollection(PHPExcel_Worksheet $parent);

}