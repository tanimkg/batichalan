<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Contactno_model extends CI_Model
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
        $this->_db = 'contacts';
        $this->_pk = 'contact_id';
    }

    /*
     * @return bool
     * */
    function check_contact_belongs_to_user($uid, $cid)
    {
        $q = $this->db->get_where($this->_db, ['created_by_uid' => $uid, 'contact_id' => $cid, 'deleted' => 0]);
        if ($q->num_rows() > 0) return TRUE;

        return FALSE;
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

    /*
     * @params int
     * @return array
     * */
    function get_contact_by_id($cid)
    {
        $q = $this->db->get_where($this->_db, ['contact_id' => $cid, 'deleted' => '0']);
        if ($q->num_rows())
        {
            return $q->row_array();
        }
    }


    function get_only_number_by_id($id)
    {
        $q = $this->get_contact_by_id($id);
        return $q['no'];
    }


    function is_valid($id)
    {
        $q = $this->db->get_where($this->_db, [$this->_pk => $id]);

        if ($q->num_rows() > 0) return TRUE;

        return FALSE;
    }


    /*
     * @params int
     * @return obj
     * */
    function get_contacts_of_user($uid)
    {
        $q = $this->db->get_where($this->_db, ['created_by_uid' => $uid, 'deleted' => '0']);
        if ($q->num_rows())
        {
            return $q->result();
        }
    }


    function soft_delete_contact($id)
    {
        $this->db->where($this->_pk, $id);
        $this->db->update($this->_db, ['deleted' => 1]);
        if ($this->db->affected_row() > 0) return TRUE;

        return FALSE;
    }
}