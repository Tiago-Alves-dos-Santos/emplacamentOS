<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <form wire:submit.prevent='enviar'>
        <div class="form-row">
            <div class="col-md-12" x-data="{selectedCliente: '',valores: @entangle('select')    }" x-init="select2Alpine" wire:ignore>
                <select x-ref="select" data-placeholder="Selecionar cliente" class="w-100" required>
                    <option value="">Selecione</option>
                    @foreach ($clientes as $value)
                        <option value="{{$value->id}}">{{$value->nome}}</option>
                    @endforeach
                  </select>
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-12">
                <button type="submit" class="btn btn-success">
                    SALVAR
                </button>
            </div>
        </div>



    </form>


    @push('scripts')
    <script>
        function select2Alpine() {
                this.select2 = $(this.$refs.select).select2({

                });
                this.select2.on("select2:select", (event) => {
                    //this.selectedCliente = Array.from(event.target.options).filter(option => option.selected).map(option => option.value)
                    this.selectedCliente = event.target.value;
                });
                this.select2.on('select2:unselect', (event) => {
                    //this.selectedCliente = Array.from(event.target.options).filter(option => option.selected).map(option => option.value);
                });
                this.$watch("selectedCliente", (value) => {
                    this.select2.val(value).trigger("change");
                    this.valores = this.selectedCliente.toString();
                });
            }
    </script>
    @endpush
</div>
