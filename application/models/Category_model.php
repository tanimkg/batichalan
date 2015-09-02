<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model
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
        $this->_db = 'categories';
        $this->_pk = 'cat_id';
    }

    function get_categories($supercluster = NULL)
    {
        $this->db->select('category');
        $this->db->from($this->_db);
        $this->db->order_by('category');
        if ($supercluster == NULL) {
            $this->db->where(['parent_cat' => '-1']);
        } else {
            $this->db->where(['supercluster' => $supercluster, 'parent_cat' => '-1']); // select only main categories and this service related
        }
        $q = $this->db->get();

        return $q->result_array();
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


    function delete($id)
    {
        if ($this->db->delete($this->_db, [$this->_pk, $id])) { return TRUE; } else { return FALSE; }
    }
    /*
     * @params int
     * @return array| bool
     * */
    function get_category_by_id($id)
    {
        $q = $this->db->get_where($this->_db, [$this->_pk => $id]);
        if ($q->num_rows() > 0) return $q->row_array();
        return FALSE;
    }

}
