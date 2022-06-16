<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <input type="search" wire:model='search' class="select-search form-control">
    <select name="" id="" class="custom-select">
        <option value="" selected>Selecione</option>
        @foreach ($clientes as $value)
            <option value="{{$value->id}}">{{$value->nome}}</option>
        @endforeach
    </select>
</div>
