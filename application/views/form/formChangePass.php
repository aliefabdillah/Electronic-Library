	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="container-fluid">
				<div class="row">
				<div class="col-sm-6">
                    <h1 class="m-0">Form Ganti Password</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
                    
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Form Ganti Password</li>
					</ol>
				</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.container-fluid -->
		</div>
		<!-- /.content-header -->
        
        <?php
            // tampilkan pesan error validasi
            if (validation_errors()) {
            echo "<div class=\"alert alert-danger\">".validation_errors()."</div>";
            }
            // tampilkan pesan error
            if ($this->session->flashdata('error_message')) {
            echo "<div class=\"alert alert-danger\">".$this->session->flashdata('error_message')."</div>";
            }
        ?>
        
        <?php
        echo'
        <div class="container-responsive mx-3">
            <form class="form" action="'.base_url().'/anggota/submitChangePass/" method="post">
                <div class="container-md p-4 my-3 border">
                    <input class="form-control mb-3" type="text" name="kode_anggota" value="'.$data_anggota['kode_anggota'].'" hidden>
                    <input class="form-control mb-3" type="text" name="email" value="'.$data_anggota['email'].'" hidden>
                    <div class="row">
                        <label>Password Sebelumnya</label>  
                        <input class="form-control mb-3" type="text" name="old_password" placeholder="Masukan Password Lama">
                    </div>
                    <div class="row">
                        <label>Password Baru</label>  
                        <input class="form-control mb-3" type="text" name="new_password" placeholder="Masukan Password Baru">
                    </div>
                    <div class="row">
                        <label>Validasi Password</label>  
                        <input class="form-control mb-3" type="text" name="validation_password" placeholder="Masukan Kembali Password Baru">
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="'.base_url().'./anggota/displayAnggotaDetail/'.$data_anggota['kode_anggota'].'"><button type="button" class="btn btn-primary"> Back </button></a>
                        <input class="btn btn-success float-end" type="submit" name="submit" value="Save">
                    </div>
                </div>
            </form>
        </div>
        ';
        ?>
	</div>
</body>
</html>