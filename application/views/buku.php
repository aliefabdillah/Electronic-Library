	<!-- Modal Add New Biblio-->
	<div class="modal fade" id="modalAddBib" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Form Tambah Biblio</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form class="form" action="<?php echo base_url().'/home/submitAdd/';?>" method="post" enctype="multipart/form-data">
					<div class="container-md p-4 my-3 border">
						<div class="row">
							<label>Judul</label>  
							<input class="form-control mb-3" type="text" name="judul">
						</div>
						<div class="row">
							<label>Kode Buku</label>  
							<input class="form-control mb-3" type="text" name="kode_buku">
						</div>
						<div class="row">
							<label>Pengarang</label>  
							<input class="form-control mb-3" type="text" name="pengarang">
						</div>
						<div class="row">
							<label>Penerbit</label>  
							<input class="form-control mb-3" type="text" name="penerbit">
						</div>
						<div class="row">
							<label>Tahun Terbit</label>  
							<input class="form-control mb-3" type="number" name="thn_terbit">
						</div>
						<div class="row">
							<label>Bahasa</label>  
							<input class="form-control mb-3" type="text" name="bahasa">
						</div>
						<div class="row">
							<label>ISBN</label>  
							<input class="form-control mb-3" type="text" name="isbn">
						</div>
						<div class="row">
							<label>Jumlah Copy</label>  
							<input class="form-control mb-3" type="number" name="copy">
						</div>
						<div class="row">
							<label>Kategori</label>  
							<input class="form-control mb-3" type="text" name="kategori">
						</div>
						<div class="row">
							<label>Foto Buku</label>  
							<input class="form-control mb-3" type="file" name="foto">
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
	
	<!-- Modal Delete Start-->
	<div class="modal fade" id="modalDeleteBiblio" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Hapus Data Koleksi</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form class="form" action="<?php echo base_url().'/home/submitDelete'; ?>" method="post">
					<input class="form-control mb-3" type="text" name="id_biblio" id="fid_bib" value="" hidden>
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
	
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">List Data Bibliografi</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Data Bibliografi</li>
					</ol>
				</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.container-fluid -->
		</div>
		<!-- /.content-header -->

		<!-- Alert CRUD -->
		<?php
            // tampilkan pesan validasi berhasi
            if ($this->session->flashdata('message')) {
            echo "<div class=\"alert alert-success\">".$this->session->flashdata('message')."</div>";
            }
            // tampilkan pesan error
            if ($this->session->flashdata('error_message')) {
            echo "<div class=\"alert alert-danger\">".$this->session->flashdata('error_message')."</div>";
            }
        ?>

		<div class="row mb-3">
			<div class="col-sm-9">
				<!-- buat form search  -->
				<form action="<?php echo base_url().'home/searchData' ?>" method="get">
					<h2 class="Head-index"></h2>
					
					<div class="mt-2">
						<label class="ms-3">Search By : </label> 
						<select class="form w-25" name="searchBy">
							<option value="">...</option>
							<option value="judul">Judul</option>
							<option value="kode_buku">Kode Buku</option>
							<option value="pengarang">Pengarang</option>
							<option value="penerbit">Penerbit</option>
							<option value="thn_terbit">Tahun Terbit</option>
							<option value="bahasa">Bahasa</option>
							<option value="kategori">Kategori</option>
						</select>
					</div>

					<label class="ms-3">Search &nbsp; &nbsp; &nbsp; : </label> 
					<input class="me-3" id="search" type="text" name='search' placeholder="cari...">
					<input class="btn btn-success btn-sm" type="submit" name='submit'>
					<a href="<?php echo base_url().'home/index'; ?>"><input class="btn btn-danger btn-sm" type="button" name='reset' value="Reset"></a>
				</form>
			</div>
			<div class="col-sm-3">
				<?php if (isset($_SESSION['login']) == TRUE) {?>
					<?php if ($_SESSION['akses'] == 'admin') {?>
						<button type='button' class='btn btn-primary float-sm-right ms-3 me-4' data-bs-toggle="modal" data-bs-target="#modalAddBib"> + Tambah Baru </button><br>
					<?php } ?>
				<?php } ?>
			</div>
		</div>

		<?php
			foreach ($data_biblio as $data) {
				
				$key = $data['id_biblio'];
				echo
				'
				<div class="card mb-5" style="max-width: 100%;">
					<div class="row g-0">
						<div class="col-sm-4">
							<img src="'.base_url().'./images/'.$data['foto'].'" width="100%" height="auto" class="img-fluid rounded-start">
						</div>
						<div class="col-sm-8">
							<div class="card-body">
								<h3>'.$data['judul'].'</h3>
								<div class="table-responsive">
									<table class="table table-striped mt-3 mb-3">
										<tbody>
											<tr>
												<th scope="col">Kode Buku</th>
												<td>'.$data['kode_buku'].'</td>
											</tr>
											<tr>
												<th scope="col">Pengarang</th>
												<td>'.$data['pengarang'].'</td>
											</tr>
											<tr>
												<th scope="col">Penerbit</th>
												<td>'.$data['penerbit'].'</td>
											</tr>
											<tr>
												<th scope="col">Tahun Terbit</th>
												<td>'.$data['thn_terbit'].'</td>
											</tr>
											<tr>
												<th scope="col">Bahasa</th>
												<td>'.$data['bahasa'].'</td>
											</tr>
											<tr>
												<th scope="col">ISBN</th>
												<td>'.$data['isbn'].'</td>
											</tr>
											<tr>
												<th scope="col">Jumlah Copy</th>
												<td>'.$data['jmlh_buku'].'</td>
											</tr>
											<tr>
												<th scope="col">Kategori</th>
												<td>'.$data['kategori'].'</td>
											</tr>
										</tbody>
									</table>
								</div>
								<a href="'.base_url().'./koleksi/displayKoleksi/'.$key.'"><button type="button" class="btn btn-info btn-sm"> Koleksi </button></a>
				';

							if (isset($_SESSION['login']) == TRUE) {
								if ($_SESSION['akses'] == 'admin') {
									echo
									'
									<a href="'.base_url().'./home/displayFormEdit/'.$key.'"><button type="button" class="btn btn-warning btn-sm ms-3"> Update </button></a>
									<button type="button" class="btn btn-danger btn-sm ms-3 btnDeleteBib"  data-id="'.$data['id_biblio'].'" data-bs-toggle="modal" data-bs-target="#modalDeleteBiblio"> Delete </button>
									';
								}
							}
				echo
				'
							</div>
						</div>
					</div>
				</div>
				';
						
			}
		?>
	</div>
</body>
</html>