@push('estilos')

@endpush

{!! $dataTable->table(['width' => '100%', 'class' => 'table table-striped ']) !!}

@push('scripts')

    {!! $dataTable->scripts() !!}

    <style>
        thead tr:first-child th:first-child {
            border-top-left-radius: 0.3rem;
        }
        thead tr:first-child th:last-child {
            border-top-right-radius: 0.3rem;
        }
    </style>

    <script>
        $(function () {
            var dt = window.LaravelDataTables["dataTableBuilder"];

            //Cuando dibuja la tabla
            dt.on( 'draw.dt', function () {
                $(this).addClass('table-sm table-striped table-bordered table-hover');

                // Agrega estilo al encabezado
                $(this).find('thead').css({
                    'background-image': 'linear-gradient(to top, #a7c7d8, #b3cde0)',
                    'color': '#1c1c1c'
                });



                $(this).find('tbody td').css('padding', '12px 8px'); // vertical, horizontal

                $('[data-toggle="tooltip"]').tooltip();
            });

        })
    </script>
@endpush
