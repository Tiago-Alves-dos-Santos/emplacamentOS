<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <form action="">
        <div class="form-row">
            <div class="col-md-12" wire:ignore>
                <select name="" id="" class="select2 w-100">
                    <option value="">Teste</option>
                </select>
            </div>
        </div>

    </form>
    <button wire:click='reload'> teste</button>
@push('scripts')
    <script>
        $(function(){
            $(document).ready(function() {
                $('.select2').select2();
            });
        });
    </script>
@endpush
</div>
