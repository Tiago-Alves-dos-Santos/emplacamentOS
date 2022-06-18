<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <input type="search" wire:model='search' class="select-search form-control" placeholder="Nome cliente">
    <select name="" id="" class="custom-select" wire:model.defer='cliente_id' wire:change='setIdCliente'>
        <option value="" selected>Selecione</option>
        @foreach ($clientes as $value)
            <option value="{{$value->id}}">{{$value->nome}}</option>
        @endforeach
    </select>
</div>
