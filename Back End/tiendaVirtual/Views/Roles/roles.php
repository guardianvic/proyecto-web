<?php 
    headerAdmin($data); 
    getModal('modalRoles',$data);
?>
    <div id="contentAjax"></div>
    <main class="app-content">
          <div class="app-title">
        <div>
          <h1><i class="bi bi-table"></i> <?= $data['page_title'] ?>
            <button class="btn btn-success" type="button" onclick="openModal();" ><i class="bi bi-person-fill-add fs-4 "></i> Nuevo</button>
          </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>         
          <li class="breadcrumb-item active"><a href="<?= base_url(); ?>/roles"><?= $data['page_title'] ?></a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="tableRoles">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Nombre</th>
                      <th>Descripcion</th>
                      <th>Status</th>
                      <th>Acciones</th>                     
                    </tr>
                  </thead>
                  <tbody>                  
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
    <?php footerAdmin($data); ?>