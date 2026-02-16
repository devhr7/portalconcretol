
<?php include '../../layout/head/head2.php'; ?>
<?php include 'sidebar.php' ?>

<?php include '../../include/LibreriasHR.php';  ?>
       <?php $LibreriasHR = new LibreriasHR();  ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Bienvenido</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item active"><a href="#">Inicio</a></li>
						<!--<li class="breadcrumb-item active">Legacy User Menu</li> -->
					</ol>
				</div>
			</div>
		</div>
		<!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">

		<!-- Default box -->
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Dashboard</h3>

				<div class="card-tools">
					<button type="button" class="btn btn-tool"
						data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
						<i class="fas fa-minus"></i>
					</button>

				</div>
			</div>
			<div class="card-body">

				<table id="example" class="display" style="width: 100%">
					<thead>
						<tr>

							<th>codigo</th>
							<th>Last name</th>
							<th>Last name</th>
							<th>Detalle</th>
						</tr>
					</thead>
					<tfoot>
						<tr>

							<th>First name</th>
							<th>Last name</th>
							<th>Last name</th>
							<th>Detalle</th>

						</tr>
					</tfoot>
				</table>


			</div>
			<!-- /.card-body -->
			<div class="card-footer"></div>
			<!-- /.card-footer-->
		</div>
		<!-- /.card -->

	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->


<?php include '../../layout/footer/footer2.php' ?>
<script>
$(document).ready(function() {
listar();
});

var listar = function(){
    var table = $('#example').DataTable( {
        "processing": true,
        
         "ajax": {
         "method": "POST",
            "url": "datostabla.php",
        },
        "columns":[
        	
        	{"data":"ct1_pass"},
        	{"data":"ct1_NumeroIdentificacion"},
        	{"data":"ct1_RazonSocial"},
        	{"defaultContent":"<button class='editar' type='button'> editar </button>"},
        ],
        
        
   
        
    } );
    
     obtenerdatos ("#example tbody",table);
    }
   

var obtenerdatos = function(tbody,table){
	$(tbody).on("click","button.editar", function(){
		var data = table.row( $(this).parents("tr")).data();
		//console.log(data);
		var tok = data.ct1_IdTerceros;
		<?php $tok =  "<script> tok </script>"; ?>
		<?php $tok = $LibreriasHR->HR_Crypt($tok, 1)?>
		location.href="example/hola.php?hola=<?php echo $tok?>";
	})
	

}




</script>

</body>

</html>