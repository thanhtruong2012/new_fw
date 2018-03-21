<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 3/21/2018
 * Time: 9:25 AM
 */

class BookingModel extends Model
{
    public $table_name = "m002_booking";
    public $primary_key = array("booking_id");
    public function __construct()
    {
        parent::__construct();
    }

}