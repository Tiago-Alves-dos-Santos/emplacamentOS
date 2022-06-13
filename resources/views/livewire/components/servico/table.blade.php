<div>
    {{-- Stop trying to control. --}}
    <div class="row mb-3">
        <div class="col-md-11">
            <input type="search" class="form-control" placeholder="PESQUISAR">
        </div>
        <div class="col-md">
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
                        <th>Nome</th>
                        <th>Tipo</th>
                        <th>Valor</th>
                        <th style="width: 20%">Ações</th>
                    </thead>
                    <tbody>
                        @forelse ($servicos as $value)
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
                                <a class="btn btn-outline-success" wire:click=''>
                                    <i class="fa-solid fa-pen-to-square"></i>
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
</div>
