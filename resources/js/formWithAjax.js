

function showErrors(name, arr, el) {
    let element = el.querySelector(`[name="${name}"]`)

    if (!element)
        element = el.querySelector(`[name="${name}[]"]`)

    if(! element)
        element = el.querySelector(`[name="${name.split('.')[0]}[]"]`)

    if (element){
        element.classList.add("is-invalid")

        let divError = document.createElement("div"),
            parent = element.parentNode

        divError.classList.add('invalid-feedback')
        divError.innerHTML = arr[name][0]
        let next = element.nextElementSibling

        if (next)
            next = next.className.includes('input-group-addon')

        if (element.className.includes('custom-file-input')){
            parent.parentNode.classList.add('is-invalid')
            parent.parentNode.parentNode.appendChild(divError)
        }else if(next){
            parent.parentNode.appendChild(divError)
        }
        else {
            if (parent.className.includes('form-label-group'))
                element.appendChild(divError)

            parent.appendChild(divError)
        }
    }
}

function clearErrors(form) {
    let errorDiv = form.querySelectorAll('.invalid-feedback')
    let input = form.querySelectorAll('.is-invalid')
    const length = errorDiv.length

    for (let i = 0; i < length; i++)
    {
        errorDiv[i].parentNode.removeChild(errorDiv[i])
        input[i].classList.remove('is-invalid')
    }
}

function createwithAjax(e) {
    let button = this.querySelector('button[type=submit]')
    let buttonText = button.innerHTML
    button.disabled = true
    button.innerHTML = 'Loading...'
    e.preventDefault()

    clearErrors(this)
    let formData = new FormData(this);

    if (this.id === 'checkout-form'){
        let desc = document.querySelector('textarea#checkout-desc')
        if (desc)
            formData.append('description', desc.value)
    }

    let settings = {headers: {"content-type": "multipart/form-data; boundary=---------------------------974767299852498929531610575"}}

    axios.post(this.action,
        formData,
        settings
    )
        .then((response) => {
            return window.location.href = response.data.route
        })
        .catch((error) => {
            if (error.response.status === 422){
                let errors = error.response.data.errors
                let arr = Object.keys(errors)
                let length = Object.keys(errors).length
                for (let i = 0; i < length; i++)
                    showErrors(arr[i], errors, this)

                button.innerHTML = buttonText
                button.disabled = false
            }else {
                alert(`${error.response.status} | ${error.response.statusText}`)
            }

        });

}

(function() {
    let form = document.querySelector('#form-create')
    if (form)
        form.addEventListener('submit', createwithAjax)

})();

(function() {
    let form = document.querySelector('#form-update')
    if (form)
        form.addEventListener('submit', createwithAjax)

})();

(function() {
    let form = document.querySelector('#sign-in')
    if (form)
        form.addEventListener('submit', createwithAjax)

})();

(function() {
    let form = document.querySelector('#sign-up')
    if (form)
        form.addEventListener('submit', createwithAjax)

})();

(function() {
    let form = document.querySelector('#checkout-form')
    if (form)
        form.addEventListener('submit', createwithAjax)

})();

(function() {
    let form = document.getElementById('online-form')
    if (form){
        let gridCheck = document.getElementById('gridCheck'),
            token = document.querySelector("meta[name='csrf-token']").content;

        gridCheck.addEventListener('change', async function (e){
            e.preventDefault();
            gridCheck.disabled = true;

            clearAlerts()
            let data = { "online": gridCheck.checked}
            try {
                let response;
                response = await fetch(
                    form.getAttribute('action'),
                    {
                        "method": 'PUT',
                        "headers": {
                            "Content-Type": "application/json",
                            "Accept": "application/json, text-plain, */*",
                            "X-Requested-With": "XMLHttpRequest",
                            "X-CSRF-TOKEN": token
                        },
                        "body": JSON.stringify(data)
                    });

                const responseData = await response.json();
                // La réponse est ok, on vide le formulaire
                if (response.ok) {
                    let alert = document.createElement('div')

                    alert.className = `alert alert-${responseData.status}`
                    alert.innerHTML = responseData.message

                    let parent = document.querySelector('#js-alert')
                    parent.prepend(alert);
                }
                // La réponse n'est pas bonne (pas 200), on affiche les erreurs
                else
                    alert('error')

            }catch (e) {
                alert('error')
            }
            // Dans tous les cas on permet la soumission du formulaire à nouveau
            gridCheck.disabled = false;
        })
    }

})();

function clearAlerts(){
    let alerts = document.querySelectorAll('.alert')
    const length = alerts.length

    for (let i = 0; i < length; i++)
    {
        alerts[i].parentNode.removeChild(alerts[i])
    }
};
