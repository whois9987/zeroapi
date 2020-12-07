<?php 

$string = "<?php  defined('BASEPATH') or exit('No direct script access allowed');

function response(\$callResponse, \$statusHeader)
{
  \$ci = &get_instance();
  \$ci->output->set_content_type('application/json');
  \$ci->output->set_status_header(\$statusHeader);
  \$ci->output->set_output(json_encode(\$callResponse));
}


/* End of file response_helper.php */
/* Location: ./application/helpers/response_helper.php */
/* Created By ".date('Y-m-d H:i:s')." */";



$resultR = createFile($string, $target."helpers/response_helper.php");

?>