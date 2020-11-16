
<?php
class Excel_export_model extends CI_Model
{
 function fetch_data()
 {
    $this->load->model('Fed_model');
    $this->db->select('*');
    $this->db->from('frk');
    $this->db->join('fed','frk.id=fed.frk_id','inner');
    $this->db->where('fed.user_email',$_SESSION["fed"]);
    $query=$this->db->get();
    $data['Fed'] = $query->result_array();
    return $data['Fed'];
 }

 
}
