<div>
    {{-- Do your work, then step back. --}}
    <div class="row mb-3">
        <div class="col-md-11">
            <input type="search" class="form-control" placeholder="PESQUISAR NOME" wire:model='search'>
        </div>
        <div class="col-md">
            <button type="button" href="" class="btn btn-info d-block" data-toggle="modal" data-target="#cadastrarTaxa">
                ADICIONAR
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <th>Taxa</th>
                        <th>Tipo</th>
                        <th>Valor</th>
                        <th style="width: 20%">Ações</th>
                    </thead>
                    <tbody>
                        @forelse ($taxas as $value)
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
                            <td class="d-flex">
                                <a class="btn btn-outline-success" wire:click='setTaxa({{$value->id}})'>
                                    <div wire:loading.remove wire:target="setTaxa({{$value->id}})">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </div>
                                    <div wire:loading wire:target="setTaxa({{$value->id}})">
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
                <div class="col-md-12">
                    {{$taxas->links()}}
                </div>
            </div>
        </div>
    </div>

    <x-modal id="cadastrarTaxa" titulo="Nova taxa">
        <livewire:components.taxa.form-create>
    </x-modal>

    <x-modal id="atualizarTaxa" titulo="Ajustar taxa">
        <livewire:components.taxa.form-update>
    </x-modal>
</div>
