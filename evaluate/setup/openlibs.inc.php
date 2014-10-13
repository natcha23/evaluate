<?php
/*
 * Created on Feb 29, 2008
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
class OpenLibraries {

    protected $basePath = LIBRARY_PATH;

    protected $librariesDirectory = array(
        "zend"=>"ZendFramework/@version/library",
        "smarty"=>"Smarty/@version/libs",
        "dbtree"=>"dbtree/@version",
        "nusoap"=>"nusoap/@version/lib",
        "phpsniff"=>"phpsniff/@version",
        "jpgraph" =>"jpgraph/@version/src"
    );

    protected $librariesVersion = array(
        "zend"=>"zend",
        "smarty"=>"smarty",
        "dbtree"=>"dbtree",
        "nusoap"=>"nusoap",
        "phpsniff"=>"phpsniff",
        "jpgraph"=>"jpgraph"
    );

 	public function __construct($params=array()) {
        $this->_setup($params);
 	}

    protected function _setup(&$params) {
        foreach($params as $lib=>$version) {
            if($this->librariesVersion[$lib]==$lib) {
                $this->librariesVersion[$lib]=$version;
                $this->_setupPath($lib,$version);
            }
        }
        $this->_clear();
    }

    private function _setupPath($lib,$version) {
        $this->librariesDirectory[$lib]= preg_replace("/\@version/i",$version,"{$this->basePath}{$this->librariesDirectory[$lib]}");
    }

    private function _clear() {
    	foreach($this->librariesDirectory as $lib=>$dir) {
    		if(preg_match("/\@version/i",$dir)) unset($this->librariesDirectory[$lib]);
    	}
    }

    public function getLibrariesPath() {
    	return $this->librariesDirectory;
    }

    public function setIncludePath() {
        foreach($this->librariesDirectory as $lib=>$path) {
    	    set_include_path(get_include_path().PATH_SEPARATOR.$path);
        }
    }

    public function getZendFramework() {
    	//
    }

    public function getSmartyPath() {
        return $this->librariesDirectory["smarty"];
    }

    public function getDbTree() {
        //
    }

    public function getPhpSniff() {
        //
    }
}