<div>
    {{-- Be like water. --}}
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
                          <input type="radio" id="radio1" name="type" value="fixo" class="custom-control-input pointer type-service-update" required wire:model.defer='valor_type'>
                          <label class="custom-control-label pointer" for="radio1">FIXO</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" id="radio2" name="type" value="variavel" class="custom-control-input pointer type-service-update" required wire:model.defer='valor_type'>
                          <label class="custom-control-label pointer" for="radio2">VARIÁVEL</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="">Valor</label>
                        <input type="text" id="valor-update" class="mask-money form-control" placeholder="R$ 0,00" @if($valor_type != 'fixo') readonly @endif wire:model.defer='valor'>
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
            $(".type-service-update").on('change', function(){
                let element = $(this);
                let value = $(element).val();
                if(value == 'fixo'){
                    $("#valor-update").prop('required', true);
                    $("#valor-update").prop('readonly', false);
                    $("#valor-update").trigger('focus');
                }else if(value == "variavel"){
                    $("#valor-update").removeAttr('required');
                    $("#valor-update").prop('readonly', true);
                    $("#valor-update").val("");
                }
            });
        </script>
    @endpush
</div>
