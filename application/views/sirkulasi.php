	<!-- Modal Delete Start-->
	<div class="modal fade" id="modalDeleteSir" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Hapus Data Koleksi</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form class="form" action="<?php echo base_url().'/sirkulasi/deleteData'; ?>" method="post">
					<input class="form-control mb-3" type="text" name="id_peminjaman" id="fid_peminjaman" hidden>
					<input class="form-control mb-3" type="text" name="kode_koleksi" id="fkode_kol" hidden>
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
					<h1 class="m-0">List Peminjaman</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Peminjaman</li>
					</ol>
				</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.container-fluid -->
		</div>
		<!-- /.content-header -->

        <!-- buat form search  -->
        <form action="<?php echo base_url().'sirkulasi/searchData' ?>" method="get">
            <h2 class="Head-index"></h2>
            <label class="ms-3">Cari : </label> 
            <input id="search" type="text" name='search' placeholder="cari...">
            <input class="btn btn-success btn-sm" type="submit" name='submit'>
            <a href="<?php echo base_url().'sirkulasi/displayData'; ?>"><input class="btn btn-danger btn-sm" type="button" name='reset' value="Reset"></a>    
        </form>

		<?php 
			echo (isset($alert))? $alert : ""; 
		?>

		<div class="table-responsive">
			<table class="table table-striped mt-3">
				<thead>
					<tr>
						<th scope="col">No</th>
						<th scope="col">Kode Transaksi</th>
						<th scope="col">Kode Anggota</th>
						<th scope="col">Nama Anggota</th>
						<th scope="col">Judul Buku</th>
						<th scope="col">Kode Koleksi</th>
						<th scope="col">Tanggal Pinjam</th>
						<th scope="col">Tanggal Kembali</th>
						<th scope="col">Status</th>
						<th scope="col">Action</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$no = 1;
				foreach ($data_sirkulasi as $data) {
					
					$key = $data['id_peminjaman'];
					echo
					'<tr>
						<td class="align-middle d-none">'.$key.'</td>        
						<td class="align-middle">'.$no.'</td>        
						<td class="align-middle">'.$data['kode_transaksi'].'</td>        
						<td class="align-middle">'.$data['kode_anggota'].'</td>        
						<td class="align-middle">'.$data['nama'].'</td>        
						<td class="align-middle">'.$data['judul'].'</td>        
						<td class="align-middle">'.$data['kode_koleksi'].'</td>        
						<td class="align-middle">'.date('d/m/Y', strtotime($data['tgl_pinjam'])).'</td>        
                        <td class="align-middle">'.date('d/m/Y', strtotime($data['tgl_kembali'])).'</td>
					';
					
					if ($data['status'] == 'Dikembalikan') {
						// <a href='".base_url()."./sirkulasi/deleteData/".$key."/".$data['kode_koleksi']."'><button type='button' class='btn btn-danger btn-sm mb-2'> Delete </button></a><br>
						echo'
							<td class="align-middle text-success text-uppercase fw-bolder">'.$data['status'].'</td>   
							<td class="align-middle">'.
								"
								<a href='".base_url()."./anggota/displayAnggotaDetail/".$data['kode_anggota']."'><button type='button' class='btn btn-primary btn-sm mb-2'> Detail </button></a>
								"
							.'</td>        		
						</tr>
						';
					}
					else {
						$current_date = date('Y-m-d');
						if (strtotime($data['tgl_kembali']) < strtotime($current_date)) {
							echo'<td class="align-middle text-danger text-uppercase fw-bolder">Terlambat</td>';       
						}
						else {
							echo'<td class="align-middle text-primary text-uppercase fst-italic fw-bolder">'.$data['status'].'</td>';       
						}

						echo
						'
							<td class="align-middle">'.
								"
								<a href='".base_url()."./sirkulasi/updateStatusPinjam/".$key."/".$data['kode_koleksi']."'><button type='button' class='btn btn-info btn-sm text-nowrap mb-2'>Update Status</button></a>
								<button type='button' class='btn btn-danger btn-sm mb-2 btnDeleteSir' data-bs-toggle='modal' data-bs-target='#modalDeleteSir'> Delete </button><br>
								<a href='".base_url()."./anggota/displayAnggotaDetail/".$data['kode_anggota']."'><button type='button' class='btn btn-primary btn-sm'> Detail </button></a>
								"
							.'</td>        		
						</tr>
						';
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