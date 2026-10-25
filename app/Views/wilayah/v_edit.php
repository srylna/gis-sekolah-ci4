<div class="col-md-12">
        <div class="card card-outline card-success mb-4">
         <div class="card-header">
            <h3 class="card-title"><?php echo $title; ?></h3>
</div>

      <div class="card-body">
        <php 
        session();
        $validation = \Config\Services::validation();
        ?>

      <?php echo form_open('wilayah/UpdateData/' . $wilayah['id_wilayah']) ?>
      
      <div class="row">
        <div class="col-sm-6">
         <div class="form-group mb-3">
           <label class="form-label fw-bold">Nama Wilayah</label>
           <input 
              name="nama_wilayah" 
              value="<?= $wilayah['nama_wilayah'] ?>"
              class="form-control">
              <p class="text-danger"><?= validation_show_error('nama_wilayah') ?></p>
          </div>
        </div>

        <div class="col-sm-6">
          <div class="form-group mb-3">
            <label class="form-label fw-bold">Warna Wilayah</label>
            <div class="input-group">
           <!-- Input Teks untuk Menampilkan Kode Pagar (#) -->
              <input 
                type="text" 
                name="warna" 
                id="warna_text"
                value="<?= $wilayah['warna'] ?>"
                class="form-control" 
                autocomplete="off"
              />
              <!-- Tombol / Kotak Pemilih Warna Melayang -->
              <input 
                type="color" 
                id="warna_picker"
                class="form-control form-control-color" 
                style="max-width: 45px; cursor: pointer;"
                title="Pilih Warna"
              />
            </div>
            <p class="text-danger"><?= validation_show_error('warna') ?></p>
          </div>
        </div>
      </div>

       <div class="form-group mb-3">
            <label class="form-label fw-bold">GeoJSON</label>
            <textarea
                name="geojson"
                class="form-control"
                cols="30"
                rows="10"
                ><?= $wilayah['geojson'] ?></textarea>
                 <p class="text-danger"><?= validation_show_error('geojson') ?></p>
        </div>

         <div class="mb-3">
            <button class="btn btn-primary" type="submit">Simpan</button>
            <a href="<?php echo base_url('wilayah') ?>" class="btn btn-success" >Kembali</a>
       </div>


           <?php echo form_close() ?>
      </div>
   </div>
</div>

<script>
  // Otomatis sinkronkan teks # dan kotak warna saat digeser
  document.addEventListener('DOMContentLoaded', function() {
    const textInput = document.getElementById('warna_text');
    const colorPicker = document.getElementById('warna_picker');

    colorPicker.addEventListener('input', function() {
      textInput.value = this.value;
    });

    textInput.addEventListener('input', function() {
      if(/^#[0-9A-F]{6}$/i.test(this.value)) {
        colorPicker.value = this.value;
      }
    });
  });
</script>


