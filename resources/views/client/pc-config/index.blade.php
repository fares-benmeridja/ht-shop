@extends('layouts.master')

@section('title', 'ht_shop - Contact us!')

@section('stylesheet')
    @livewireStyles
@endsection

@section('content')
    <div class="container">
        <livewire:pc-config/>
    </div>
@endsection

@section('script')
    @livewireScripts
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>

    <script>
        window.addEventListener('closeModal', event => {
            $('.modal').modal('hide')
        })

        function filterTable() {

            // Declare variables
            let input, filter, table, tr, td, i, txtValue, modal;
            modal = this.parent.parent;
            input = modal.document.querySelector(".filter-input");
            filter = input.value.toUpperCase();
            table = modal.document.querySelector(".filter-table");
            tr = table.querySelectorAll(".filter-tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
@endsection