<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require FCPATH . 'vendor/autoload.php';

class Msite extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function insert_data($data)
    {
        $this->db->insert_batch('tbldapan', $data);
    }
    public function insert_sv_answer($data)
    {
        $query = "INSERT INTO `tbl_sv_`(`STT`, `sMaSV`, `iSoPhach`, `sMaDe`, `1`, `2`, `3`, `4`, `5`, `6`, `7`, `8`, `9`, `10`, `11`, `12`, `13`, `14`, `15`, `16`, `17`, `18`, `19`, `20`, `21`, `22`, `23`, `24`, `25`, `26`, `27`, `28`, `29`, `30`, `31`, `32`, `33`, `34`, `35`, `36`, `37`, `38`, `39`, `40`) VALUES ";
        for ($i = 0; $i < count($data); $i++) {
            $query .= "('" . $data[$i]['STT'] . "','" . $data[$i]['sMaSV'] . "','" . $data[$i]['iSoPhach'] . "','" . $data[$i]['sMaDe'] . "','" . $data[$i]['1'] . "','" . $data[$i]['2'] . "','" . $data[$i]['3'] . "','" . $data[$i]['4'] . "','" . $data[$i]['5'] . "','" . $data[$i]['6'] . "','" . $data[$i]['7'] . "','" . $data[$i]['8'] . "','" . $data[$i]['9'] . "','" . $data[$i]['10'] . "','" . $data[$i]['11'] . "','" . $data[$i]['12'] . "','" . $data[$i]['13'] . "','" . $data[$i]['14'] . "','" . $data[$i]['15'] . "','" . $data[$i]['16'] . "','" . $data[$i]['17'] . "','" . $data[$i]['18'] . "','" . $data[$i]['19'] . "','" . $data[$i]['20'] . "','" . $data[$i]['21'] . "','" . $data[$i]['22'] . "','" . $data[$i]['23'] . "','" . $data[$i]['24'] . "','" . $data[$i]['25'] . "','" . $data[$i]['26'] . "','" . $data[$i]['27'] . "','" . $data[$i]['28'] . "','" . $data[$i]['29'] . "','" . $data[$i]['30'] . "','" . $data[$i]['31'] . "','" . $data[$i]['32'] . "',";
            $query .= "'" . $data[$i]['33'] . "','" . $data[$i]['34'] . "','" . $data[$i]['35'] . "','" . $data[$i]['36'] . "','" . $data[$i]['37'] . "','" . $data[$i]['38'] . "','" . $data[$i]['39'] . "','" . $data[$i]['40'] . "')";
            
            if ($i != count($data) - 1) {
                $query.=",";
            } 
        }

        $this->db->query($query);
        // echo $query;
    }
    public function showArr($arr)
    {
        echo "<pre>";
        print_r($arr);
        echo "</pre>";
    }
}
