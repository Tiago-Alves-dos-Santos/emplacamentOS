<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    <div class="row mb-3">
        <div class="col-md-11">
            <input type="search" class="form-control" placeholder="PESQUISAR">
        </div>
        <div class="col-md">
            <a href="{{route('view.cliente.create')}}" class="btn btn-info d-block">
                ADICIONAR
            </a>
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
                        <td>Nome</td>
                        <td class="d-flex">
                            <a href="" class="btn btn-outline-success">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <a href="" class="btn btn-outline-danger ml-2">
                                <i class="fa-solid fa-trash-can"></i>
                                <i class="fa-solid fa-spinner rotate"></i>
                            </a>
                        </td>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
