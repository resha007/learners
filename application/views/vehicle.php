<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!doctype html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Vehicle</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="https://i.imgur.com/QRAUqs9.png">
    <link rel="shortcut icon" href="https://i.imgur.com/QRAUqs9.png">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/css/lib/datatable/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/css/style.css">
    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
    <link href="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/jqvmap@1.5.1/dist/jqvmap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/weathericons@2.1.0/css/weather-icons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.css" rel="stylesheet" />

</head>

<body onload="dataLoad()">
    
        <!-- Content -->
        <div class="content">
            <div class="animated fadeIn">

                <div class="row">
                    <strong class="headings"></strong>

								<div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <strong>Vehicle</strong>
                            </div>
                            <div class="card-body card-block">
                                <form action="#" method="post" class="form-horizontal" id="dataForm">
                                    <input type="text" id="txtId" name="txtId" hidden>
									<div class="row form-group">
                                        <div class="col col-md-3"><label class=" form-control-label">Name<span class="req"> *</span></label></div>
                                        <div class="col-12 col-md-9"><input type="text" id="name" name="name" placeholder="Enter name" class="form-control"></div>
                                    </div>
									<div class="row form-group">
                                        <div class="col col-md-3"><label class=" form-control-label">Description<span class="req"> *</span></label></div>
                                        <div class="col-12 col-md-9"><textarea id="description" name="description" placeholder="Enter description" class="form-control" style="resize:none"></textarea></div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label class=" form-control-label">Number Plate<span class="req"> *</span></label></div>
                                        <div class="col-12 col-md-3"><input type="text" id="numberPlate" name="numberPlate" placeholder="WP ABC-1234" class="form-control"></div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="select" class=" form-control-label">Vehicle Type<span class="req"> *</span></label></div>
                                        <div class="col-12 col-md-3">
                                            <select name="vehicleType" id="vehicleType" class="form-control">
                                                <option value="0" disabled selected>Please select</option>
                                                
                                            </select>
                                        </div>
                                    </div>
									<div class="row form-group">
                                        <div class="col col-md-3"><label for="select" class=" form-control-label">Status<span class="req"> *</span></label></div>
                                        <div class="col-12 col-md-3">
                                            <select name="status" id="status" class="form-control">
                                                <option value="0" disabled selected>Please select</option>
                                                <option value="Active">Active</option>
                                                <option value="Inactive">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                
                            </div>
                            <div class="button-footer">
                                <button type="button" class="btn btn-primary" id="add" name="add"><i class="fa fa-plus"></i>&nbsp;Add</button>
                                <button type="button" class="btn btn-success" id="update" name="update"><i class="fa fa-reply"></i>&nbsp;Update</button>
                                <button type="button" class="btn btn-danger" id="delete" name="delete"><i class="fa fa-trash-o"></i>&nbsp;Delete</button>
                                <button type="reset" class="btn btn-info" id="reset" name="reset"><i class="fa fa-refresh"></i>&nbsp;Reset</button>
                            </div>
                            </form>
                        </div>
            </div>
						
						
						<div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Existing Vehicles</strong><br>
                                <span style="font-size: 12px">(Click on the relevant row to <b>update or delete</b>)</span>
                            </div>
                            <div class="card-body">
                                <table id="datatable" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Number Plate</th>
                                            <th>Vehicle Type id</th>
                                            <th>Status</th>
                                            <th>Vehicle Type</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
			


        </div><!-- .animated -->
        </div>
        <!-- /.content -->
        
   
    <!-- /#right-panel -->

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="<?=base_url()?>assets/js/main.js"></script>

    <!--  Chart js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.3/dist/Chart.bundle.min.js"></script>

    <!--Chartist Chart-->
    <script src="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartist-plugin-legend@0.6.2/chartist-plugin-legend.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/jquery.flot@0.8.3/jquery.flot.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flot-pie@1.0.0/src/jquery.flot.pie.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flot-spline@0.0.1/js/jquery.flot.spline.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/simpleweather@3.1.0/jquery.simpleWeather.min.js"></script>
    <script src="assets/js/init/weather-init.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/moment@2.22.2/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.js"></script>
    <script src="assets/js/init/fullcalendar-init.js"></script>
	
	<script src="<?=base_url()?>assets/js/lib/data-table/datatables.min.js"></script>
    <script src="<?=base_url()?>assets/js/lib/data-table/dataTables.bootstrap.min.js"></script>
    <script src="<?=base_url()?>assets/js/lib/data-table/dataTables.buttons.min.js"></script>
    <script src="<?=base_url()?>assets/js/lib/data-table/buttons.bootstrap.min.js"></script>
    <script src="<?=base_url()?>assets/js/lib/data-table/jszip.min.js"></script>
    <script src="<?=base_url()?>assets/js/lib/data-table/vfs_fonts.js"></script>
    <script src="<?=base_url()?>assets/js/lib/data-table/buttons.html5.min.js"></script>
    <script src="<?=base_url()?>assets/js/lib/data-table/buttons.print.min.js"></script>
    <script src="<?=base_url()?>assets/js/lib/data-table/buttons.colVis.min.js"></script>
    <script src="<?=base_url()?>assets/js/init/datatables-init.js"></script>
    <!--sweet alerts-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

	<script type="text/javascript" src="<?=base_url()?>assets/js/custom/vehicleJS.js"></script>
	
    
	
</body>
</html>
