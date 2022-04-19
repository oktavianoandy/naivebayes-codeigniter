</div>
</div>
</div>
</div>

<!-- Page content -->
<div class="container-fluid mt--6">
    <!-- Table -->
    <div class="row">
        <div class="col">
            <form action="<?php echo base_url('testing/add') ?>" method="POST">
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
                        <div class="form-group">
                            <label class="form-control-label" for="hari">Hari ke-</label>

                            <?php if (form_error('hari')) : ?>
                                <input type="number" class="form-control form-control-sm is-invalid" id="hari" placeholder="Masukkan hari" name="hari">
                                <?php echo form_error('hari') ?>
                            <?php else : ?>
                                <input type="number" class="form-control form-control-sm" id="hari" placeholder="Masukkan hari" name="hari">
                            <?php endif ?>

                        </div>

                        <div class="form-group">
                            <label class="form-control-label" for="cuaca">Keadaan Cuaca</label>
                            <div class="form-group">
                                <div class="form-check form-check-inline">
                                    <div class="custom-control custom-radio">
                                        <input name="cuaca" class="custom-control-input" id="hujan" type="radio" value="Hujan" checked>
                                        <label class="custom-control-label" for="hujan">Hujan</label>
                                    </div>
                                </div>
                                <div class="form-check form-check-inline">
                                    <div class="custom-control custom-radio">
                                        <input name="cuaca" class="custom-control-input" id="mendung" type="radio" value="Mendung">
                                        <label class="custom-control-label" for="mendung">Mendung</label>
                                    </div>
                                </div>
                                <div class="form-check form-check-inline">
                                    <div class="custom-control custom-radio">
                                        <input name="cuaca" class="custom-control-input" id="cerah" type="radio" value="Cerah">
                                        <label class="custom-control-label" for="cerah">Cerah</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label" for="suhu">Keadaan Suhu</label>
                            <div class="form-group">
                                <div class="form-check form-check-inline">
                                    <div class="custom-control custom-radio">
                                        <input name="suhu" class="custom-control-input" id="panas" type="radio" value="Panas" checked>
                                        <label class="custom-control-label" for="panas">Panas</label>
                                    </div>
                                </div>
                                <div class="form-check form-check-inline">
                                    <div class="custom-control custom-radio">
                                        <input name="suhu" class="custom-control-input" id="sejuk" type="radio" value="Sejuk">
                                        <label class="custom-control-label" for="sejuk">Sejuk</label>
                                    </div>
                                </div>
                                <div class="form-check form-check-inline">
                                    <div class="custom-control custom-radio">
                                        <input name="suhu" class="custom-control-input" id="dingin" type="radio" value="Dingin">
                                        <label class="custom-control-label" for="dingin">Dingin</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label" for="tingkat_malas">Tingkat Kemalasan</label>
                            <div class="form-group">
                                <div class="form-check form-check-inline">
                                    <div class="custom-control custom-radio">
                                        <input name="tingkat_malas" class="custom-control-input" id="normal" type="radio" value="Normal" checked>
                                        <label class="custom-control-label" for="normal">Normal</label>
                                    </div>
                                </div>
                                <div class="form-check form-check-inline">
                                    <div class="custom-control custom-radio">
                                        <input name="tingkat_malas" class="custom-control-input" id="tinggi" type="radio" value="Tinggi">
                                        <label class="custom-control-label" for="tinggi">Tinggi</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label" for="bangun_siang">Bangun Kesiangan</label>
                            <div class="form-group">
                                <div class="form-check form-check-inline">
                                    <div class="custom-control custom-radio">
                                        <input name="bangun_siang" class="custom-control-input" id="ya" type="radio" value="Ya" checked>
                                        <label class="custom-control-label" for="ya">Ya</label>
                                    </div>
                                </div>
                                <div class="form-check form-check-inline">
                                    <div class="custom-control custom-radio">
                                        <input name="bangun_siang" class="custom-control-input" id="tidak" type="radio" value="Tidak">
                                        <label class="custom-control-label" for="tidak">Tidak</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-sm btn-success" type="submit">Tambah data</button>
                        <a href="<?php echo base_url('testing') ?>" class="btn btn-sm btn-neutral">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>