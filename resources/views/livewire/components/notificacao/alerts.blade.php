<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-bell fa-fw"></i>
            <!-- Counter - Alerts -->
            @if ($counter > 0)
                <span class="badge badge-danger badge-counter">{{$counter}}</span>
            @endif
        </a>
        <!-- Dropdown - Alerts -->
        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
            aria-labelledby="alertsDropdown">
            <h6 class="dropdown-header">
                Ultimas notificações
            </h6>
            {{-- uma ideia, tranformar compoennte em livewire, para qnd marcar como lida já atualizar aq? --}}
            @forelse ($notificacoes as $value)
            <a class="dropdown-item d-flex align-items-center" href="#">
                <div class="mr-3">
                    <div class="icon-circle bg-primary">
                        <img src="{{asset('img/party_balloons_48px.png')}}" alt="" class="img-fluid">
                        {{-- <i class="fa-solid fa-exclamation text-white"></i> --}}
                    </div>
                </div>
                <div>
                    @php
                        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
                    @endphp
                    <div class="small text-gray-500">
                        {{date('d', strtotime($value->created_at))}} {{strftime(' de %B', strtotime($value->created_at))}}
                        de {{date('Y', strtotime($value->created_at))}}
                    </div>
                    <span class="font-weight-bold">{{Str::limit('Parabéns, seu cliente está', 20, '(...)')}}</span>
                </div>
            </a>
            @empty

            @endforelse

            {{-- <a class="dropdown-item d-flex align-items-center" href="#">
                <div class="mr-3">
                    <div class="icon-circle bg-success">
                        <i class="fas fa-donate text-white"></i>
                    </div>
                </div>
                <div>
                    <div class="small text-gray-500">December 7, 2019</div>
                    $290.29 has been deposited into your account!
                </div>
            </a>
            <a class="dropdown-item d-flex align-items-center" href="#">
                <div class="mr-3">
                    <div class="icon-circle bg-warning">
                        <i class="fas fa-exclamation-triangle text-white"></i>
                    </div>
                </div>
                <div>
                    <div class="small text-gray-500">December 2, 2019</div>
                    Spending Alert: We've noticed unusually high spending for your account.
                </div>
            </a> --}}
            <a class="dropdown-item text-center small text-gray-500" href="{{route('view.notificacao.lista')}}">Ver todas</a>
        </div>
    </li>
</div>
