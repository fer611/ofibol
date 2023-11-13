<script>
    try {
        onScan.attachTo(document, {
            suffixKeyCodes: [13],
            onScan: function(barcode) {
                console.log(barcode)
                window.livewire.emit('scan-code', barcode)
            },

            onScanError: function(e) {
                console.log(e)
            }
        })

        console.log('Scanner readyss..!!')
    } catch (error) {
        console.log('error de lectura: ', error)
    }
</script>
