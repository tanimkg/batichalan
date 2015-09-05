<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Promote_model extends CI_Model
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
        $this->_db = 'promotes';
        $this->_pk = 'promote_id';
    }

    /*
         * @params array
         * @return int|bool
         * */
    function add($post_values)
    {
        // strip submit key from the array
        unset($post_values['submit']);
        unset($post_values['promote_id']);

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



    function get_recents($last_id = NULL, $limit = 10)
    {
        // return the last id so that next time accessing this method retrieves
        // results having less than the last_id, thats how we are getting recent posts
        if ($last_id == NULL) { $last_id = $this->get_latest_id(); }
        $this->db->where($this->_pk . ' <', $last_id);
        $this->db->order_by($this->_pk . ' desc');
        $this->db->limit($limit);
        $q = $this->db->get($this->_db);
        $r = $q->result_array();
        $last_row = $q->last_row('array');
        $latest_id = $last_row[$this->_pk];

        $r['last_id'] = $latest_id;

        return $r;

    }

    function get_latest_id()
    {
        $this->db->select($this->_pk);
        $this->db->where('created_at <', mdate('%Y-%m-%d %H:%i:%s', time()));
        //$this->db->or_where('updated_at <', mdate('%Y-%m-%d %H:%i:%s', time()));
        $this->db->order_by($this->_pk .' desc');
        $this->db->limit(1);
        $q = $this->db->get($this->_db);

        $r = $q->row_array();
        return $r[$this->_pk];
    }



    function delete($id)
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
    function get_promote_by_id($id)
    {
        $q = $this->db->get_where($this->_db, [$this->_pk => $id]);
        if ($q->num_rows() > 0) return $q->row_array();
        return FALSE;
    }

}
