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
                    </thead>
                    <tbody>
                        <tr>
                            <td>Teste</td>
                            <td>fixo</td>
                            <td>78,90</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <x-modal id="cadastrarServico" titulo="Novo serviço">
        <livewire:components.servico.form-create>
    </x-modal>
</div>
