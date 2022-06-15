<div>
    {{-- Success is as dangerous as failure. --}}
    <div class="row">
        <div class="col-md-12">
            <form method="POST" wire:submit.prevent='cadastrar'>
                <div class="form-row">
                    <div class="col-md-12">
                        <label for="">Serviço</label>
                        <input type="text" class="form-control" required wire:model.defer='nome'>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6 align-self-center">
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" id="customRadioInline1" name="type" value="fixo" class="custom-control-input pointer type-service" required wire:model.defer='valor_type'>
                          <label class="custom-control-label pointer" for="customRadioInline1">FIXO</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" id="customRadioInline2" name="type" value="variavel" class="custom-control-input pointer type-service" required wire:model.defer='valor_type'>
                          <label class="custom-control-label pointer" for="customRadioInline2">VARIÁVEL</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="">Valor</label>
                        <input type="text" id="valor" class="mask-money form-control" placeholder="R$ 0,00" readonly wire:model.defer='valor'>
                    </div>
                </div>
                <div class="form-row mt-3">
                    <div class="col-md-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-success">
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

    @push('scripts')
        <script>
            $(".type-service").on('change', function(){
                let element = $(this);
                let value = $(element).val();
                if(value == 'fixo'){
                    $("#valor").prop('required', true);
                    $("#valor").prop('readonly', false);
                    $("#valor").val("");
                    $("#valor").trigger('focus');
                }else if(value == "variavel"){
                    $("#valor").removeAttr('required');
                    $("#valor").prop('readonly', true);
                    $("#valor").val(0);
                }
            });
        </script>
    @endpush
</div>
