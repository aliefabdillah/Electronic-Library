	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="container-fluid">
				<div class="row">
				<div class="col-sm-6">
                    <h1 class="m-0">Form Koleksi</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
                    
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Form Edit Koleksi</li>
					</ol>
				</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.container-fluid -->
		</div>
		<!-- /.content-header -->
        
         <!-- Alert CRUD -->
		<?php
            // tampilkan pesan error
            if ($this->session->flashdata('error_message')) {
                echo "<div class=\"alert alert-danger\">".$this->session->flashdata('error_message')."</div>";
            }
        ?>
       
        <?php
        echo
        '
        <div class="container-responsive mx-3">
            <form class="form" action="'.base_url().'/koleksi/submitEdit/" method="post">
                <div class="container-md p-4 my-3 border">
                    <input class="form-control mb-3" type="text" name="id_koleksi" value="'.$data_koleksi->id_koleksi.'" hidden>
                    <div class="row">
                        <label>Id Biblio</label>  
                        <input class="form-control mb-3" type="text" name="id_biblio" value="'.$data_koleksi->id_biblio.'" readonly>
                    </div>
                    <div class="row">
                        <label>Judul</label>  
                        <input class="form-control mb-3" type="text" name="judul" value="'.$data_koleksi->judul.'" readonly>
                    </div>
                    <div class="row">
                        <label>Kode Koleksi</label>  
                        <input class="form-control" type="text" name="kode_koleksi" id="f_kode_koleksi" value="'.$data_koleksi->kode_koleksi.'">
                    </div>
                    <div class="row">
							<input class="form-check-input ms-1" type="checkbox" name="disabled_fkode" id="disabled_fkode" data-id="'.$data_koleksi->kode_koleksi.'">
                        	<label class="form-check-label ms-3 mb-3">Ceklis Jika Koleksi Bukan Merupakan Referensi</label>
						</div>
                    <div class="row">
                        <label>Poisis Rak</label>  
                        <input class="form-control mb-3" type="text" name="posisi_rak" value="'.$data_koleksi->posisi_rak.'">
                    </div>
                    <div class="row">
                        <label>Kondisi</label>  
                        <input class="form-control mb-3" type="text" name="kondisi" value="'.$data_koleksi->kondisi.'">
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="'.base_url().'./koleksi/displayKoleksi/'.$data_koleksi->id_biblio.'"><button type="button" class="btn btn-primary"> Back </button></a>
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