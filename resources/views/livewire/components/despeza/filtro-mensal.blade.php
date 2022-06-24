<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <div class="row">
        <div class="col-md-2">
            <input type="month" class="form-control" wire:model.defer='mes_referente_search'>
        </div>
        <div class="col-md-2">
            <button type="button" class="btn btn-info" wire:click='buscar'>
                BUSCAR
                <div class="loader ml-2" wire:loading></div>
            </button>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <th>Despeza</th>
                        <th>Valor</th>
                        <th>Fornecedor</th>
                        <th>Ações</th>
                    </thead>
                    <tbody>
                        @forelse ($despezas as $value)
                        <tr>
                            <td>{{$value->nome}}</td>
                            <td>{{Configuracao::getDbMoney($value->valor)}}</td>
                            <td>{{$value->fornecedor->nome ?? '-'}}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
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

            <div class="shadow-sm p-3 mb-5 bg-white rounded text-danger">
               R$ {{Configuracao::getDbMoney($total_despeza_mensal)}}
            </div>
        </div>
    </div>
</div>
