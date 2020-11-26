<?php

defined('BASEPATH') or exit('No direct script access allowed');

use Sk\Geohash\Geohash;


class GeoFire
{
    protected $ci;

    public function __construct()
    {
        $this->ci = &get_instance();
        require_once(APPPATH . 'third_party/geohash/Geohash.php');
    }

    public function generate($lat, $long)
    {
        $g = new Geohash();
        return $g->encode($lat, $long, 10);
    }
}

/* End of file GeoHash.php */
