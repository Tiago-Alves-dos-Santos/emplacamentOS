<div>
    {{-- Stop trying to control. --}}
    <div class="row mb-3">
        <div class="col-md-12 order-sm-last">
            <input type="search" class="form-control" placeholder="PESQUISAR">
        </div>
        <div class="col-md-12 d-flex justify-content-end mt-sm-2 mb-sm-2">
            <button type="button" href="" class="btn btn-info d-block" data-toggle="modal" data-target="#cadastrarServico">
                ADICIONAR
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <th>COD</th>
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
                            <td>{{$value->id}}</td>
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
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </div>
                                    <div wire:loading wire:target="setServico({{$value->id}})">
                                        <i class="fa-solid fa-spinner rotate"></i>
                                    </div>
                                </a>
                                <a href="{{route('view.servico.vincular-taxas', [
                                    'servico_id' => $value->id
                                ])}}" class="btn btn-outline-info ml-2">
                                    TAXAS
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

    <x-modal id="cadastrarServico" titulo="Novo serviço">
        <livewire:components.servico.form-create>
    </x-modal>

    <x-modal id="atualizarServico" titulo="Ajustar serviço">
        <livewire:components.servico.form-update>
    </x-modal>
</div>
