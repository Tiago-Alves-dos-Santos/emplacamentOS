<div>
    {{-- Success is as dangerous as failure. --}}
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <th>Taxa</th>
                <th>Tipo</th>
                <th>Valor</th>
                <th style="width: 20%">Ações</th>
            </thead>
            <tbody>
                @forelse ($taxas as $value)
                <tr>
                    <td>{{$value->nome}}</td>
                    @if ($value->valor_type == 'fixo')
                    <td>
                        <span class="badge badge-primary badge-pill">FIXO</span>
                    </td>
                    <td>{{Configuracao::getDbMoney($value->valor)}}</td>
                    @else
                    <td>
                        <span class="badge badge-info badge-pill">VARIÁVEL</span>
                    </td>
                    <td>
                        <input type="text" class="mask-money form-control" placeholder="R$ 0,00">
                    </td>
                    @endif

                    <td class="d-flex">
                        <button class="btn btn-success">
                            ADICIONAR
                        </button>
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
