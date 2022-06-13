<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <div class="row mb-3">
        <div class="col-md-11">
            <input type="search" class="form-control" placeholder="PESQUISAR">
        </div>
        <div class="col-md">
            <a href="{{route('view.user.create')}}" class="btn btn-info d-block">
                ADICIONAR
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped table-sm" style="color: black">
                <caption>Lista de usuários</caption>
                <thead class="table-light">
                  <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Email</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Ação</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($users as $value)
                    @php
                        $types = Configuracao::getTypesUser();
                    @endphp
                  <tr class="@if($value->active == 'N') table-danger @endif">
                    <td>{{$value->name}}</td>
                    <td>{{$value->email}}</td>
                    @if ($value->type == 'admin')
                    <td>
                        <span class="badge badge-success badge-pill">{{$types[$value->type]}}</span>
                    </td>
                    @else
                    <td>
                        <span class="badge badge-primary badge-pill">{{$types[$value->type]}}</span>
                    </td>
                    @endif
                    <td>
                        <div class="dropdown">
                            <button class="btn" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                              <a href="{{route('view.user.update', [
                                'id' => $value->id
                              ])}}" class="dropdown-item" type="button">
                                Editar
                             </a>
                              <a class="dropdown-item" type="button" wire:click='updateStatus({{$value->id}})'>{{($value->active == 'Y')?'Desativar':'Ativar'}}</a>
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
