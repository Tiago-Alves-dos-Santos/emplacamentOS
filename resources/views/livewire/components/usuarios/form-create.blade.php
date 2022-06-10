<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <div class="row">
        <div class="col-md-12">
            <form method="POST" wire:submit.prevent='createUser'>
                <div class="form-row">
                    <div class="col-md-6">
                        <label for="">Nome</label>
                        <input type="text" class="form-control @error('nome') is-invalid @enderror" wire:model.defer='nome'>
                        @error('nome')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="">Email</label>
                        <input type="text" class="form-control @error('email') is-invalid @enderror" wire:model.defer='email'>
                        @error('email')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-12">
                        <label for="">Senha</label>
                        <input type="password" class="form-control @error('senha') is-invalid @enderror" wire:model.defer='senha'>
                        @error('senha')
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
