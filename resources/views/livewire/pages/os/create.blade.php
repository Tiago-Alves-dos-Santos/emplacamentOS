   <div>
   {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <h3>Criar uma os</h3>
    <div class="row">
        <div class="col-md-12">
            <livewire:components.os.search-cliente>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-6">
            <table class="table table-striped table-sm" id="table-all-services">
                <thead>
                    <th>Serviço</th>
                    <th>Tipo</th>
                    <th>Valor</th>
                    <th>Taxas</th>
                    <th style="width: 20%">Ações</th>
                </thead>
                <tbody>
                    @forelse ($servicos_existentes as $value)
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
                            <a class="btn btn-success ml-2 addServico"
                            data-input="{{$value->valor_type}}"
                            data-servico-id="{{$value->id}}"
                            >
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
        <div class="col-md-6">
            <table class="table table-striped table-sm" id="table-servico-add">
                <thead>
                    <th>Serviço</th>
                    <th>Tipo</th>
                    <th>Valor</th>
                    <th>Taxas</th>
                    <th style="width: 20%">Ações</th>
                </thead>
                <tbody>
                    @php
                        $limit = 1;
                        $cont = 1;
                        $page = 1;
                        $visible = true;
                    @endphp
                    @forelse ($servicos_lista as $value_array)
                    @php
                        $value_array = (object) $value_array;
                        $value = \App\Models\Servico::find($value_array->servico_id);
                        $total_taxas = 0;
                        foreach ($value->taxas as $value_taxa){
                            $total_taxas += $value_taxa->servico_taxas->valor_taxa;
                        }

                    @endphp
                    <tr class="page-{{$page}} @if($visible) visible @else d-none @endif" data-page="page-{{$page}}">
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

                        <td>
                            {{$value_array->valor}}
                        </td>
                        <td class="@if($total_taxas > 0) text-danger @endif">{{Configuracao::getDbMoney($total_taxas)}}</td>
                        <td class="d-flex">
                            <a class="btn btn-success ml-2">
                                ADICIONAR
                            </a>
                        </td>
                    </tr>
                    @php
                        if($cont == $limit){
                            $page++;
                            $cont =1;
                            $visible = false;
                        }else{
                            $cont++;
                        }
                    @endphp
                    @empty
                    <tr>
                        <td class="text-center" colspan="5">N/A</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <nav aria-label="...">
                <ul class="pagination">
                    @for ($i=1; $i <= ceil(count($servicos_lista) / $limit); $i++)
                        <li class="page-item @if($i == 1) active @endif"><a class="page-link" href="#" onclick="paginate(this,'table-servico-add')">{{$i}}</a></li>
                    @endfor

                </ul>
            </nav>
        </div>

    </div>


    @push('scripts')
        <script>


            $(".addServico").on('click', function (e){
                let servico_id = $(this).attr('data-servico-id');
                let is_input = $(this).attr('data-input');
                let valor_input = 0;
                if(is_input != 'fixo'){
                    valor_input = $(this).parents('tr').find('input').val();
                }else{
                    valor_input = $(this).parents('tr').find('td.valor-fixo').html()
                }
                if(is_input != 'fixo' && valor_input == "" || valor_input <= 0){
                    $(this).parents('tr').find('input').addClass('is-invalid');
                }else{
                    Livewire.emit('adicionar', servico_id, valor_input);
                }
            });

            function paginate(campo,table){
                // e.preventDefault();
                $(".page-item").removeClass('active')
                $(campo).parent().addClass('active');
                let page = $(campo).html();
                let page_atual = $("#"+table).find('tr.visible')
                $(page_atual).removeClass('visible');
                $(page_atual).addClass('d-none');
                $("tr.page-"+page).addClass('visible');
                $("tr.page-"+page).removeClass('d-none');
            }
        </script>
    @endpush
</div>
