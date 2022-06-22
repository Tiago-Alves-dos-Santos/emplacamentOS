<div>
    {{-- Be like water. --}}
    <div class="accordion" id="accordionExample">
        @forelse ($os as $value)
        <div class="card">
          <div class="card-header" id="headingThree">
            <h2 class="mb-0">
              <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#os-{{$value->id}}" aria-expanded="false" aria-controls="collapseThree">
                Nº {{$value->id}} | {{$value->cliente->nome}} | {{date('d/m/Y', strtotime($value->created_at))}}
              </button>
            </h2>
          </div>
          <div id="os-{{$value->id}}" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
            <div class="card-body">
                <h6>
                    Veículo: {{$value->veiculo->modelo}} - {{$value->veiculo->placa}}
                </h6>

              <div class="w-100 shadow-sm rounded d-flex justify-content-start">
                <a href="">
                    <img src="{{asset('img/pdf_48px.png')}}" style="width: 40px" alt="" class="img_fluid" title="Gerar PDF">
                </a>
                <a href="">
                    <img src="{{asset('img/show_property_48px.png')}}" style="width: 40px" alt="" class="img_fluid" title="Detalhes">
                </a>
              </div>

            </div>
          </div>
        </div>
        @empty

        @endforelse




      </div>
</div>
