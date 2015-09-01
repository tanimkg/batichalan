<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Cause_model extends CI_Model
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
        $this->_db = 'causes';
        $this->_pk = 'cause_id';
    }

    /*
         * @params array
         * @return int|bool
         * */
    function add_step_1($post_values)
    {
        // strip submit key from the array
        unset($post_values['submit']);

        $this->db->insert($this->_db, $post_values);

        if ($this->db->affected_rows() > 0) return $this->db->insert_id();

        return FALSE;
    }


    public function is_crud_authorized($uid, $cause_id)
    {
        $q = $this->db->get_where($this->_db, [$this->_pk => $cause_id, 'created_by_uid' => $uid]);
        if ($q->num_rows() > 0)
        {
            return TRUE;
        }
        return FALSE;
    }

    /*
     * @params array
     * @return int|bool
     * */
    function update($post_values)
    {
        $_update_id = $post_values[$this->_pk];

        // strip submit key and primary key from the array
        unset($post_values['submit']);
        unset($post_values[$this->_pk]);

        // now update where primary key is temp pk (recorded avobe)
        if ($this->db->update($this->_db, $post_values, [$this->_pk => $_update_id])) {
            return $_update_id;
        }

        return FALSE;
    }


    function delete_address($id)
    {
        if ($this->db->delete($this->_db, [$this->_pk, $id])) { return TRUE; } else { return FALSE; }
    }

    function is_created_by_user($uid, $aid)
    {
        $q = $this->db->get_where($this->_db, ['created_by_uid' => $uid, $this->_pk => $aid]);
        if ($q->num_rows() > 0 ) return TRUE;

        return FALSE;
    }

    function get_causes_of_user($uid)
    {
        $q = $this->db->get_where($this->_db, ['created_by_uid' => $uid]);
        if ($q->num_rows()) {
            return $q->result();
        }
    }

    /*
     * @params int
     * @return array| bool
     * */
    function get_cause_by_id($id)
    {
        $q = $this->db->get_where($this->_db, [$this->_pk => $id]);
        if ($q->num_rows() > 0) return $q->row_array();
        return FALSE;
    }


    /*
     * @return bool
     * */
    function check_address_belongs_to_user($uid, $aid)
    {
        $q = $this->db->get_where($this->_db, ['created_by_uid' => $uid, $this->_pk => $aid]);
        if ($q->num_rows() > 0) return TRUE;

        return FALSE;
    }
}
