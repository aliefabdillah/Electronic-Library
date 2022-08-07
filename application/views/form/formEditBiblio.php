	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="container-fluid">
				<div class="row">
				<div class="col-sm-6">
                    <h1 class="m-0">Form Edit Bibliografi</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
                    
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Form Edit Bibliografi</li>
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
        echo'
        <div class="container-responsive mx-3">
        <form class="form" action="'.base_url().'/home/submitEdit'.'" method="post" enctype="multipart/form-data">
            <div class="container-md p-4 my-3 border">
                <input class="form-control mb-3" type="text" name="id_biblio" value="'.$data_biblio->id_biblio.'" hidden>
                <div class="row">
                    <label>Judul</label>  
                    <input class="form-control mb-3" type="text" name="judul" value="'.$data_biblio->judul.'">
                </div>
                <div class="row">
                    <label>Kode Buku</label>  
                    <input class="form-control mb-3" type="text" name="kode_buku" value="'.$data_biblio->kode_buku.'">
                </div>
                <div class="row">
                    <label>Pengarang</label>  
                    <input class="form-control mb-3" type="text" name="pengarang" value="'.$data_biblio->pengarang.'">
                </div>
                <div class="row">
                    <label>Penerbit</label>  
                    <input class="form-control mb-3" type="text" name="penerbit" value="'.$data_biblio->penerbit.'">
                </div>
                <div class="row">
                    <label>Tahun Terbit</label>  
                    <input class="form-control mb-3" type="number" name="thn_terbit" value="'.$data_biblio->thn_terbit.'">
                </div>
                <div class="row">
                    <label>Bahasa</label>  
                    <input class="form-control mb-3" type="text" name="bahasa" value="'.$data_biblio->bahasa.'">
                </div>
                <div class="row">
                    <label>ISBN</label>  
                    <input class="form-control mb-3" type="text" name="isbn" value="'.$data_biblio->isbn.'">
                </div>
                <div class="row">
                    <label>Jumlah Copy</label>  
                    <input class="form-control mb-3" type="number" name="copy" value="'.$data_biblio->jmlh_buku.'">
                </div>
                <div class="row">
                    <label>Kategori</label>  
                    <input class="form-control mb-3" type="text" name="kategori" value="'.$data_biblio->kategori.'">
                </div>
                <div class="row">
                    <label>Foto Buku</label>  
                    <input class="form-control mb-3" type="file" name="foto">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <input class="btn btn-success" type="submit" name="submit" value="Save">
                </div>
            </div>
        </form>
        </div>
        ';
        ?>
	</div>
</body>
</html>