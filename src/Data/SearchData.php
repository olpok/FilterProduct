<?php

namespace App\Data;

class SearchData
{
    /**
     * page
     * @var integer
     */
    public $page = 1;

    /**
     * mot-clé
     * @var string
     */
    public $q = '';

    /**
     *
     * @var array //Category []
     */
    public $categories = [];

    /**
     * prix max
     *
     * @var null|integer
     */
    public $max;

    /**
     * prix min
     *
     * @var null|integer
     */
    public $min;

    /**
     * en promo
     *
     * @var boolean
     */
    public $promo = false;


}