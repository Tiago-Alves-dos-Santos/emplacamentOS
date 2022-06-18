<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <form action="">
        <div class="form-row">
            <div class="col-md-6">
                <input type="search" wire:model='search_cliente' class="select-search form-control" placeholder="Nome cliente">
            </div>
            <div class="col-md-6">
                <select name="" id="" class="custom-select" wire:model.defer='cliente_id' wire:change='setIdCliente'>
                    <option value="" selected>Selecione</option>
                    @foreach ($clientes as $value)
                        <option value="{{$value->id}}">{{$value->nome}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-row mt-3">
            <div class="col-md-6">
                <input type="search" class="select-search form-control" placeholder="Placa">
            </div>
            <div class="col-md-6">
                <select name="" id="" class="custom-select" wire:model.defer='cliente_id' wire:change='setIdCliente'>
                    <option value="" selected>Selecione</option>
                    @foreach ($clientes as $value)
                        <option value="{{$value->id}}">{{$value->nome}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-row mt-3">
            <div class="col-md-12">
                <input type="search" wire:model='search' class="select-search form-control" placeholder="Serviço">
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                            <th>Serviço</th>
                            <th>Tipo</th>
                            <th>Valor</th>
                            <th>Taxas</th>
                            <th style="width: 20%">Ações</th>
                        </thead>
                        <tbody>
                            @forelse ($servicos as $value)
                            @php
                                $total_taxas = 0;
                                foreach ($value->taxas as $value_taxa){
                                    $total_taxas += $value_taxa->servico_taxas->valor_taxa;
                                }

                            @endphp
                            <tr>
                                <td>{{$value->nome}}</td>
                                @if ($value->valor_type == 'fixo')
                                <td>
                                    <span class="badge badge-primary badge-pill">FIXO</span>
                                </td>
                                @else
                                <td>
                                    <span class="badge badge-info badge-pill">VARIÁVEL</span>
                                </td>
                                @endif
                                <td>{{Configuracao::getDbMoney($value->valor)}}</td>
                                <td class="@if($total_taxas > 0) text-danger @endif">{{Configuracao::getDbMoney($total_taxas)}}</td>
                                <td class="d-flex">
                                    <a class="btn btn-outline-success" wire:click='setServico({{$value->id}})'>
                                        <div wire:loading.remove wire:target="setServico({{$value->id}})">
                                            <span>ADICIONAR</span>
                                        </div>
                                        <div wire:loading wire:target="setServico({{$value->id}})">
                                            <i class="fa-solid fa-spinner rotate"></i>
                                        </div>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td class="text-center" colspan="5">N/A</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="form-row mt-5">
            <div class="col-md-12 d-flex justify-content-end">
                <button type="button" class="btn btn-success btn-lg" wire:click='salvar'>
                    SALVAR OS
                </button>
            </div>
        </div>
    </form>
</div>
