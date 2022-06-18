   <div>
   {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <h3>Criar uma os</h3>
    <div class="row">
        <div class="col-md-12">
            <livewire:components.os.search-cliente>
        </div>
    </div>


    <div class="row mt-5">
        <div class="col-md-12 d-flex justify-content-end">
            <button type="button" class="btn btn-success btn-lg" wire:click='salvar'>
                SALVAR OS
            </button>
        </div>
    </div>



    @push('scripts')
        <script>

        </script>
    @endpush
</div>
