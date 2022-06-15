<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <div class="row">
        <div class="col-md-12">
            <h2>Serviço: <span style="font-size: 25px">{{$servico->nome}}</span></h2>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <h4>Taxas não adicionadas</h4>
            <livewire:components.servico.table-taxa-vincular :servico_id='$servico->id' wire:key="foo">
        </div>
        <div class="col-md-6">
            <h4>Taxas do serviço</h4>
            <livewire:components.servico.table-taxa-servico :servico_id='$servico->id'>
        </div>
    </div>
</div>
