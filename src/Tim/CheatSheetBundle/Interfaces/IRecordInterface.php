<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 01.08.2015
 * Time: 20:38
 */

namespace Tim\CheatSheetBundle\Interfaces;

interface IRecordInterface
{
    public function get($id);

    public function getList($options = array());
}