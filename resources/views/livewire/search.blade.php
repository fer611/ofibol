<div>
    <ul class="navbar-item flex-row">
        <li class="nav-item align-self-center">
            <form class="form-inline search-full form-inline search">
                <div class="input-group w-100">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search toggle-search">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                        </span>
                    </div>
                    <input id="code" type="text" wire:keydown.enter.prevent="$emit('scan-code', $('#code').val())" class="form-control search-form-control" placeholder="Ingresa el código de barras del producto">
                </div>
            </form>
        </li>
    </ul>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            livewire.on('scan-code', action =>{
                $('#code').val('');
            })
        })
    </script>
</div>
