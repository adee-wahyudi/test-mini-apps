    
    <header class="py-5">
        <div class="container bd-gutter pt-md-1 pb-md-4">
            <div class="row">
                <div class="col-xl-8">
                    <h1 class="bd-title mt-0"><?= $title ?></h1>
                    <!-- <p class="bd-lead">Quickly get a project started with any of our examples ranging from using parts of the framework to custom components and layouts.</p> -->
                    <div class="d-flex flex-column gap-3">
                        <div class="table-responsive">
                            <table class="table caption-top table-hover table-bordered text-center">
                                <caption>List of klub</caption>
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Klub</th>
                                        <th scope="col">Kota</th>
                                        <?php if($this->session->userdata('username') == true){ ?>
                                            <th scope="col">Action</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach($klub as $row) : ?>
                                        <tr>
                                            <td scope="row"><?= $no++ ?></td>
                                            <td><?= $row['nama_klub'] ?></td>
                                            <td><?= $row['kota'] ?></td>
                                            <?php if($this->session->userdata('username') == true){ ?>
                                                <td>
                                                    <!-- <button type="button" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i></button> -->
                                                    <!-- <button type="button" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button> -->
                                                    <a href="<?= base_url('klub/delete/') ?><?= $row['id'] ?>" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a>
                                                </td>
                                            <?php } ?>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <?php if($this->session->userdata('username') == true){ ?>
                        <h3 class="mt-5">Input Klub</h3>
                        <?= $this->session->flashdata('message'); ?>
                        <form action="<?= base_url('klub/simpan') ?>" method="POST">
                            <div class="mb-3">
                                <label for="nama_klub" class="form-label">Nama Klub</label>
                                <input type="text" name="nama_klub" class="form-control" id="nama_klub" required>
                            </div>
                            <div class="mb-3">
                                <label for="kota" class="form-label">Kota</label>
                                <input type="text" name="kota" class="form-control" id="kota" required>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary" type="submit">Save</button>
                            </div>
                        </form>
                    <?php } ?>
                </div>
            </div>
        </div>
    </header>
    