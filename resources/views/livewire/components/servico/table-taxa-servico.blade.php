<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <th>Serviço</th>
                <th>Tipo</th>
                <th>Valor</th>
                <th style="width: 20%">Ações</th>
            </thead>
            <tbody>
                @forelse ($taxas_servico as $value)
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
                    <td>{{Configuracao::getDbMoney($value->servico_taxas->valor_taxa)}}</td>
                    <td class="d-flex">
                        <a class="btn btn-outline-success" wire:click='setServico({{$value->id}})'>
                            <div wire:loading.remove wire:target="setServico({{$value->id}})">
                                <i class="fa-solid fa-pen-to-square"></i>
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
