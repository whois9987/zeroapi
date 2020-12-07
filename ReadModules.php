<?php
require_once 'modules/Helper.php';
require_once 'modules/ZeroApi.php';
$result = array();
if(!empty($_POST)){
  $_tableName = _safe($_POST['_tableName']);
  $_plugin = _safe($_POST['_plugin']);
  $_controller = _safe($_POST['_controller']);
  $_model = _safe($_POST['_model']);
  if ($_tableName != '') {
    $c = $_controller <> '' ? ucfirst($_controller) : ucfirst($_tableName);
    $m = $_model <> '' ? ucfirst($_model) : 'M_' . ucfirst($_tableName);
    $c_url = strtolower($c);
    $c_file = $c . '.php';
    $m_file = $m . '.php';
    $get_setting = readJSON('modules/setting.cfg');
    $target = $get_setting->target;
    if (!file_exists($target . "controllers/api/" . $c_url))
    {
        mkdir($target . "controllers/api/", 0777, true);
    }
    $pk = $zap->primary_field($_tableName);
    $non_pk = $zap->not_primary_field($_tableName);
    $all = $zap->all_field($_tableName);
    include 'modules/CreateApiController.php';
    include 'modules/CreateApiModel.php';
    include 'modules/CreateResponseHelper.php';
    $result[] = $resultC;
    $result[] = $resultM;
    $result[] = $resultR;
    echo json_encode([
      'status' =>  true,
      'error_message' => '',
      'data' => $result
    ]);
  }else{
    echo json_encode([
      'status' =>  false,
      'error_message' => 'Table No Selected',
    ]);
  }
}else{
  echo json_encode([
    'status' =>  false,
    'error_message' => 'Not permision access',
  ]);  
}
?>
