<?php
/*
 * Created on 3 �.�. 2008
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

/**
 * This is about <code>Image.php</code>.
 *
 * @category package_declaration
 * @package package_name
 * @author Nattakorn Samnuan
 */
class Workflow_Services_Image {
	/**
     * Singleton instance
     *
     * @var package_name
     */
    protected static $_instance = null;

	/**
     * Singleton pattern implementation makes "new" unavailable
     *
     * @return void
     */
    private function __construct(){
        // TODO
    }

     /**
     * Returns an instance of package_name
     *
     * Singleton pattern implementation
     *
     * @return package_name Provides a fluent interface
     */
    public static function getInstance()
    {
        if (null === self::$_instance) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public static function resizeJpg($settings=array()) {

        $img = $settings['image'];
        $w   = $settings['width'];
        $h   = $settings['height'];

        if(!file_exists($img)) return;

        header("content-type:image/jpeg");
		$src_img = imagecreatefromjpeg($img);
		$getsize = getimagesize($img);
		$old_w   = $getsize[0];
		$old_h   = $getsize[1];

		if (($old_w < $w) and ($old_h < $h)) {
		    $new_h = $old_h;
		    $new_w = $old_w;
		} else {
			if ($old_w > $old_h) {
				$how   = $old_w/$w;
				$new_w = floor($old_w/$how);
				$new_h = floor($old_h/$how);
			} else {
				$how   = $old_h/$h;
				$new_w = floor($old_w/$how);
				$new_h = floor($old_h/$how);
			}
		}

		$dst_img = imagecreatetruecolor($new_w,$new_h);
		imagecopyresampled($dst_img,$src_img,0,0,0,0,$new_w,$new_h,$old_w,$old_h);

		imagejpeg($dst_img,'',90);
		imagedestroy($src_img);
		imagedestroy($dst_img);
    }
}