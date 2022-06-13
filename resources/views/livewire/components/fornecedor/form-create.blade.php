<div>
    {{-- Success is as dangerous as failure. --}}
    <div class="row">
        <div class="col-md-12">
            <form method="POST" wire:submit.prevent='cadastrar'>
                <div class="form-row">
                    <div class="col-md-8">
                        <label for="">Nome</label>
                        <input type="text" class="form-control" wire:model.defer='nome' required>
                    </div>
                    <div class="col-md align-self-end">
                        <button type="submit" class="btn btn-success btn-block d-flex justify-content-center">
                            SALVAR
                            <div class="ml-2" wire:loading>
                                <i class="fa-solid fa-spinner rotate"></i>
                            </div>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
