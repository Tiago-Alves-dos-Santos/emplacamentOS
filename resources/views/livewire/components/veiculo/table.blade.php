<div>
    {{-- The best athlete wants his opponent at his best. --}}
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <th>Modelo</th>
                        <th>Marca</th>
                        <th>Placa</th>
                        <th>Ações</th>
                    </thead>
                    <tbody>
                        @forelse ($veiculos as $value)
                        <tr>
                            <td>{{$value->modelo}}</td>
                            <td>{{$value->marca}}</td>
                            <td>{{$value->placa}}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                      <a class="dropdown-item" type="button" wire:click='$emit("show-modal-updateVeiculo", {{$value->id}})'>
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
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">N/A</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
