<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    <div class="row">
        <div class="col-md-12">
            <form method="POST" wire:submit.prevent='cadastrar'>
                <div class="form-row">
                    <div class="col-md-4">
                        <label for="">Placa</label>
                        <input type="text" class="form-control" required wire:model.defer='placa'>
                    </div>
                    <div class="col-md-4">
                        <label for="">Marca</label>
                        <input type="text" class="form-control" required wire:model.defer='marca'>
                    </div>
                    <div class="col-md-4">
                        <label for="">Modelo</label>
                        <input type="text" class="form-control" required wire:model.defer='modelo'>
                    </div>
                </div>
                <div class="form-row mt-3">
                    <div class="col-md-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-success">
                            CADASTRAR
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
