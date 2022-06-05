<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Tables</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data Table</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Cerdos</h6>
                    <p class="text-muted mb-3">Read the <a href="https://datatables.net/" target="_blank"> Official DataTables Documentation </a>for a full list of instructions and other options.</p>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Raza</th>
                                    <th>Peso (kg)</th>
                                    <th>Fecha Nacimiento</th>
                                    <th>Estado</th>
                                    <th>Lote</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>                                
                            <?php foreach($animales as $animal): ?>
                                <tr>
                                    <td><?= $animal['id'] ?></td>
                                    <td><?= $animal['raza'] ?></td>
                                    <td><?= $animal['peso'] ?></td>
                                    <td><?= $animal['fecha_nacimiento'] ?></td>
                                    <td><?= $animal['estado'] ?></td>
                                    <td><?= $animal['lote'] ?></td>
                                    <td>                                        
                                        <a class="btn btn-danger text-white me-2 mb-2 mb-md-0" href="<?= base_url() ?>/Cerdos/delete/<?= $animal['id'] ?>">Eliminar</a>
                                        <a class="btn btn-primary text-white me-2 mb-2 mb-md-0" href="<?= base_url() ?>/Cerdos/update/<?= $animal['id'] ?>">Editar</a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                            </tbody>
                            <ul class="pagination">
                                <li class="paginate_button page-item previous" id="dataTableExample_previous"><a href="#" aria-controls="dataTableExample" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li>
                                <li class="paginate_button page-item "><a href="#" aria-controls="dataTableExample" data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
                                <li class="paginate_button page-item "><a href="#" aria-controls="dataTableExample" data-dt-idx="2" tabindex="0" class="page-link">2</a></li>
                                <li class="paginate_button page-item active"><a href="#" aria-controls="dataTableExample" data-dt-idx="3" tabindex="0" class="page-link">3</a></li>
                                <li class="paginate_button page-item next disabled" id="dataTableExample_next"><a href="#" aria-controls="dataTableExample" data-dt-idx="4" tabindex="0" class="page-link">Next</a></li>
                            </ul>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>