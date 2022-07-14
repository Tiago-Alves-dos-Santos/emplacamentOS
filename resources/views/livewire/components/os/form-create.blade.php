<div class="cadastro-os">
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    @php
        $total_os = 0;
        $total_all_taxas = 0;
    @endphp
    <form method="POST" wire:submit.prevent='saveOS'>
        <div class="form-row">
            <div class="col-md-6">
                <input type="search" wire:model='search_cliente' class="select-search form-control" placeholder="Nome cliente">
            </div>
            <div class="col-md-6 d-flex">
                <select name="" class="custom-select" wire:model.lazy='cliente_id' wire:change='veiculoClienteId' class="w-90" required id="cliente_id">
                    <option value="" selected>Selecione</option>
                    @foreach ($clientes as $value)
                        <option value="{{$value->id}}">{{$value->nome}}</option>
                    @endforeach
                </select>
                <a href="" class="btn btn-info ml-2" data-toggle="modal" data-target="#cadastroCliente">
                    <i class="fa-solid fa-plus"></i>
                </a>
            </div>
        </div>

        <div class="form-row mt-3">
            <div class="col-md-6">
                <input type="search" class="select-search form-control" placeholder="Placa" wire:model='search_veiculo'>
            </div>
            <div class="col-md-6 d-flex">
                <select name=""  class="custom-select" wire:model.lazy='veiculo_id' id="veiculo_id">
                    <option value="" selected>Selecione</option>
                    @foreach ($veiculos_cliente as $value)
                        <option value="{{$value->id}}">{{$value->modelo}} - {{$value->placa}}</option>
                    @endforeach
                </select>
                {{-- verifcar se tem cliente selecionado --}}
                <button type="button" class="btn btn-info ml-2" @if(empty($cliente_id)) disabled @endif data-toggle="modal" data-target="#cadastrarVeiculo">
                    <i class="fa-solid fa-plus"></i>
                </button>

                <button type="button" class="btn btn-primary ml-2" wire:click="$emit('os.form-create.reload')">
                    <i class="fa-solid fa-arrows-rotate" wire:loading.class="rotate"></i>
                </button>
            </div>
        </div>

        <div class="form-row mt-3">
            <div class="col-md-12">
                <input type="search" wire:model='search' class="select-search form-control" placeholder="Serviço">
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                            <th>COD</th>
                            <th>Serviço</th>
                            <th>Tipo</th>
                            <th>Valor</th>
                            <th>Taxas</th>
                            <th style="width: 20%">Ações</th>
                        </thead>
                        <tbody>
                            @forelse ($servicos as $value)
                            @php
                                $total_taxas = 0;
                                foreach ($value->taxas as $value_taxa){
                                    $total_taxas += $value_taxa->servico_taxas->valor_taxa;
                                }

                            @endphp
                            <tr>
                                <td>{{$value->id}}</td>
                                <td>{{$value->nome}}</td>
                                @if ($value->valor_type == 'fixo')
                                <td>
                                    <span class="badge badge-primary badge-pill">FIXO</span>
                                </td>
                                @else
                                <td>
                                    <span class="badge badge-info badge-pill">VARIÁVEL</span>
                                </td>
                                @endif
                                @if ($value->valor_type == 'fixo')
                                <td class="valor-fixo">
                                    {{Configuracao::getDbMoney($value->valor)}}
                                </td>
                                @else
                                <td>
                                    <input type="text" class="form-control" placeholder="R$ 0,00" onkeyup="moneyMask(this)">
                                </td>
                                @endif
                                <td class="@if($total_taxas > 0) text-danger @endif">{{Configuracao::getDbMoney($total_taxas)}}</td>
                                <td class="d-flex">
                                    <a class="btn btn-outline-success" data-input="{{$value->valor_type}}" data-servico-id="{{$value->id}}" onclick="addServico(this)">
                                        ADICIONAR
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td class="text-center" colspan="5">N/A</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    @if (!empty($servicos))
                        {{$servicos->links()}}
                    @endif
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-12 ">
                <div class="lista-servicos w-100">
                    <h3 class="text-center">Adicionados</h3>
                    @forelse ($servicos_lista as $lista_servico)
                    @php
                        $lista_servico = (object) $lista_servico;
                        $value = \App\Models\Servico::find($lista_servico->servico_id);
                        $total_taxas = 0;
                        $is_taxa_variavel = false;
                        //taxas do serviço
                        foreach ($value->taxas as $value_taxa){
                            //taxas com valor fixo, as variaveis tem valor 0
                            $total_taxas += $value_taxa->servico_taxas->valor_taxa;
                            if(!$is_taxa_variavel){//qnd achar pelo menos uma taxa varivel não precisa mais verifica, se achar não verfica mais
                                $is_taxa_variavel = ($value_taxa->valor_type != 'fixo')?true:false;
                            }
                        }
                        $is_taxa_variavel_add = false;
                        //total valores adicionais da taxas
                        $total_adicional_taxas = 0;
                        //lucro obtido a partir do adicional da taxa
                        $lucro_adicional_taxa = 0;
                        //o serviço tem taxa variavel
                        if($is_taxa_variavel){
                            $taxas_variaveis = \App\Models\Servico::find($value->id)->taxas()->where('valor_type','variavel')->get();
                            $valor_total_variavel = 0;
                            //lista de taxas variaveis do serviço, lista sem ser do banco
                            foreach($taxa_servico_lista as $lista){
                                if($lista['servico_id'] == $value->id){
                                    foreach($lista['taxas'] as $taxa){
                                        $valor = (double)Configuracao::convertToMoney($taxa['valor']);
                                        $valor_adicional = ((double)Configuracao::convertToMoney($taxa['valor_adicional']));
                                        if($valor > 0){
                                            $is_taxa_variavel_add = true;
                                        }
                                        $total_adicional_taxas += $valor_adicional;
                                        //total de taxas fixa + taxas variaveis
                                        $total_taxas += $valor;
                                    }
                                }
                            }
                        }
                    @endphp
                    <div class="details-servicos shadow">
                        <h4>{{$value->nome}}</h4>
                        <ul>
                            <li>
                                Valor: {{Configuracao::getDbMoney($lista_servico->valor + $total_adicional_taxas)}}
                            </li>
                            <li>
                                Taxas: {{Configuracao::getDbMoney($total_taxas)}}
                            </li>
                            <li>
                                @php
                                   $lucro =  Configuracao::getDbMoney(($lista_servico->valor + ($total_adicional_taxas - $total_taxas)));
                                   $class = ($lucro < 0)?'text-danger':'text-success';
                                   $total_os += ($lista_servico->valor + $total_adicional_taxas);
                                   $total_all_taxas += $total_taxas;
                                @endphp
                                Lucros: <span class="{{$class}}">{{$lucro}}</span>
                            </li>
                        </ul>

                        @if ($is_taxa_variavel)
                        <button type="button" class="btn @if($is_taxa_variavel_add) btn-success @else btn-warning @endif" data-toggle="modal" data-target="#addTaxasVariaveis-{{$value->id}}">
                            Taxas variáveis
                        </button>

                        <x-modal id="addTaxasVariaveis-{{$value->id}}" titulo='Adicionar Taxa: {{$value->nome}}'>
                            <input type="hidden" value="{{$value->id}}" class="servico_id" >
                            @forelse ($taxas_variaveis as $value)
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">{{$value->nome}} </label>
                                    <input type="hidden"  class="id_taxas" value="{{$value->id}}">
                                    <input type="text"  class="form-control values_taxas" onkeyup="moneyMask(this)" placeholder="R$ 0,00">
                                </div>
                                <div class="col-md-6">
                                    <label for="">Adicional</label>
                                    <input type="text" class="form-control taxas_adicional" onkeyup="moneyMask(this)" placeholder="R$ 0,00">
                                </div>
                            </div>
                            @empty
                            @endforelse
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <button type="button" class="btn btn-info" onclick="addTaxaLista(this, 'addTaxasVariaveis-{{$lista_servico->servico_id}}')">
                                        SALVAR
                                    </button>
                                </div>
                            </div>
                        </x-modal>
                        @endif

                        <div class="remove-service" wire:click='removerLista({{$lista_servico->servico_id}})'>
                            <i class="fa-solid fa-xmark"></i>
                        </div>
                    </div>
                    @empty

                    @endforelse
                </div>

            </div>
        </div>

        <div class="form-row mt-3" wire:ignore>
            <div class="col-md-12">
                <textarea name="" id="description" rows="10" class="w-100"></textarea>
            </div>
        </div>

        <div class="form-row mt-5">
            <div class="col-md-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-success btn-lg">
                    SALVAR OS
                </button>
            </div>
        </div>
    </form>

    <div class="row mt-3">
        <div class="col-md-12 d-flex justify-content-end">
            <form action="{{route('os.orcamento')}}" method="POST">
                @csrf
                <input type="hidden" name="lista_servicos" value="{{json_encode($servicos_add)}}">
                <input type="hidden" name="lista_taxas" value="{{json_encode($taxa_servico_lista)}}">
                <input type="hidden" name="cliente_id" value="{{$cliente_id}}">
                <input type="hidden" name="veiculo_id" value="{{$veiculo_id}}">
                <input type="hidden" name="desconto" value="{{Configuracao::convertToMoney($desconto)}}">
                <button type="submit" class="btn btn-danger btn-lg mr-2" title="ORÇAMENTO" formtarget="_blank">
                    <i class="fa-solid fa-file-pdf"></i>
                </button>
            </form>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-12" style="background-color: rgb(15, 15, 15); color: white; padding:10px">
            <div class="w-100 d-flex flex-column" >
                @php
                    $pagar = $total_os - (double)Configuracao::convertToMoney($desconto);
                @endphp
                <h5 class="text-info">Total: R$ {{Configuracao::getDbMoney($total_os)}}</h5>
                <h5 class="text-warning">Desconto: R$ {{$desconto ?? Configuracao::getDbMoney(0)}}</h5>
                <h5>Pagar: R$ {{Configuracao::getDbMoney($pagar)}}</h5>
                <h5 class="text-danger">Taxas: R$ {{Configuracao::getDbMoney($total_all_taxas)}}</h5>
                <h5 class="text-success">Lucro: R$ {{Configuracao::getDbMoney($total_os - $total_all_taxas)}}</h5>
                @if ($valor_pago > 0)
                <h5>Troco: R$ {{Configuracao::getDbMoney($troco)}}</h5>
                @endif
            </div>
            <div class="w-100">
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" class="form-control" placeholder="Desconto R$ 0,00" onkeyup="moneyMask(this)" wire:model.lazy='desconto' wire:change='cacularTrocoOs({{$total_os}})'>
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" placeholder="Valor pago R$ 0,00" onkeyup="moneyMask(this)" wire:model.lazy='valor_pago' wire:change='cacularTrocoOs({{$total_os}})'>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <div class="row mt-3">

    </div>

    <x-modal id="cadastroCliente" titulo='Novo cliente' size='modal-lg'>
        @php
            $setar_id = [
                'setar_id' => true,
                'metodo_set_id' => 'os.form-create-setClienteID'
            ];
        @endphp
        <livewire:components.cliente.form-create :setar_id='$setar_id'>
    </x-modal>

    <x-modal id="cadastrarVeiculo" titulo='Novo veículo {{$cliente_id}}' size='modal-lg'>
        <livewire:components.veiculo.form-create>
    </x-modal>

    @push('scripts')
        <script>
            let editor = CKEDITOR.replace( 'description' );
            CKEDITOR.instances['description'].setData("")

            editor.on( 'change', function( evt ) {
                // getData() returns CKEditor's HTML content.
                //console.log( 'Total bytes: ' + evt.editor.getData());

                Livewire.emit('os.form-create-setDescricao', evt.editor.getData());
            });
            $("#teste").on('click', function(){
                console.log(CKEDITOR.instances['description'].getData());
                // alert(editor.getData());
            })
            function addTaxaLista(campo, form_id){
                let form = $(campo).parents('#'+form_id);
                console.log(form);
                let servico_id = $(form).find('input.servico_id').val();
                let inputs_ids = $(form).find('input.id_taxas');
                let inputs = $(form).find('input.values_taxas');
                let inputs_adicionais = $(form).find('input.taxas_adicional');
                let array_ids = [];
                let array_values = [];
                let array_values_adicionais = [];
                $(inputs_ids).each(function( index ) {
                    // console.log( index + ": " + $( this ).val() );
                    array_ids.push($(this).val());
                });
                $(inputs).each(function( index ) {
                    array_values.push($(this).val())
                });
                $(inputs_adicionais).each(function( index ) {
                    array_values_adicionais.push($(this).val())
                });
                Livewire.emit('os.form-create-addTaxasLista', servico_id, array_ids, array_values,array_values_adicionais)

                array_ids = [];
                array_values = [];

                console.log(array_ids)

            }

            function addServico(campo){
                let servico_id = $(campo).attr('data-servico-id');
                let is_input = $(campo).attr('data-input');
                let valor_input = 0;
                if(is_input != 'fixo'){
                    valor_input = $(campo).parents('tr').find('input').val();
                }else{
                    valor_input = $(campo).parents('tr').find('td.valor-fixo').html()
                }
                if(is_input != 'fixo' && valor_input == "" || valor_input <= 0){
                    $(campo).parents('tr').find('input').addClass('is-invalid');
                }else{
                    Livewire.emit('os.form-create-addLista', servico_id, valor_input);
                    $("tr").find('input').val("");
                }
            }

            function downloadFile(response) {
                var blob = new Blob([response]);

                var link = document.createElement('a');

                link.href = window.URL.createObjectURL(blob);

                link.download = "Sample.pdf";

                link.click();
            }

        </script>
    @endpush
</div>
