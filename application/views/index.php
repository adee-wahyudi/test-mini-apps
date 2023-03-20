    
    <header class="py-5">
        <div class="container bd-gutter pt-md-1 pb-md-4">
            <div class="row">
                <div class="col-xl-8">
                    <h1 class="bd-title mt-0"><?= $title ?></h1>
                    <!-- <p class="bd-lead">Quickly get a project started with any of our examples ranging from using parts of the framework to custom components and layouts.</p> -->
                    <div class="d-flex flex-column gap-3">
                        <div class="table-responsive">
                            <table class="table caption-top table-hover table-bordered text-center">
                                <caption>List of klasemen</caption>
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Klub</th>
                                        <th scope="col">Ma</th>
                                        <th scope="col">Me</th>
                                        <th scope="col">S</th>
                                        <th scope="col">K</th>
                                        <th scope="col">GM</th>
                                        <th scope="col">GK</th>
                                        <th scope="col">Point</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1 ?>
                                    <?php foreach($klasemen as $row): ?>
                                        <tr>
                                            <td scope="row"><?= $no++ ?></td>
                                            <td><?= $row['nama_klub'] ?></td>
                                            <td><?= $row['main'] ?></td>
                                            <td><?= $row['menang'] ?></td>
                                            <td><?= $row['seri'] ?></td>
                                            <td><?= $row['kalah'] ?></td>
                                            <td><?= $row['goal_menang'] ?></td>
                                            <td><?= $row['goal_kalah'] ?></td>
                                            <td><?= $row['point'] ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="mt-5">
                        <table class="table table-sm">
                            <tbody>
                                <tr>
                                    <td colspan="3">Keterangan :</td>
                                </tr>
                                <tr>
                                    <td>Ma</td>
                                    <td>=</td>
                                    <td>Main</td>
                                </tr>
                                <tr>
                                    <td>Me</td>
                                    <td>=</td>
                                    <td>Menang</td>
                                </tr>
                                <tr>
                                    <td>S</td>
                                    <td>=</td>
                                    <td>Seri</td>
                                </tr>
                                <tr>
                                    <td>K</td>
                                    <td>=</td>
                                    <td>Kalah</td>
                                </tr>
                                <tr>
                                    <td>GM</td>
                                    <td>=</td>
                                    <td>Goal Menang (Total gol yang dicetak tim tersebut)</td>
                                </tr>
                                <tr>
                                    <td>GK</td>
                                    <td>=</td>
                                    <td>Goal Kalah (Total gol yang dicetak tim lawan terhadap tim tersebut)</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </header>
    