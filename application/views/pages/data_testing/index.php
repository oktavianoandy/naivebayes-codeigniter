</div>
</div>
</div>
</div>

<!-- Page content -->
<div class="container-fluid mt--6">
  <!-- Table -->
  <div class="row">
    <div class="col">
      <div class="card">
        <!-- Card header -->
        <div class="card-header">
          <div class="row">
            <div class="col-lg-6 col-5">
              <h3 class="mb-0"><?php echo $title ?></h3>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <p class="text-sm mb-0">
                Lorem ipsum dolor sit amet consectetur adipisicing elit.
              </p>
            </div>
          </div>
        </div>
        <div class="card-body">
          <?php if ($this->session->flashdata('success') != null) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <span class="alert-icon"><i class="ni ni-like-2"></i></span>
              <span class="alert-text"><strong>Berhasil!</strong> <?php echo $this->session->flashdata('success') ?></span>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
          <?php endif ?>

          <?php if ($this->session->flashdata('failed') != null) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <span class="alert-icon"><i class="ni ni-like-2"></i></span>
              <span class="alert-text"><strong>Gagal!</strong> <?php echo $this->session->flashdata('failed') ?></span>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
          <?php endif ?>

          <div class="d-flex">
            <div class="mr-auto">
              <a href="<?php echo base_url('testing/add') ?>" class="btn btn-sm btn-success">Tambah data</a>
            </div>
            <div>
              <a href="<?php echo base_url('testing/process/all') ?>" class="btn btn-sm btn-default">Proses semua data</a>
            </div>
          </div>

          <hr class="my-4">

          <div class="table-responsive">
            <table class="table table-flush" id="datatable-basic">
              <thead class="thead-light">
                <tr>
                  <th>No</th>
                  <th>Hari</th>
                  <th>Cuaca</th>
                  <th>Suhu</th>
                  <th>Tingkat Malas</th>
                  <th>Bangun Siang</th>
                  <th>Kuliah</th>
                  <th>
                    <center>
                      Aksi
                    </center>
                  </th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1 ?>
                <?php foreach ($data_testing as $dt) : ?>
                  <tr>
                    <td><?php echo $no ?></td>
                    <td><?php echo $dt['hari'] ?></td>
                    <td><?php echo $dt['cuaca'] ?></td>
                    <td><?php echo $dt['suhu'] ?></td>
                    <td><?php echo $dt['tingkat_malas'] ?></td>
                    <td><?php echo $dt['bangun_siang'] ?></td>
                    <td><?php echo $dt['kuliah'] ?></td>
                    <td>
                      <center>
                        <?php if ($dt['kuliah'] == '??') : ?>
                          <a href="<?php echo base_url('testing/process/single/' . $dt['id']) ?>" class="btn btn-default btn-sm">Proses</a>
                        <?php else : ?>
                          <button class="btn btn-default btn-sm" disabled>Proses</button>
                        <?php endif ?>
                      </center>
                    </td>
                  </tr>
                  <?php $no++ ?>
                <?php endforeach ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>