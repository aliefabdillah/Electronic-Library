
	

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">List Anggota</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Data Anggota</li>
					</ol>
				</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.container-fluid -->
		</div>
		<!-- /.content-header -->

		<?php
            // tampilkan pesan error
            if ($this->session->flashdata('message')) {
            	echo "<div class=\"alert alert-success\">".$this->session->flashdata('message')."</div>";
            }
            // tampilkan pesan logout message
            if ($this->session->flashdata('error_message')) {
            	echo "<div class=\"alert alert-danger\">".$this->session->flashdata('error_message')."</div>";
            }
        ?>

		<div class="row mb-3">
			<div class="col-sm-6">
				<!-- buat form search  -->
				<form action="<?php echo base_url().'anggota/searchData' ?>" method="get">
					<h2 class="Head-index"></h2>
					<label class="ms-3">Cari : </label> 
					<input id="search" type="text" name='search' placeholder="cari...">
					<input class="btn btn-success btn-sm" type="submit" name='submit'>
					<a href="<?php echo base_url().'anggota/displayAnggota'; ?>"><input class="btn btn-danger btn-sm" type="button" name='reset' value="Reset"></a>    
				</form>
			</div>
		</div>

		<div class="table-responsive">
			<table class="table table-striped mt-3">
				<thead>
					<tr>
						<th scope="col">No</th>
						<th scope="col">Kode Anggota</th>
						<th scope="col">NIK</th>
						<th scope="col">Nama</th>
						<th scope="col">Action</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$no = 1;
				foreach ($data_anggota as $data) {
					
					$key = $data['kode_anggota'];
					echo
					'<tr>
						<td class="align-middle">'.$no.'</td>        
						<td class="align-middle">'.$data['kode_anggota'].'</td>        
						<td class="align-middle">'.$data['nik'].'</td>        
						<td class="align-middle">'.$data['nama'].'</td>        
						<td class="align-middle">'.
							"
							<a href='".base_url()."./anggota/displayAnggotaDetail/".$key."'><button type='button' class='btn btn-info btn-sm me-3'> Detail </button></a>
							"
						.'</td>        
								
					</tr>
					';
					$no++;
				}
				?>
				</tbody>
			</table>
		</div>
	</div>
</body>
</html>