<div>
    {{-- The best athlete wants his opponent at his best. --}}
    <div class="row mb-3">
        <div class="col-md-11">
            <input type="search" class="form-control" placeholder="PESQUISAR NOME" wire:model='search'>
        </div>
        <div class="col-md">
            <a href="{{route('view.cliente.create')}}" class="btn btn-info d-block">
                ADICIONAR
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <th>Nome</th>
                        <th>Telefone</th>
                        <th>Nascimento</th>
                        <th>Idade</th>
                        <th>Ações</th>
                    </thead>
                    <tbody>
                        @forelse ($clientes as $value)
                        <tr>
                            <td>{{$value->nome}}</td>
                            <td>{{$value->telefone}}</td>
                            <td>{{date('d/m/Y', strtotime($value->data_nasc))}}</td>
                            <td>{{Configuracao::calcIdade($value->data_nasc)}}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                      <a href="{{route('view.cliente.update', [
                                        'id' => $value->id
                                      ])}}" class="dropdown-item" type="button">
                                        Editar
                                     </a>
                                      {{-- <a class="dropdown-item" type="button" wire:click='updateStatus({{$value->id}})'>{{($value->active == 'Y')?'Desativar':'Ativar'}}</a> --}}
                                    </div>
                                  </div>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">N/A</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="col-md-12">
                    {{$clientes->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
