	<!-- Modal Delete Start-->
	<div class="modal fade" id="modalDeleteSir" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Hapus Request</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form class="form" action="<?php echo base_url().'/sirkulasi/deleteData'; ?>" method="post">
					<input class="form-control mb-3" type="text" name="id_peminjaman" id="fid_peminjaman" hidden>
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
					<h1 class="m-0">List Request Peminjaman</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="">Home</a></li>
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
            <a href="<?php echo base_url().'sirkulasi/displayRequest'; ?>"><input class="btn btn-danger btn-sm" type="button" name='reset' value="Reset"></a>    
        </form>

		<?php 
			echo (isset($alert))? $alert : ""; 
		?>

		<div class="table-responsive">
			<table class="table table-striped mt-3">
				<thead>
					<tr>
						<th scope="col">No</th>
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
				foreach ($data_request as $data) {

					$key = $data['id_peminjaman'];
					echo
					'<tr>
						<td class="align-middle d-none">'.$key.'</td>        
						<td class="align-middle">'.$no.'</td>        
						<td class="align-middle">'.$data['kode_anggota'].'</td>        
						<td class="align-middle">'.$data['nama'].'</td>        
						<td class="align-middle">'.$data['judul'].'</td>        
						<td class="align-middle">'.$data['kode_koleksi'].'</td>        
						<td class="align-middle">'.date('d/m/Y', strtotime($data['tgl_pinjam'])).'</td>        
                        <td class="align-middle">'.date('d/m/Y', strtotime($data['tgl_kembali'])).'</td>
					';
					
					if ($data['status'] == 'Request') {
						echo'<td class="align-middle text-primary text-uppercase fw-bolder">'.$data['status'].'</td>';
					}
					else {
						echo'<td class="align-middle text-danger text-uppercase fst-italic fw-bolder">'.$data['status'].'</td>';
					}

					
					echo'<td class="align-middle nowrap">';
					if ($_SESSION['akses'] == 'admin') {
						if ($data['status'] == 'Request') {
							echo
							'
									<a href='.base_url().'/sirkulasi/validationRequest/'.$key.'/'.$data['kode_koleksi'].'/1'.'><button type="button" class="btn btn-success btn-sm mb-2"> <i class="fas fa-check"></i> </button></a><br>
									<a href='.base_url().'/sirkulasi/validationRequest/'.$key.'/'.$data['kode_koleksi'].'/-1'.'><button type="button" class="btn btn-danger btn-sm mb-2"> <i class="fas fa-times-circle"></i> </button></a><br>
									<a href='.base_url().'./anggota/displayAnggotaDetail/'.$data['kode_anggota'].'><button type="button" class="btn btn-primary btn-sm mb-2"> <i class="fas fa-info-circle"></i> </button></a>
							';
						}
					}else {
						echo
						'
								<button type="button" class="btn btn-danger btn-sm mb-2 btnDeleteSir" data-bs-toggle="modal" data-bs-target="#modalDeleteSir"> <i class="fas fa-trash-alt"></i> </button>
							</td>        		
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