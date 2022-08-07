	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="container-fluid">
				<div class="row">
				<div class="col-sm-6">
                    <h1 class="m-0">Form Edit Anggota</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
                    
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Form Edit Anggota</li>
					</ol>
				</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.container-fluid -->
		</div>
		<!-- /.content-header -->
        
        <?php
            // tampilkan pesan error
            if ($this->session->flashdata('error_message')) {
            echo "<div class=\"alert alert-danger\">".$this->session->flashdata('error_message')."</div>";
            }
        ?>
        <?php
        echo'
        <div class="container-responsive mx-3">
            <form class="form" action="'.base_url().'/anggota/submitEdit/" method="post">
                <div class="container-md p-4 my-3 border">
                    <div class="row">
                        <label>Kode Anggota</label>  
                        <input class="form-control mb-3" type="text" name="kode_anggota" value="'.$data_update->kode_anggota.'" readonly>
                    </div>
                    <div class="row">
                        <label>Nomor Induk Kependudukan (NIK)</label>  
                        <input class="form-control mb-3" type="text" name="nik" value="'.$data_update->nik.'">
                    </div>
                    <div class="row">
                        <label>Email</label>  
                        <input class="form-control mb-3" type="email" name="email" value="'.$data_update->email.'">
                    </div>
                    <div class="row">
                        <label>Alamat</label>  
                        <textarea class="form-control mb-3" type="textarea" name="alamat">'.$data_update->alamat.'</textarea>
                    </div>
                    <div class="row">
                        <label>Nomor Telepon</label>  
                        <input class="form-control mb-3" type="text" name="telepon" value="'.$data_update->no_telepon.'">
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="'.base_url().'./anggota/displayAnggotaDetail/'.$data_update->kode_anggota.'"><button type="button" class="btn btn-primary"> Back </button></a>
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