<div>
    {{-- Do your work, then step back. --}}
        @forelse ($notificacoes as $value)
        <div class="shadow p-3 mb-3 bg-white rounded">
            <div class="row">
                <div class="col-md-4 d-flex justify-content-start">
                    <h2>
                        {{$value->id}}
                    </h2>
                </div>
                <div class="col-md-4 d-flex justify-content-center">
                    <h4>
                        <?= htmlspecialchars_decode($value->descricao)?>
                    </h4>
                </div>
                <div class="col-md-4 d-flex justify-content-end">
                    <button class="btn btn-success" wire:click='marcarLida({{$value->id}})'>
                        Marcar como lida
                    </button>
                </div>
            </div>
        </div>
        @empty

        @endforelse

</div>
