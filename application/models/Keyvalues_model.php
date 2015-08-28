<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Keyvalues_model extends CI_Model
{

    /**
     * @vars
     */
    private $_db;


    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();

        // define primary table
        $this->_db = 'key_values';
    }

    /*
     * @return array
     * */
    public function get_contact_types()
    {

        return $this->get_key_values_where_identifier('contact_type');
    }


    /*
     * @return array
     * */
    public function get_privacy_types()
    {

        return $this->get_key_values_where_identifier('privacy');
    }


    /*
     * Returns dropdown friendly array, php arr key = html option text, php arr value = html value
     * @return array
     * */
    public function get_key_values_where_identifier($identifier)
    {
        $res_array = array();
        $q = $this->db->get_where($this->_db, ['identifier' => $identifier]);
        foreach ($q->result() as $row)
        {
            $res_array[$row->value] = $row->key;
        }

        return $res_array;
    }
}