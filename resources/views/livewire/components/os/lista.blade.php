<div>
    {{-- Be like water. --}}
    <div class="accordion" id="accordionExample">
        @forelse ($os as $value)
        <div class="card">
          <div class="card-header" id="headingThree">
            <h2 class="mb-0">
              <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#os-{{$value->id}}" aria-expanded="false" aria-controls="collapseThree">
                Nº {{$value->id}} | {{$value->nome}} | {{date('d/m/Y', strtotime($value->created_at))}}
              </button>
            </h2>
          </div>
          <div id="os-{{$value->id}}" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <h6>
                            Veículo: {{$value->modelo}} - {{$value->placa}}
                        </h6>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <h6 class="text-white bg-secondary rounded" style="padding:5px 5px">Serviços</h6>
                    </div>
                </div>
                @php
                    $servicos = $value->servicos()->get();
                    $total_os = 0;
                    $total_taxas_os = 0;
                @endphp
                @forelse ($servicos as $servico)
                @php
                    $servico_total_valor =0;
                    $servico_taxas = 0;
                @endphp
                <div class="row">
                    <div class="col-md-12">
                        <div class="w-100" style="border-bottom: 2px solid black; padding: 5px 10px">
                            <h6>{{$servico->nome}} - R$ {{Configuracao::getDbMoney($servico->pivot->valor_servico)}}</h6>

                            @php
                               $total_os += $servico->pivot->valor_servico;
                               $taxas = \App\Models\TaxaVariavelOS::JOIN('taxas','taxas.id','=','taxa_variavel_os.taxa_id')
                               ->select('taxa_variavel_os.valor','taxas.nome','taxas.valor as valor_fixo','taxas.valor_type')
                               ->where('os_id', $value->id)
                                ->where('servico_id', $servico->id)->get()
                            @endphp
                            @forelse ($taxas as $taxa)
                                <div class="w-100 rounded mt-2" style="border: 0.3px solid rgb(162, 161, 161); padding: 5px 10px">
                                    <h6>{{$taxa->nome}}</h6>
                                    @php
                                        $servico_taxas += $taxa->valor;
                                    @endphp
                                        <h6>Valor R$ {{Configuracao::getDbMoney($taxa->valor)}}</h6>
                                </div>
                            @empty

                            @endforelse
                            {{-- valor unico de cada serviço --}}
                            @php
                                $total_taxas_os += $servico_taxas;
                            @endphp
                            <div class="d-flex mt-2">
                                <h6 class="text-success mr-2">Lucro: R$ {{Configuracao::getDbMoney($servico->pivot->valor_servico - $servico_taxas)}}</h6>
                                <h6 class="text-danger">Taxas: R$ {{Configuracao::getDbMoney($servico_taxas)}}</h6>
                            </div>
                        </div>
                    </div>
                </div>
                @empty

                @endforelse

                <div class="row mt-3">
                    <div class="col-md-12 d-flex">
                        <h5 class="mr-2">Total: R$ {{Configuracao::getDbMoney($total_os)}}</h5>
                        <h5 class="text-danger mr-2">Taxas: {{Configuracao::getDbMoney($total_taxas_os)}}</h5>
                        <h5 class="text-success">Lucro: R$ {{Configuracao::getDbMoney($total_os - $total_taxas_os)}}</h5>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12" data-valor="{{$value->descricao}}">
                        <textarea name="{{$loop->index}}" class="editor" id="description-{{$value->id}}"></textarea>
                    </div>
                </div>

                <div class="w-100 shadow-sm rounded d-flex justify-content-start mt-3">
                  <a href="">
                      <img src="{{asset('img/pdf_48px.png')}}" style="width: 40px" alt="" class="img_fluid" title="Gerar PDF">
                  </a>
                </div>

            </div>
          </div>
        </div>
        @empty

        @endforelse

      </div>

      @push('scripts')
      <script>
        $(function(){

            $( 'textarea.editor').each( function() {
                let valor =  $(this).parent().attr('data-valor');
                CKEDITOR.replace( $(this).attr('id') );
                CKEDITOR.instances[$(this).attr('id')].setData(valor);
                CKEDITOR.instances[$(this).attr('id')].config.readOnly = true;

            });

        });
     </script>
      @endpush
</div>
