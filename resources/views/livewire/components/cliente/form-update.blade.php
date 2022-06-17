<div>
    {{-- Success is as dangerous as failure. --}}
    <div class="row">
        <div class="col-md-12">
            <form method="POST" wire:submit.prevent='updateCliente'>
                <div class="form-row">
                    <div class="col-md-4">
                        <label for="">Nome</label>
                        <input type="text" name="" id="" class="form-control @error('nome') is-invalid @enderror" wire:model.defer='nome' required minlength="5">
                        @error('nome')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="">Celular</label>
                        <input type="text" name="" id="" class="form-control mask-celular @error('telefone') is-invalid @enderror" wire:model.defer='telefone' required minlength="15" maxlength="15">
                        @error('telefone')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="">Nascimento</label>
                        <input type="date" name="" id="" class="form-control @error('data_nasc') is-invalid @enderror" wire:model.defer='data_nasc' required>
                        @error('data_nasc')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-3">
                        <label for="">Rua</label>
                        <input type="text" name="" id="" class="form-control @error('rua') is-invalid @enderror" wire:model.defer='rua'>
                        @error('rua')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="">Bairro</label>
                        <input type="text" name="" id="" class="form-control @error('bairro') is-invalid @enderror" wire:model.defer='bairro'>
                        @error('bairro')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="">Numero</label>
                        <input type="number" name="" id="" class="form-control @error('numero') is-invalid @enderror" wire:model.defer='numero'>
                        @error('numero')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="">Complemento</label>
                        <input type="text" name="" id="" class="form-control @error('complemento') is-invalid @enderror" wire:model.defer='complemento'>
                        @error('complemento')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="form-row mt-3">
                    <div class="col-md-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary d-flex">
                            SALVAR
                            <div class="loader ml-2" wire:loading></div>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
