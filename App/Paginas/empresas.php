<?php $v->layout("layout"); ?>

<?php $v->start('css'); ?>
    <style>
        .table td{
            vertical-align: middle;
        }

        .table thead th, .table tfoot th{
            padding-top: 10px;
            padding-bottom: 10px;
        }
    </style>
<?php $v->end(); ?>

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">
                    Lista de Empresas
                </h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item">
                                <a href="<?= $router->route('app.home'); ?>">Pedidos</a> / Empresas
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-5 align-self-center">
                <div class="customize-input float-right">
                    <button class="custom-select custom-select-set form-control bg-primary text-white border-0 custom-shadow custom-radius btnCadastrar">
                       Cadastrar
                    </button>
                </div>
            </div>
        </div>
    </div>

<? if($emp){ ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th class="text-center" width="5%">ID</th>
                                        <th width="32%">Razão Social</th>
                                        <th width="20%">Nome Fantasia</th>
                                        <th width="20%">CNPJ</th>
                                        <th></th>
                                    </tr>
                                </thead>

                                <tfoot class="bg-primary text-white">
                                    <tr>
                                        <th class="text-center" width="5%">ID</th>
                                        <th width="32%">Razão Social</th>
                                        <th width="20%">Nome Fantasia</th>
                                        <th width="20%">CNPJ</th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<? } ?>

    <div id="modalCadastrar" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="primary-header-modalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <h4 class="modal-title" id="primary-header-modalLabel">Cadastro de Empresas</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <form id="formCad">
                    <input type="hidden" name="tipo" id="tipo" value="1">
                    <div class="modal-body">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" name="razao" id="razao" class="form-control" placeholder="Razão Social" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" name="fantasia" id="fantasia" class="form-control" placeholder="Nome Fantasia" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-0">
                                        <input type="text" name="cnpj" id="cnpj" class="form-control" placeholder="CNPJ" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php $v->start('script'); ?>
    <script>
        $(document).ready(function() {
            $('input[name="cnpj"]').mask('00.000.000/0000-00', {reverse: true});
        });

        <? if($emp){ ?>
            $('#zero_config').DataTable({
                data: <?= $emp; ?>,
                "order": [[ 0, "asc" ]],
                "bAutoWidth": false,
                "columns": [
                    { class:'text-center', orderable: false },
                    { class:'text-left' },
                    { class:'text-left' },
                    { class:'text-left' },
                    { class:'text-right', orderable: false }
                ],
                "oLanguage": {
                    "sUrl": "assets/pt_br.json",
                },
                "pageLength": 5,
                "bLengthChange" : false
            });
        <? } ?>

        $(document).on('click', '.btnCadastrar', function (e) {
            e.preventDefault();
            $('.modal-title').html('Cadastro de Empresas');
            $('#formCad #tipo').val(1);
            $('#modalCadastrar').modal();
        });

        $(document).on('submit', '#formCad', function (e) {
            e.preventDefault();

            $.ajax({
                type: "POST",
                dataType: "json",
                url: '<?= $router->route ('empresas.exec'); ?>',
                data: $(this).serialize(),
                success: function (result) {
                    if(result.error){
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: '<h3>CNPJ já cadastrado!</h3>',
                            showConfirmButton: false,
                            timer: 2500
                        }).then((result) => {
                            $('input[name="cnpj"]').val('').focus();
                        });

                        return;
                    }

                    if(result.cad) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: '<h3>Empresa cadastrada com sucesso!</h3>',
                            showConfirmButton: false,
                            timer: 2500
                        }).then((result) => {
                            window.location.reload();
                        });
                    }

                    if(result.alt) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: '<h3>Empresa alterada com sucesso!</h3>',
                            showConfirmButton: false,
                            timer: 2500
                        }).then((result) => {
                            window.location.reload();
                        });
                    }
                }
            });
        });

        $(document).on('click', '.btnEditar', function (e) {
            e.preventDefault();
            var data = $(this).data();

            $.ajax({
                type: "POST",
                dataType: "json",
                url: '<?= $router->route ('empresas.editar'); ?>',
                data: {id: data.id},
                success: function (result) {
                    $('.modal-title').html('Alteração de Empresas');
                    $('#formCad').append('<input type="hidden" name="id" value="'+result.id+'">');
                    $('#formCad #tipo').val(2);
                    $('#formCad #razao').val(result.razao);
                    $('#formCad #fantasia').val(result.fantasia);
                    $('#formCad #cnpj').val(result.cnpj);
                    $('#modalCadastrar').modal();
                }
            });
        });

        $(document).on('click', '.btnExec', function (e) {
            e.preventDefault();
            var data = $(this).data();

            Swal.fire({
                title: 'Exclusão de Empresas',
                text: "Deseja realmente excluir essa empresa ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim',
                cancelButtonText: 'Não'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: '<?= $router->route ('empresas.exec'); ?>',
                        data: {tipo: data.tipo, id: data.id},
                        success: function (result) {
                            if(data.tipo == 3){
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: '<h3>Empresa excluida com sucesso!</h3>',
                                    showConfirmButton: false,
                                    timer: 2500
                                }).then((result) => {
                                    window.location.reload();
                                });
                            }
                        }
                    });
                }
            });
        });

        $('#modalCadastrar').on('shown.bs.modal', function () {
            $('#razao').focus();
        });

        $('#modalCadastrar').on('hidden.bs.modal', function (e) {
            $('input[name="id"]').remove();
            $('#formCad input').val('');
        });
    </script>
<?php $v->end(); ?>