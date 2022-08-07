    <!-- Modal Delete Start-->
    <div class="modal fade" id="formHapusAnggota" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Data Anggota</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form" action="<?php echo base_url().'/anggota/submitDelete';?>" method="post">
                <?php
                    echo'<input class="form-control mb-3" type="text" name="kode_anggota" value="'.$data_anggota->kode_anggota.'" hidden>';
                ?>
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
				<div class="row">
				<div class="col-sm-6">
                    <h1 class="m-0">Data Anggota Perpustakaan</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
                    
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Data Anggota</li>
                        <?php
                            // foreach ($data_anggota as $data){
                                
                            // }
                            echo'<li class="breadcrumb-item active">'.$data_anggota->nama.'</li>';
                        ?>
					</ol>
				</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.container-fluid -->
		</div>
		<!-- /.content-header -->

        <?php
            // tampilkan pesan validasi
            if ($this->session->flashdata('message')) {
            echo "<div class=\"alert alert-success\">".$this->session->flashdata('message')."</div>";
            }
            // tampilkan pesan errror
            if ($this->session->flashdata('error_message')) {
            echo "<div class=\"alert alert-danger\">".$this->session->flashdata('error_message')."</div>";
            }
        ?>
        <div class="container-xl">
            <?php
                echo
                '
                <div class="wrapper ms-3">
                    <h1 class="text-bold">'.$data_anggota->nama.'</h1>
                    <table class="table table-striped-columns mt-3 mb-3">
                        <tbody>
                            <tr>
                                <th scope="col" style="width: 30%">Kode Anggota</th>
                                <td>: '.$data_anggota->kode_anggota.'</td>
                            </tr>
                            <tr>
                                <th scope="col" style="width: 30%">NIK</th>
                                <td>: '.$data_anggota->nik.'</td>
                            </tr>
                            <tr>
                                <th scope="col" style="width: 30%">Email</th>
                                <td>: '.$data_anggota->email.'</td>
                            </tr>
                            <tr>
                                <th scope="col" style="width: 30%">Alamat</th>
                                <td>: '.$data_anggota->alamat.'</td>
                            </tr>
                            <tr>
                                <th scope="col" style="width: 30%">Nomor Telepon</th>
                                <td>: '.$data_anggota->no_telepon.'</td>
                            </tr>
                            <tr>
                                <th scope="col" style="width: 30%">Tanggal Aktif Member</th>
                                <td>: '.date('d/m/y', strtotime($data_anggota->tgl_aktif)).' s.d '.date('d/m/y',  strtotime('+1 year', strtotime($data_anggota->tgl_aktif))).'</td>
                            </tr>
                        </tbody>
                    </table>
                    <a href="'.base_url().'./anggota/displayFormEdit/'.$data_anggota->kode_anggota.'"><button type="button" class="btn btn-warning btn-sm"> Edit </button></a>
                    <button type="button" class="btn btn-danger btn-sm"  data-bs-toggle="modal" data-bs-target="#formHapusAnggota"> Delete </button>
                </div>
                ';
            ?>
            <br>
            <hr>
            <div class="wrapper-2 ms-3">
                <h3 class="text-bold mt-5">Buku Yang Sedang Dipinjam</h3>
                <p>Maximal peminjaman adalah 5 Buku!</p>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Kode Transaksi</th>
                                <th scope="col">Kode Anggota</th>
                                <th scope="col">Judul Buku</th>
                                <th scope="col">Kode Koleksi</th>
                                <th scope="col">Tanggal Pinjam</th>
                                <th scope="col">Tanggal Kembali</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach($buku_dipinjam as $data_dipinjam){
                                echo
                                '
                                <tr>
                                    <td class="align-middle">'.$no.'</td>        
                                    <td class="align-middle">'.$data_dipinjam['kode_transaksi'].'</td>        
                                    <td class="align-middle">'.$data_dipinjam['kode_anggota'].'</td>        
                                    <td class="align-middle">'.$data_dipinjam['judul'].'</td>        
                                    <td class="align-middle">'.$data_dipinjam['kode_koleksi'].'</td>        
                                    <td class="align-middle">'.date('d/m/Y', strtotime($data_dipinjam['tgl_pinjam'])).'</td>        
                                    <td class="align-middle">'.date('d/m/Y', strtotime($data_dipinjam['tgl_kembali'])).'</td>
                                ';
                                
                                $current_date = date('Y-m-d');
                                if (strtotime($data_dipinjam['tgl_kembali']) < strtotime($current_date)) {
                                    echo'<td class="align-middle text-danger text-uppercase fw-bolder">Terlambat</td>';       
                                }
                                else {
                                    echo'<td class="align-middle text-primary text-uppercase fst-italic fw-bolder">'.$data_dipinjam['status'].'</td>';       
                                }
    
                                $no++;
                            }
                            ?>
                        </tbody> 
                    </table>
                </div>
            </div>
            
            <div class="wrapper-3 ms-3">
                <h3 class="text-bold mt-4">Riwayat Peminjaman</h3>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Kode Transaksi</th>
                                <th scope="col">Kode Anggota</th>
                                <th scope="col">Judul Buku</th>
                                <th scope="col">Kode Koleksi</th>
                                <th scope="col">Tanggal Pinjam</th>
                                <th scope="col">Tanggal Kembali</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach($buku_dikembalikan as $data_dikembalikan){
                                echo
                                '
                                <tr>
                                    <td class="align-middle">'.$no.'</td>        
                                    <td class="align-middle">'.$data_dikembalikan['kode_transaksi'].'</td>        
                                    <td class="align-middle">'.$data_dikembalikan['kode_anggota'].'</td>        
                                    <td class="align-middle">'.$data_dikembalikan['judul'].'</td>        
                                    <td class="align-middle">'.$data_dikembalikan['kode_koleksi'].'</td>        
                                    <td class="align-middle">'.date('d-m-Y', strtotime($data_dikembalikan['tgl_pinjam'])).'</td>        
                                    <td class="align-middle">'.date('d-m-Y', strtotime($data_dikembalikan['tgl_kembali'])).'</td>
                                ';
    
                                if ($data_dikembalikan['status'] == 'Dikembalikan') {
                                    echo'<td class="align-middle text-success text-uppercase fw-bolder">'.$data_dikembalikan['status'].'</td>';       
                                }
                                else {
                                    echo'<td class="align-middle text-primary text-uppercase fst-italic fw-bolder">'.$data_dikembalikan['status'].'</td>';       
                                }
    
                                $no++;
                            }
                            ?>
                        </tbody> 
                    </table>
                </div>
            </div>
        </div>
	</div>
</body>
</html>