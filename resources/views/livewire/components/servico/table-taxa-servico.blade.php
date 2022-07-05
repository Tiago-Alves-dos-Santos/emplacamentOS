<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <div class="table-responsive">
        <table class="table table-striped table-sm" style="overflow-x: hidden">
            <thead>
                <th>Taxa</th>
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
                        <a  class="btn btn-outline-danger" wire:click='desvincular({{$value->servico_taxas->id}})'>
                            <div wire:loading.remove wire:target="desvincular({{$value->servico_taxas->id}})">
                                <i class="fa-solid fa-xmark"></i>
                            </div>
                            <div wire:loading wire:target="desvincular({{$value->servico_taxas->id}})">
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
        {{$taxas_servico->links()}}
    </div>
</div>
