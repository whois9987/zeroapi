<?php

$string = "<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class " . $c . " extends CI_Controller
{
  function __construct()
  {
      parent::__construct();
      \$this->load->model('$m');
      \$this->load->helper('response');
      \$this->load->library('form_validation');";

        
$string .= "}";

    $string .="\n\n    public function index()
    {
      return response([
        'message' => 'Welcome Api ".$c." '
    ], 200);       
    }";

    $string .="\n\n    public function list()
    {
     \$query =  \$this->".$m."->get_all();
      return response([
        'status' =>  true,
        'error_message' => '',
        'data' => \$query
    ], 200);        
    }";

    $string .="\n\n    public function create()
    {
      \$this->_rules();
      if (\$this->form_validation->run() == FALSE) {
        return response([
          'status' =>  false,
          'error_message' => \$this->form_validation->error_array(),
      ], 400);         
      }else{
        \$data = array(";
        foreach ($non_pk as $row) {
            $string .= "\n\t\t'" . $row['column_name'] . "' => \$this->input->post('" . $row['column_name'] . "'),";
        }
        $string .= "\n\t    );      
        \$query = \$this->".$m."->insert(\$data);
        if (\$query) {
          return response([
            'status' =>  true,
            'error_message' => '',
        ], 200);            
        }else{
          return response([
            'status' =>  false,
            'error_message' => '',
        ], 400); 
        }        
      }

    }";

    $string .="\n\n    public function update()
    {
      \$data = array(";
      foreach ($non_pk as $row) {
          $string .= "\n\t\t'" . $row['column_name'] . "' => \$this->input->post('" . $row['column_name'] . "'),";
      }
      $string .= "\n\t    );      
      \$query =\$this->".$m."->update(\$this->input->post('$pk', TRUE), \$data);
      if (\$query) {
        return response([
          'status' =>  true,
          'error_message' => '',
      ], 200);  
      }else{
        return response([
          'status' =>  false,
          'error_message' => '',
      ], 400); 
      }
    }";



    $string .="\n\n    public function delete()
    {
      \$row = \$this->".$m."->get_by_id(\$this->input->post('id', TRUE));

      if (\$row) {
        \$query =  \$this->".$m."->delete(\$this->input->post('id', TRUE));
        if (\$query) {
          return response([
            'status' =>  true,
            'error_message' => '',
        ], 200);           
        }else{
          return response([
            'status' =>  false,
            'error_message' => 'Delete data failed',
        ], 400);           
        }
      } else {
        return response([
          'status' =>  false,
          'error_message' => 'Data Not Found',
      ], 404);        
      }

    }";


    $string .="\n\n    public function _rules()
    {";
      foreach ($non_pk as $row) {
        $int = $row3['data_type'] == 'int' || $row['data_type'] == 'double' || $row['data_type'] == 'decimal' ? '|numeric' : '';
        $string .= "\n\t\$this->form_validation->set_rules('".$row['column_name']."', '".  strtolower(label($row['column_name']))."', 'trim|required$int');";
    }    
    $string .= "\n\n\t\$this->form_validation->set_rules('$pk', '$pk', 'trim');}";

    

    $string .= "\n\n}\n\n/* End of file $c_file */
    /* Location: ./application/controllers/$c_file */
    /* Created By ".date('Y-m-d H:i:s')." */";




$resultC = createFile($string, $target . "controllers/api/" . $c_file);
