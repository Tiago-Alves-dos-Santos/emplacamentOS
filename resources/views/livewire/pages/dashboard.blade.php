<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    @php
        //dd($os_lucro_mensal);
    @endphp
    <div class="row mb-2">
        <div class="col-md-2">
            <input type="month" class="form-control" value="{{date('Y-m')}}" id="mes_dashboard">
        </div>
    </div>
    <div class="row">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Clientes</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$total_clientes}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-solid fa-user fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Total Despezas</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="total_despezas">R$ {{Configuracao::getDbMoney($total_despeza_mensal)}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                OS Realizadas</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="os_realizadas">{{$os_mes_atual}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-solid fa-file-invoice fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <div class="row">
        <div class="col-xl-12 col-lg-7" style="height: 100%">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Lucro das OS</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Opções</div>
                            <a class="dropdown-item" id="link_relatorio" href="{{route('os.lucro-mensal', [
                                'data' => date('Y')."-".date('m'),
                                'total_despezas' => $total_despeza_mensal
                            ])}}" target="_blank">Relátorio de lucro</a>
                            {{-- <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a> --}}
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body d-flex justify-content-center">
                    <div class="chart-container" >
                        <canvas id="myChart" height="800px"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            let data = {
                labels: [
                    'Total',
                    'Taxas e Despezas',
                    'Lucro',
                ],
                datasets: [{
                    label: 'My First Dataset',
                    data: ["{{$os_lucro_mensal->total}}", "{{($os_lucro_mensal->taxas + $total_despeza_mensal)}}", "{{($os_lucro_mensal->lucro - $total_despeza_mensal)}}"],
                    backgroundColor: [
                    'rgb(54, 162, 235)',
                    'rgb(255, 99, 132)',
                    'rgb(50, 229, 92)',
                    ],
                    hoverOffset: 4
                }]
            };

            let config = {
                    type: 'pie',
                    data: data,
            };
            let myChart = new Chart(
                document.getElementById('myChart'),
                config
            );
            myChart.canvas.parentNode.style.width = '500px';

           // myChart.canvas.parentNode.style.height = '200px';


            $("#mes_dashboard").on('change', function(){
                let element = $(this);
                $.ajax({
                    url: "{{route('home.ajax.data-dashboard')}}",
                    dataType: 'html',
                    type: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'data': $(element).val()

                    },
                    complete: function() {
                      //$("#conteudo").empty().html();
                    },
                    success: function(data, textStatus) {
                        let objeto = JSON.parse(data);
                        $("#total_despezas").html(moneyMaskValue(objeto.total_despeza_mensal, true));
                        $("#link_relatorio").attr('href', objeto.link.relatorio);
                        $("#os_realizadas").html(objeto.os_mes_atual)
                        //carrega grafico
                        let datas = {
                            labels: [
                                'Total',
                                'Taxas e Despezas',
                                'Lucro',
                            ],
                            datasets: [{
                                label: 'My First Dataset',
                                data: [objeto.os_lucro_mensal.total, (objeto.os_lucro_mensal.taxas + objeto.total_despeza_mensal), (objeto.os_lucro_mensal.lucro + objeto.total_despeza_mensal)],
                                backgroundColor: [
                                'rgb(54, 162, 235)',
                                'rgb(255, 99, 132)',
                                'rgb(50, 229, 92)',
                                ],
                                hoverOffset: 4
                            }]
                        };
                        myChart.destroy();
                        config = {
                            type: 'pie',
                            data: datas,
                        };
                        myChart = new Chart(
                            document.getElementById('myChart'),
                            config
                        );
                        myChart.canvas.parentNode.style.width = '500px';
                        //$("#conteudo").empty().html(data);
                    },
                    error: function(xhr,er) {
                        console.log('<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + '<br />Tipo de erro: ' + er + '</p>')
                    }
                });
            });
        </script>
    @endpush
</div>
