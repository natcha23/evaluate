<?php
/**
 * @file: Abstract.php
 * @created: 2008-03-26
 * @modified:
 * @author: Nattakorn Samnuan
 * @email: nattakorn@icesolution.com
 * @description:
 */

abstract class Workflow_Menu_Abstract
{
    /**
     * Singleton pattern implementation makes 'new' unavailable
     *
     * @return void
     */
    public function __construct()
    {
    }


    abstract public function topMenuFormat(&$dataArray, &$smarty);
}