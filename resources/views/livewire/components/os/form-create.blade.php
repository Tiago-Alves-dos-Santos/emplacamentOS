<div class="cadastro-os">
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <form method="POST" wire:submit.prevent='saveOS'>
        <div class="form-row">
            <div class="col-md-6">
                <input type="search" wire:model='search_cliente' class="select-search form-control" placeholder="Nome cliente">
            </div>
            <div class="col-md-6 d-flex">
                <select name="" id="" class="custom-select" wire:model.lazy='cliente_id' class="w-90" required>
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
            <div class="col-md-6">
                <select name="" id="" class="custom-select" wire:model.defer='veiculo_id' required>
                    <option value="" selected>Selecione</option>
                    @foreach ($veiculos_cliente as $value)
                        <option value="{{$value->id}}">{{$value->modelo}} - {{$value->placa}}</option>
                    @endforeach
                </select>
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
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-12 ">
                <div class="lista-servicos w-100">
                    <h3 class="text-center">Adicionados</h3>
                    @forelse ($servicos_lista as $value_array)
                    @php
                        $value_array = (object) $value_array;
                        $value = \App\Models\Servico::find($value_array->servico_id);
                        $total_taxas = 0;
                        $is_taxa_variavel = false;
                        foreach ($value->taxas as $value_taxa){
                            $total_taxas += $value_taxa->servico_taxas->valor_taxa;
                            $is_taxa_variavel = ($value_taxa->valor_type != 'fixo')?true:false;
                        }
                        $is_taxa_variavel_add = false;
                        if($is_taxa_variavel){
                            $taxas_variaveis = \App\Models\Servico::find($value->id)->taxas()->where('valor_type','variavel')->get();
                            $valor_total_variavel = 0;
                            foreach($taxa_servico_lista as $lista){
                                if($lista['servico_id'] == $value->id){
                                    foreach($lista['taxas'] as $taxa){
                                        $valor = (double)Configuracao::convertToMoney($taxa['valor']);
                                        if($valor > 0){
                                            $is_taxa_variavel_add = true;
                                        }
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
                                Valor: {{Configuracao::getDbMoney($value_array->valor)}}
                            </li>
                            <li>
                                Taxas: {{Configuracao::getDbMoney($total_taxas)}}
                            </li>
                            <li>
                                @php
                                   $valor =  Configuracao::getDbMoney($value_array->valor - $total_taxas);
                                   $class = ($valor < 0)?'text-danger':'text-success';
                                @endphp
                                Lucros: <span class="{{$class}}">{{$valor}}</span>
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
                                <div class="col-md-12">
                                    <label for="">{{$value->nome}} </label>
                                    <input type="hidden"  class="id_taxas" value="{{$value->id}}">
                                    <input type="text"  class="form-control values_taxas" onkeyup="moneyMask(this)" placeholder="R$ 0,00">
                                </div>
                            </div>
                            @empty
                            @endforelse
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <button type="button" class="btn btn-info" onclick="addTaxaLista(this, 'addTaxasVariaveis-{{$value_array->servico_id}}')">
                                        SALVAR
                                    </button>
                                </div>
                            </div>
                        </x-modal>
                        @endif

                        <div class="remove-service" wire:click='removerLista({{$value_array->servico_id}})'>
                            <i class="fa-solid fa-xmark"></i>
                        </div>
                    </div>
                    @empty

                    @endforelse
                </div>

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

    <x-modal id="cadastroCliente" titulo='Novo cliente' size='modal-lg'>
        @php
            $setar_id = [
                'setar_id' => true,
                'metodo_set_id' => 'os.form-create-setClienteID'
            ];
        @endphp
        <livewire:components.cliente.form-create :setar_id='$setar_id'>
    </x-modal>

    @push('scripts')
        <script>
            function addTaxaLista(campo, form_id){
                let form = $(campo).parents('#'+form_id);
                console.log(form);
                let servico_id = $(form).find('input.servico_id').val();
                let inputs_ids = $(form).find('input.id_taxas');
                let inputs = $(form).find('input.values_taxas');
                let array_ids = [];
                let array_values = [];
                $(inputs_ids).each(function( index ) {
                    // console.log( index + ": " + $( this ).val() );
                    array_ids.push($(this).val());
                });
                $(inputs).each(function( index ) {
                    //console.log( index + ": " + $( this ).val() );
                    array_values.push($(this).val())
                });
                Livewire.emit('os.form-create-addTaxasLista', servico_id, array_ids, array_values)

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
        </script>
    @endpush
</div>
