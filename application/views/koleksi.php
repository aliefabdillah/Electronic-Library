	<!-- Modal Form Pinjam-->
	<div class="modal fade" id="formPinjam" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Form Data Peminjam</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				
				<form class="form" action="<?php echo base_url().'sirkulasi/makeRequest' ?>" method="POST" enctype="multipart/form-data" role="form">
					<div class="container-md p-4 my-3 border">
						<?php
							if (isset($_SESSION['login']) == TRUE) {
								if ($_SESSION['akses'] == 'member') {
									echo
									'
									<div class="row">
										<p>Kode Anggota
										<input class="form-control" type="text" name="kode_anggota" value='.$_SESSION['kode'].' readonly></p>
									</div>
									';
								}else {
									echo
									'
									<div class="row">
										<p>Kode Anggota
										<input class="form-control" type="text" name="kode_anggota" placeholder="Masukan Kode Anggota" required></p>
									</div>
									';
								}
							}
							else{
								echo
								'
								<p>Untuk Melakukan Peminjaman Anda Harus Login terlebih Dahulu - <a href="'.base_url().'login/showSignIn'.'"> Login Now!</a></p>
								<hr>
								<div class="row">
									<p>Kode Anggota
									<input class="form-control" type="text" name="kode_anggota" placeholder="Masukan Kode Anggota" disabled></p>
								</div>
								';
							}
						?>
						<div class="row">
							<p>Tanggal Pinjam
							<input class="form-control" type="date" name="tgl_pinjam" placeholder="Masukan Tanggal Pinjam" required></p>  
						</div>
						<div class="row">
							<p>Tanggal Kembali
							<input class="form-control" type="date" name="tgl_kembali" placeholder="Masukan Tanggal Kembali" required></p>  
						</div>
						<div class="row">
							<?php
								foreach($data_koleksi as $data){
									break;
								}
								echo
								'
								<p>Judul Buku  
								<input class="form-control" type="text" name="judul" value="'.$data['judul'].'" readonly></p>  
								';
							?>
						</div>
						<div class="row">
							<p>Kode Koleksi
							<input class="form-control" type="text" id="kode_koleksi" name="kode_koleksi" readonly></p>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<?php
						if (isset($_SESSION['login']) == TRUE) {
							echo "<input class=\"btn btn-success\" type=\"submit\" name=\"simpan\" value=\"Simpan\">";
						}
						?>
					</div>
				</form>
			</div>
			</div>
		</div>
	</div>

	<!-- Modal Add New Koleksi-->
	<div class="modal fade" id="modalAddKol" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Form Tambah Koleksi</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form class="form" action="<?php echo base_url().'/koleksi/submitAdd/';?>" method="post">
					<div class="container-md p-4 my-3 border">
						<div class="row">
							<label>Id Biblio</label>  
							<input class="form-control mb-3" type="text" name="id_biblio" value="<?php echo $data_biblio['id_biblio'] ;?>" readonly>
						</div>
						<div class="row">
							<label>Kode Koleksi</label>  
							<input class="form-control" type="text" name="kode_koleksi" id="f_kode_koleksi">
						</div>
						<div class="row">
							<input class="form-check-input ms-1" type="checkbox" name="disabled_fkode" id="disabled_fkode">
                        	<label class="form-check-label ms-3 mb-3">Ceklis Jika Koleksi Bukan Merupakan Referensi</label>
						</div>
						<div class="row">
							<label>Poisis Rak</label>  
							<input class="form-control mb-3" type="text" name="posisi_rak">
						</div>
						<div class="row">
							<label>Kondisi</label>  
							<input class="form-control mb-3" type="text" name="kondisi">
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
							<input class="btn btn-success" type="submit" name="submit" value="Add">
						</div>
					</div>
				</form>
			</div>
			</div>
		</div>
	</div>

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">List Data Koleksi</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Data Biblio</li>
					<li class="breadcrumb-item active">Koleksi</li>
					</ol>
				</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.container-fluid -->
		</div>
		<!-- /.content-header -->
		
		<!-- Alert CRUD -->
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

		<!-- Button Back and Insert -->
		<div class="row mb-3">
			<div class="col-sm-6">
				<a href='<?php echo base_url().'home/index'; ?>'><button type='button' class='btn btn-primary btn ms-3 mb-3'>  << Back </button></a>
			</div>
			<div class="col-sm-6">
				<?php 
				if (isset($_SESSION['login']) == TRUE) {
					if ($_SESSION['akses'] == 'admin') { ?>
					<button type='button' class='btn btn-primary float-sm-right me-3' data-bs-toggle="modal" data-bs-target="#modalAddKol"> + Tambah Koleksi </button><br>
				<?php }
					} ?>
			</div>
		</div>

		<?php
			echo'<img src="'.base_url().'./images/'.$data_biblio['foto'].'" width="130" height="200" class="ms-3">';
			echo'<span class="ms-3" style="font-weight: bold; font-size: 30px;">'.$data_biblio['judul'].'</span>';
		?>
		<div class="table-responsive">
			<table class="table table-striped mt-3">
				<thead>
					<tr>
						<th scope="col">No</th>
						<th scope="col">Kode Koleksi</th>
						<th scope="col">Posisi</th>
						<th scope="col">Kondisi</th>
						<th scope="col">Status</th>
						<th scope="col">Action</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$no = 1;
				foreach ($data_koleksi as $data) {
					echo
					'
					<!-- Modal Delete Start-->
					<div class="modal fade" id="modalDeleteKol" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
							<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Hapus Data Koleksi</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<form class="form" action="'.base_url().'/koleksi/submitDelete" method="post">
									<input class="form-control mb-3" type="text" name="id_biblio" id="fid_biblio" hidden>
									<input class="form-control mb-3" type="text" name="id_koleksi" id="fid_kol" hidden>
									<p>Anda Yakin Ingin Menghapus Data?</p>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
										<input class="btn btn-danger" type="submit" name="submit" value="Hapus">
									</div>
								</form>
							</div>
							</div>
						</div>
					</div>
					<!-- Modal Delete End -->
					';
					
					$key = $data['id_koleksi'];
					echo
					'<tr>
						<td class="d-none">'.$key.'</td>        
						<td class="d-none">'.$data['id_biblio'].'</td>        
						<td>'.$no.'</td>                
						<td>'.$data['kode_koleksi'].'</td>        
						<td>'.$data['posisi_rak'].'</td>
						<td>'.$data['kondisi'].'</td>
					';
	
					if ($data['status'] == 'Tersedia') {
						echo'<td class="text-success text-uppercase fw-bolder">'.$data['status'].'</td>';       
					}
					elseif ($data['status'] == 'Dipinjam') {
						echo'<td class="text-primary text-uppercase fst-italic fw-bolder">'.$data['status'].'</td>';       
					}
					else{
						echo'<td class="text-danger text-uppercase fw-bolder">'.$data['status'].'</td>';       
					}
					
					// jika buku bukan merupakan referensi dan status nya tersedia
					if ($data['kode_koleksi'] != '#REF' && $data['status'] != 'Dipinjam') {
						echo'
							<td>
								<button type="button" class="btn btn-info btn-sm me-3 pinjamBtn" data-bs-toggle="modal" data-bs-target="#exampleModal"> Pinjam </button>
						';
						if (isset($_SESSION['login']) == TRUE) {
							if ($_SESSION['akses'] == 'admin') {
								echo
								'
										<a href="'.base_url().'./koleksi/displayFormEdit/'.$key.'"><button type="button" class="btn btn-warning btn-sm me-3"> Update </button></a>
										<button type="button" class="btn btn-danger btn-sm btnDeleteKol"  data-bs-toggle="modal" data-bs-target="#modalDeleteKol"> Delete </button>
									</td>        
								</tr>	
								';
							}
						}	
					}
					// jika buku ada referensi dan status nya tidak dapat dipinjam
					else {
						if (isset($_SESSION['login']) == TRUE) {
							if ($_SESSION['akses'] == 'admin') {
								echo
								'
									<td>
										<a href="'.base_url().'./koleksi/displayFormEdit/'.$key.'"><button type="button" class="btn btn-warning btn-sm me-3"> Update </button></a>
										<button type="button" class="btn btn-danger btn-sm btnDeleteKol"  data-bs-toggle="modal" data-bs-target="#modalDeleteKol"> Delete </button>	
									</td>        
								</tr>
								';
							}
						}
					}
					
					$no++;
				}
				?>
				</tbody>
			</table>
		</div>
	</div>
</body>
</html>