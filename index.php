<?php
require_once 'modules/ZeroApi.php';

?>
<!doctype html>
<html>

<head>
	<title>Zero-Api</title>
	<link rel="stylesheet" href="modules/assets/css/bootstrap.min.css" />
</head>

<body>
	<div class="container-fluid p-3">
		<div class="row">
			<div class="col-3">
				<form id="_form" action="ReadModules.php" method="POST">

					<div class="form-group">
						<label>Daftar Table</label>
						<select id="_tableName" name="_tableName" class="form-control" onchange="_core._writeName()">
							<option value="">Pilih Table</option>
							<?php
							$table_list = $zap->table_list();
							foreach ($table_list as $table) {
							?>
								<option value="<?php echo $table['table_name'] ?>">
									<?php echo $table['table_name'] ?></option>
							<?php
							}
							?>
						</select>
					</div>

					<div class="form-group">
						<label>Nama File Controller</label>
						<input disabled type="text" id="_controller" name="_controller" value="" class="form-control" placeholder="" />

						<small class="form-text text-danger ">Location: ./application/controllers/api/</small>
					</div>

					<div class="form-group">
						<label>Nama File Model</label>
						<input disabled type="text" id="_model" name="_model" value="" class="form-control" placeholder="" />

						<small class="form-text text-danger ">Location: ./application/models/</small>
					</div>

					<div class="form-group">
						<label>Styles Api</label>
						<br>
						<label><input type="radio" id="_plugin" name="_plugin" value="_no" checked> Not plugins</label>
					</div>

					<input type="submit" disabled value="Generate File" name="_action" id="_action" class="btn btn-primary" onclick="javascript: return confirm('Apakah Anda Yakin?')" />

				</form>
				<br>
				<label>Result File</label>
				<ul id="_result">
				</ul>
			</div>
			<div class="col-9">
				<h4 class="text-primary"><b>ZeroApi</b> CRUD Generator Codeigniter</h4>
				<br>
				<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" id="tentang-tab" data-toggle="pill" href="#tentang" role="tab" aria-controls="tentang" aria-selected="true">Tentang</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="install-tab" data-toggle="pill" href="#install" role="tab" aria-controls="install" aria-selected="false">Cara Install</a>
					</li>
				</ul>
				<div class="tab-content" id="pills-tabContent">
					<div class="tab-pane fade show active" id="tentang" role="tabpanel" aria-labelledby="tentang-tab">
						Hanya Untuk Membantu Teman Coding 😃
						<br>
						<ul>
							<li>Note
								<ul>
									<li>Base Generator Sebelumnya Saya Menggunakan Harviacode, Thanks untuk <a target="_blank" href="https://harviacode.com/">harviacode</a></li>
									<li>Di dalam suatu table harus ada primary key</li>
								</ul>
							</li>
						</ul>
					</div>
					<div class="tab-pane fade" id="install" role="tabpanel" aria-labelledby="install-tab">
						<ul>
							<li>Note
								<ul>
									<li>Pada application/config/autoload.php, harus di load library database,dan url di helper</li>
									<li>Pada application/config/config.php
										<ul>
											<li>$config['base_url'] = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");</li>
											<li>$config['base_url'] .= "://".$_SERVER['HTTP_HOST'];</li>
											<li>$config['base_url'] .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);</li>
											<li>$config['index_page'] = ''</li>
											<li><a target="_blank" href="https://stackoverflow.com/questions/38477720/remove-index-php-from-url-in-codeigniter-3">Jika Bingung bisa buka </a></li>
											<li>Enjoy 😃</li>
										</ul>
									</li>
								</ul>
							</li>
							<li>Windows
								<ul>
									<li>Taruh folder <b>zeroapi</b> di root projectkamu</li>
									<li>Buka http://localhost/namaprojectkamu/zeroapi</li>
									<li>Enjoy 😃</li>
								</ul>
							</li>
							<li>Linux/Mac
								<ul>
									<li>Taruh folder <b>zeroapi</b> di root projectkamu</li>
									<li>Buka http://localhost/namaprojectkamu/zeroapi</li>
									<li>Jika folder tidak dapat dibaca, tolong ganti permission di folder application dan di zeroapi ke chmod 777</li>
									<li>Enjoy 😃</li>
								</ul>
							</li>
						</ul>

					</div>
				</div>
			</div>
		</div>
	</div>
</body>
	<script type="text/javascript" src="modules/assets/js/jqueryslim.min.js"></script>
	<script type="text/javascript" src="modules/assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="modules/assets/js/jquery.min.js" ></script>	
<script type="text/javascript">
	var _core = {
		_action: document.getElementById('_action'),
		_tableName: document.getElementById('_tableName'),
		_controller: document.getElementById('_controller'),
		_model: document.getElementById('_model'),
		_result: $("#_result"),
		_form: $('#_form'),
		_capitalize: (binding) => {
			return binding && binding[0].toUpperCase() + binding.slice(1);
		},
		_writeName : () => {
			_core._tableName.value.toLowerCase() == '' ? [_core._controller.value = '', _core._controller.disabled = true, _core._model.value = '', _core._model.disabled = true, _core._action.disabled = true, ] : [_core._controller.value = _core._capitalize(_core._tableName.value.toLowerCase()), _core._controller.disabled = false, _core._model.value = 'M_' + _core._capitalize(_core._tableName.value.toLowerCase()), _core._model.disabled = false, _core._action.disabled = false]
		}		
	}
	_core._form.submit((event) => {
			event.preventDefault()
			$.ajax({
				type: 'POST',
				dataType: "json",
				url: _core._form.attr("action"),
				data: _core._form.serialize(),
				success: function(res) {
					for (let index = 0; index < res.data.length; index++) {
						html = '<li >' + res.data[index] + '</li>';
						_core._result.append(html)
					}
				}
			});
		});
</script>

</html>