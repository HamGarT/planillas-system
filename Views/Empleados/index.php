<?php include "Views/Templates/header.php"; ?>

<section class="home">
   <div class="section-title">Empleados</div>
   <button class="btn btn-outline-primary mb-2" type="button" onclick="frmEmpleados()"><i class="fas fa-plus"></i>Agregar</button>
   <div class="container-table table-responsive">
      <table class="table  table-hover display responsive nowrap text-center" id="tblEmpleados" style="width: 100%;">
         <thead class='text-white'>
            <tr>
               <th>id</th>
               <th>DNI</th>
               <th>1º Nombre</th>
               <th>2º Nombre</th>
               <th>Apellido Paterno</th>
               <th>Apellido Materno</th>
               <th>Edad</th>
               <th>direccion</th>
               <th>Cargo</th>
               <th>Area</th>
               <th></th>
               <th></th>
            </tr>
         </thead>
         <tbody>

         </tbody>
      </table>
   </div>

   <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="Label" aria-hidden="true">
      <div class="modal-dialog modal-lg">
         <div class="modal-content">
            <div class="modal-header bg-info text-white">
               <h5 class="modal-title" id="title"></h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formulario" onsubmit="registrarEmpleado(event);" autocomplete="off">
               <div class="modal-body">
                  <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                     <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                     </symbol>
                     <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                     </symbol>
                     <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                     </symbol>
                  </svg>
                  <div class="alert alert-info d-flex align-items-center" role="alert">
                     <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:">
                        <use xlink:href="#info-fill" />
                     </svg>
                     <div>
                        Todo los campos con <span class="text-danger fw-bold">*</span> son obligatorio.
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-floating mb-3" data-bs-toggle="tooltip" data-bs-placement="bottom" title="La placa es requerido">
                           <input type="hidden" id="id" name="id">
                           <input id="dni" class="form-control" type="text" name="dni" placeholder="Código de barras" required>
                           <label for="dni"><i class="fas fa-barcode"></i> DNI <span class="text-danger fw-bold">*</span></label>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-floating mb-3" data-bs-toggle="tooltip" data-bs-placement="bottom" title="La placa es requerido">
                           <input id="p_nombre" class="form-control" type="text" name="p_nombre" placeholder="Código de barras">
                           <label for="p_nombre"><i class="fas fa-barcode"></i> Primer Nombre <span class="text-danger fw-bold">*</span></label>
                        </div>
                     </div>


                  </div>
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-floating mb-3" data-bs-toggle="tooltip" data-bs-placement="bottom" title="La placa es requerido">
                           <input id="s_nombre" class="form-control" type="text" name="s_nombre" placeholder="Código de barras" required>
                           <label for="s_nombre"><i class="fas fa-barcode"></i> Segundo Nombre <span class="text-danger fw-bold">*</span></label>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-floating mb-3" data-bs-toggle="tooltip" data-bs-placement="bottom" title="La placa es requerido">
                           <input id="p_apellido" class="form-control" type="text" name="p_apellido" placeholder="Código de barras" required>
                           <label for="p_apellido"><i class="fas fa-barcode"></i> Apellido Paterno <span class="text-danger fw-bold">*</span></label>
                        </div>
                     </div>


                  </div>
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-floating mb-3" data-bs-toggle="tooltip" data-bs-placement="bottom" title="La placa es requerido">
                           <input id="s_apellido" class="form-control" type="text" name="s_apellido" placeholder="Código de barras" required>
                           <label for="s_apellido"><i class="fas fa-barcode"></i> Apellido Materno <span class="text-danger fw-bold">*</span></label>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-floating mb-3" data-bs-toggle="tooltip" data-bs-placement="bottom" title="La placa es requerido">
                           <input id="edad" class="form-control" type="text" name="edad" placeholder="Código de barras" required>
                           <label for="edad"><i class="fas fa-barcode"></i> Edad <span class="text-danger fw-bold">*</span></label>
                        </div>
                     </div>


                  </div>
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-floating mb-3" data-bs-toggle="tooltip" data-bs-placement="bottom" title="La placa es requerido">
                           <input id="fech_nacimiento" class="form-control" type="date" name="fech_nacimiento" placeholder="Código de barras" required>
                           <label for="fech_nacimiento"><i class="fas fa-barcode"></i> Fecha de Nacimiento <span class="text-danger fw-bold">*</span></label>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-floating mb-3" data-bs-toggle="tooltip" data-bs-placement="bottom" title="La placa es requerido">
                           <input id="direccion" class="form-control" type="text" name="direccion" placeholder="Código de barras" required>
                           <label for="direccion"><i class="fas fa-barcode"></i> Direccion <span class="text-danger fw-bold">*</span></label>
                        </div>
                     </div>


                  </div>

                  <div class="row">
                    
                     <div class="col-md-6">
                        <div class="form-floating mb-3" data-bs-toggle="tooltip" data-bs-placement="bottom" title="La marca es requerido">
                           <select id="cargo" class="form-control" name="cargo" required>
                              <?php foreach ($data as $row) { ?>
                                 <option value="<?php echo $row['id']; ?>"><?php echo $row['nom_Cargo']; ?></option>
                              <?php } ?>
                           </select>
                           <label for="cargo"><i class="fas fa-balance-scale"></i> Cargos <span class="text-danger fw-bold">*</span></label>
                        </div>
                     </div>


                  </div>
               </div>
               <div class="modal-footer">
                  <button class="btn btn-outline-primary" type="submit" id="btnAccion">Registrar</button>
                  <button class="btn btn-outline-danger" type="button" data-bs-dismiss="modal">Cancelar</button>
               </div>
            </form>
         </div>
      </div>
   </div>


</section>
<?php include "Views/Templates/footer.php"; ?>