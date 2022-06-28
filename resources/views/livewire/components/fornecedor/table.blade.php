<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    <div class="row mb-3">
        <div class="col-md-11">
            <input type="search" class="form-control" placeholder="PESQUISAR NOME" wire:model='search'>
        </div>
        <div class="col-md">
            <button type="button" href="" class="btn btn-info d-block" data-toggle="modal" data-target="#cadastrarFornecedor">
                ADICIONAR
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="table-resposive">
                <table class="table table-striped table-sm">
                    <thead>
                        <th style="width: 80%">Nome</th>
                        <th style="width: 20%">Ações</th>
                    </thead>
                    <tbody>
                        @forelse ($fornecedores as $value)
                            <tr>
                                <td>{{$value->nome}}</td>
                                <td class="d-flex">
                                    <a class="btn btn-outline-success" wire:click='setID({{$value->id}})'>
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a class="btn btn-outline-danger ml-2" wire:click='excluir({{$value->id}})' wire:loading.attr="disabled">
                                        <div wire:loading.remove wire:target="excluir({{$value->id}})">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </div>
                                        <div wire:loading wire:target="excluir({{$value->id}})">
                                            <i class="fa-solid fa-spinner rotate"></i>
                                        </div>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="text-center">N/A</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="col-md-12">
                    {{$fornecedores->links()}}
                </div>
            </div>
        </div>
    </div>

    <x-modal id="cadastrarFornecedor" titulo='Novo fornecedor'>
        <livewire:components.fornecedor.form-create>
    </x-modal>

    <x-modal id="editarFornecedor" titulo='Atualizar fornecedor'>
        <livewire:components.fornecedor.form-update>
    </x-modal>
</div>
