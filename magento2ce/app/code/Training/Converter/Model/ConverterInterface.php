<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 7/11/17
 * Time: 4:05 PM
 */

namespace Training\Converter\Model;


interface ConverterInterface
{
    /**
     * @param $amount
     * @param $from
     * @param $to
     * @param $ret_value
     * @return  []
     */
    public function convert($amount, $from, $to);

}