<div>
    {{-- The best athlete wants his opponent at his best. --}}
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <th>Placa</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Ações</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>teste</td>
                            <td>teste</td>
                            <td>teste</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                      <a href="" class="dropdown-item" type="button">
                                        Editar
                                      </a>
                                      <a href="" class="dropdown-item" type="button">
                                        Excluir
                                      </a>
                                      {{-- <a class="dropdown-item" type="button" wire:click='updateStatus({{$value->id}})'>{{($value->active == 'Y')?'Desativar':'Ativar'}}</a> --}}
                                    </div>
                                  </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
