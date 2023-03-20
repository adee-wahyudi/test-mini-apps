    
    <header class="py-5">
        <div class="container bd-gutter pt-md-1 pb-md-4">
            <div class="row">
                <div class="col-xl-8">
                    <h1 class="bd-title mt-0"><?= $title ?></h1>
                    <!-- <p class="bd-lead">Quickly get a project started with any of our examples ranging from using parts of the framework to custom components and layouts.</p> -->
                    <div class="d-flex flex-column gap-3">
                        <div class="table-responsive">
                            <table class="table caption-top table-hover table-bordered text-center">
                                <caption>List of score</caption>
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Klub 1</th>
                                        <th scope="col">Score 1</th>
                                        <th scope="col">Klub 2</th>
                                        <th scope="col">Score 2</th>
                                        <!-- <?php if($this->session->userdata('username') == true){ ?>
                                            <th scope="col">Action</th>
                                        <?php } ?> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach($skor as $row) : ?>
                                        <tr>
                                            <td scope="row"><?= $no++ ?></td>
                                            <?php foreach($klub as $kl) : ?>
                                                <?php if($kl['id'] == $row['id_klub1']){ ?>
                                                    <td><?= $kl['nama_klub'] ?></td>
                                                <?php } ?>
                                            <?php  endforeach; ?>
                                            <td><?= $row['score1'] ?></td>
                                            <?php foreach($klub as $kl): ?>
                                                <?php if($kl['id'] == $row['id_klub2']){ ?>
                                                    <td><?= $kl['nama_klub'] ?></td>
                                                <?php } ?>
                                                <?php endforeach; ?>
                                            <td><?= $row['score2'] ?></td>
                                            <!-- <?php if($this->session->userdata('username') == true){ ?>
                                                <td>
                                                    <button type="button" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i></button>
                                                    <button type="button" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                                                    <a href="<?= base_url('skor/delete/') ?><?= $row['id'] ?>" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a>
                                                </td>
                                            <?php } ?> -->
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <?php if($this->session->userdata('username') == true){ ?>
                        <h3 class="mt-5">Input Score</h3>
                        <?= $this->session->flashdata('message'); ?>
                        <form action="<?= base_url('skor/simpan') ?>" method="POST">
                            <div class="row">
                                <div class="col-8 mb-3">
                                    <label for="klub1" class="form-label">Klub 1</label>
                                    <select class="form-select" name="klub1" aria-label="Default select example" required>
                                        <option value="">Select klub</option>
                                        <?php foreach($klub as $row) : ?>
                                            <option value="<?= $row['id'] ?>"><?= $row['nama_klub'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-4 mb-3">
                                    <label for="score1" class="form-label">Score 1</label>
                                    <input type="number" name="score1" min="0" class="form-control" id="score1" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-8 mb-3">
                                    <label for="klub2" class="form-label">Klub 2</label>
                                    <select class="form-select" name="klub2" aria-label="Default select example" required>
                                        <option value="">Select klub</option>
                                        <?php foreach($klub as $row) : ?>
                                        <option value="<?= $row['id'] ?>"><?= $row['nama_klub'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-4 mb-3">
                                    <label for="score2" class="form-label">Score 2</label>
                                    <input type="number" name="score2" min="0" class="form-control" id="score2" required>
                                </div>
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
    