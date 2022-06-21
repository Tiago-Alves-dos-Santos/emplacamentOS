<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <livewire:components.cliente.form-update :id='$client_id'>
    <div class="mb-3"></div>
    <livewire:components.veiculo.table :cliente_id='$client_id'>

    <x-modal id="cadastrarVeiculo" titulo='Novo veículo' size='modal-lg'>
        <livewire:components.veiculo.form-create :cliente_id='$client_id'>
    </x-modal>
</div>
