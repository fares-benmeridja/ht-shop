
class Counter {

    /**
     * @param {Element} element
     */
    constructor(element) {
        this.$element = element
        this.$trParent = this.$element.closest('.js-cart-tr')
        this.$qtyInput = this.$trParent.querySelector('.js-cart-qty')
        this.$countElement = document.querySelector('.js-cart-count')
        this.$cartTotal = document.querySelector('.js-cart-total')
        this.$productSubTotal = this.$trParent.querySelector('.js-cart-product-subTotal')
        this.$flash = document.querySelector('.js-flash')
        this.$action = this.$element.parentNode.getAttribute('data-action')
        this.$counter = this.$element.getAttribute('data-counter')
        this.onClick = this.onClick.bind(this)
        this.$element.addEventListener('click', this.onClick )
    }

    /**
     * Se déclenche au click.
     *
     * @param {Event} e
     */
    async onClick(e){
        e.preventDefault()

        this.$element.style.display = 'none'
        let data = {
            'counter': this.$counter,
        }


        try{
            let response = await fetch(
                this.$action, {
                "method": 'PUT',
                "headers": {
                    "Content-Type": "application/json",
                    "Accept": "application/json, text-plain, */*",
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                "body": JSON.stringify(data)
            });

            const responseData = await response.json();
            // La réponse est ok, on vide le formulaire
            if (response.ok) {

                if (responseData.error){
                    return
                }

                this.$qtyInput.value = responseData.qty
                this.$countElement.innerHTML = responseData.count
                this.$cartTotal.innerHTML = responseData.total
                this.$productSubTotal.innerHTML = responseData.price

                this.clearAlert()
                this.alert(responseData.message, this.$flash)

                this.display(parseInt(responseData.max))
            }


        }catch (e){

        }


    }

    /**
     * Hide and Show counter buttons.
     *
     * @param {int} max
     * */
    display(max){

        // let qty = document.querySelector('.js-cart-qty').value
        let asc  = this.$trParent.querySelector('.js-counter[data-counter="ASC"]'),
            desc = this.$trParent.querySelector('.js-counter[data-counter="DESC"]')

        if(asc.classList.contains('d-none'))
            asc.classList.remove('d-none')

        if(desc.classList.contains('d-none'))
            desc.classList.remove('d-none')

        if (max === 1){
            desc.style.display = 'none'
            asc.style.display = 'none'
        }
        else if (parseInt(this.$qtyInput.value) === 1){
            desc.style.display = 'none'
            asc.style.display = 'inline-block'
        }
        else if (parseInt(this.$qtyInput.value) === max){
            asc.style.display = 'none'
            desc.style.display = 'inline-block'
        }
        else {
            asc.style.display = 'inline-block'
            desc.style.display = 'inline-block'
        }
    }

    /**
     * Create Bootstrap alert.
     *
     * @param {string} message
     * @param {Element} container
     * @param {string} status
     */
    alert(message, container, status = 'success') {
        let div = document.createElement('div')
        div.className = `alert alert-${status} alert-dismissible fade show`

        div.innerHTML =
        `${message}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        `

        // this.$flash.prepend(div)
        container.prepend(div)
    }

    /**
     * Remove all Bootstrap alerts.
     *
     * */
    clearAlert(){
        let alerts = document.querySelectorAll('.container .alert')
        if (alerts){
            alerts.forEach(alert => {
                alert.parentNode.removeChild(alert)
            })
        }
    }
}


document.addEventListener('DOMContentLoaded', () => {
    let counters = document.querySelectorAll('.js-counter')
    counters.forEach((counter) => {
        new Counter(counter)
    })
})
