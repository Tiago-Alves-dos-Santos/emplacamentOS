<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <form method="POST" wire:submit.prevent='cadastrar'>
        <div class="form-row">
            <div class="col-md-3">
                <label for="">Despeza</label>
                <input type="text" class="form-control" required wire:model.defer='nome'>
            </div>
            <div class="col-md-3">
                <label for="">Valor</label>
                <input type="text" class="form-control" onkeyup="moneyMask(this)" placeholder="R$ 0,00" required wire:model.defer='valor'>
            </div>
            <div class="col-md-3">
                <label for="">Mes da dezpesa</label>
                <input type="month" class="form-control" required wire:model.defer='mes_referente'>
            </div>
            <div class="col-md-3">
                <label for="" class="d-flex">
                    <input type="text" class="select-search" placeholder="Fornecedor" wire:model='search_fornecedor'>
                </label>
                <select id="" class="custom-select" wire:model.defer='fornecedor_id'>
                    <option value="">Selecione</option>
                    @forelse ($fornecedores as $value)
                        <option value="{{$value->id}}">{{$value->nome}}</option>
                    @empty

                    @endforelse
                </select>
            </div>
        </div>
        <div class="form-row mt-3">
            <div class="col-md-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-success">
                    ADICIONAR
                </button>
            </div>
        </div>
    </form>
</div>
