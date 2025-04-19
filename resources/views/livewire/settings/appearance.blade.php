

<section class="w-full">
    <flux:radio.group x-data variant="segmented" x-model="$flux.appearance" label="Selecciona tu tema preferido" id="theme" size="sm">
        {{-- <flux:radio value="cc" label="Credit Card" checked />
        <flux:radio value="paypal" label="Paypal" /> --}}

        <flux:radio value="light" icon="sun" checked label="Modo Light" />
        <flux:radio value="dark" icon="moon" label="Modo Dark" />
    </flux:radio.group>    
    
   
</section>


{{-- <script>
    optionRadio = document.getElementById("theme")
    optionRadio.addEventListener('click', event => {
        console.log(event);
        if(event.currentTarget.value = 'light') {
            if(JSON.parse(localStorage.getItem('darkMode'))) {
                document.documentElement.classList.remove("dark")  
                localStorage.setItem('darkMode', JSON.stringify(!JSON.parse(localStorage.getItem('darkMode'))));  
            }
        }else{
            if(JSON.parse(localStorage.getItem('darkMode'))) {
                document.documentElement.classList.remove("dark")  
                localStorage.setItem('darkMode', JSON.stringify(!JSON.parse(localStorage.getItem('darkMode'))));  
            }
        }
       
       
    });
    
</script> --}}


