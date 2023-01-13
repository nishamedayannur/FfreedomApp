<?php
class Employee extends CI_Model {

    public function get_employees_list()
    {
        $query = $this->db->get('employees');
        return $query->result();
    }

    public function get_filter_list($input)
    {
        $query = $this->db->select('*')->from('employees')->where('id',$input)->or_where("(name LIKE '%".$input."%')", NULL, FALSE)->get();
        return $query->result();
    }

    public function get_employees_list_by_role($role)
    {
        $query = $this->db->get_where('employees', ['role' => $role]);
        return $query->result();
    }
    public function get_rep_emp($id)
    {
        $data = $this->get_emp($id);
        //echo "<pre>";print_r($data);die;
        return $data; 
    }
    
    public function get_emp($id) 
    {
        $return = array();
        $query = $this->db->get_where('employees', ['parent_id' => $id]);
        $result = $query->result_array();
        //echo "<pre>";print_r($result);
        if($query->num_rows() > 0)
        {
            foreach($result as $key => $row)
            {
                //echo "<pre>";print_r($row->id);die;
                $return[$row['id']] = $row;
                $return[$row['id']]['children'] = $this->get_emp($row['id']);
            }
        } 
        //echo "<pre>";print_r($return); 
        return $return;
    }

    public function change_status($input, $status)
    {
        if($status == 1)
        {
            $status = 0;
        }
        else
        {
            $status = 1;
        }
        $data['status'] = $status;
        $this->db->where('id', $input);
        $this->db->update('employees', $data);
    }

}