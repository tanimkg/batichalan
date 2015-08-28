<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Address_model extends CI_Model
{

    /**
     * @vars
     */
    private $_db;
    private $_pk;


    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();

        // define primary table
        $this->_db = 'addresses';
    }
    /*
         * @params array
         * @return int|bool
         * */
    function add($post_values)
    {
        // strip submit key from the array
        unset($post_values['submit']);

        $this->db->insert($this->_db, $post_values);

        if ($this->db->affected_rows() > 0) return $this->db->insert_id();

        return FALSE;
    }
    /*
     * @params array
     * @return int|bool
     * */
    function update($post_values)
    {
        $_update_id = $post_values[$this->_pk];

        // strip submit key from the array
        unset($post_values['submit']);
        unset($post_values[$this->_pk]);

        if ($this->db->update($this->_db, $post_values, [$this->_pk => $_update_id])) return TRUE;

        return FALSE;
    }


    function get_addresses_of_user($uid)
    {
        $q = $this->db->get_where($this->_db, ['created_by_uid' => $uid]);
        if ($q->num_rows())
        {
            return $q->result();
        }
    }

}
