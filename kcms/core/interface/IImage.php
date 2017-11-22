<?php
interface IImage
{
    /**
     * Initiate image handler, perform any necessary setup
     *
     * @param    array         Necessary options to init module
     * @return    @e boolean
     */
    public function init( $opts=array() );
    
    /**
     * Add a supported image type (assumes you have properly extended the class to add the support)
     *
     * @param    string         Image extension type to add support for
     * @return    @e boolean
     */
    public function addImagetype( $ext );
    
    /**
     * Resizes and image, then crops an image to a fixed ratio
     *
     * @param    int        Width of final cropped image
     * @param    int        Height of final cropped image
     * @param    @e array
     */
    public function croppedResize( $width, $height );

    /**
     * Crops an image
     *
     * @param    int            Crop from X
     * @param    int            Crop from Y
     * @param    int            Width
     * @param    int            Height
     * @return    @e array
     */
    public function crop( $x1, $y1, $width, $height );

    /**
     * Resize image proportionately
     *
     * @param    integer     Maximum width
     * @param    integer     Maximum height
     * @param    boolean        Second pass of image for crop
     * @param    boolean        Instead of resizing image to same size, return false if the image doesn't need to be resized
     * @param    array        Canvas size - if larger than resized image, image will be placed in the center
     * @return    @e array
     */
    public function resizeImage( $width, $height, $secondPass=false, $returnIfUnnecessary=false, $canvas=array() );
    
    /**
     * Write image to file
     *
     * @param    string         File location (including file name)
     * @return    @e boolean
     */
    public function writeImage( $path );
    
    /**
     * Print image to screen
     *
     * @return    @e void
     */
    public function displayImage();
    
    /**
     * Add watermark to image
     *
     * @param    string         Watermark image path
     * @param    integer        [Optional] Opacity 0-100
     * @return    @e boolean
     */
    public function addWatermark( $path, $opacity=100 );
    
    /**
     * Add copyright text to image
     *
     * @param    string         Copyright text to add
     * @param    array        [Optional] Text options (color, background color, font [1-5])
     * @return    @e boolean
     */
    public function addCopyrightText( $text, $textOpts=array() );

}  
?>