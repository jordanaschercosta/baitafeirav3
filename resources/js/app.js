import './bootstrap';

async function checarNotificacoes() {
    try {
        const response = await fetch('/notificacoes/nao_lidas'); 
        if (!response.ok) {
            throw new Error('Erro ao buscar notificações');
        }

        const dados = await response.json();

        if (dados.data.length > 0) {
            const alert_has_notifications = document.getElementById('alert-has-notifications');
            const alert_no_notifications = document.getElementById('alert-no-notifications');

            if (alert_has_notifications) {
                alert_has_notifications.style.display = 'block';
                alert_no_notifications.style.display = 'none';
            }

            document.getElementById('notification-badge').style.display = 'inline-block';
            document.getElementById('notification-badge').innerHTML = dados.data.length;
        } else {
            document.getElementById('notification-badge').style.display = 'none';
            document.getElementById('notification-badge').innerHTML = '';
        }

    } catch (erro) {
        //
    }
}

setTimeout(() => {
    checarNotificacoes();
    setInterval(checarNotificacoes, 20000);
}, 100);

let image = document.getElementById('preview');
let cropper;

if (image) {
    document.getElementById('imagem_url').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const reader = new FileReader();
    
        var ratio = 1;
        if (e.target.dataset.aspectratio !== undefined && e.target.dataset.aspectratio === "retangular") {
            ratio = 4 / 1;
        }
    
        reader.onload = function(event) {
            image.src = event.target.result;
            image.style.display = 'block';
    
            if(cropper) cropper.destroy();
            cropper = new Cropper(image, {
                aspectRatio: ratio,
                viewMode: 1,
                autoCropArea: 1,
                crop(event) {
                    document.getElementById('cropX').value = event.detail.x;
                    document.getElementById('cropY').value = event.detail.y;
                    document.getElementById('cropWidth').value = event.detail.width;
                    document.getElementById('cropHeight').value = event.detail.height;
                    document.getElementById('imagemOriginalHidden').value = image.src;
                }
            });
        }
    
        reader.readAsDataURL(file);
    });
}

const form = document.querySelector("form");

if (form) {
    form.addEventListener('submit', function(e) {
        e.preventDefault();

        if(cropper) {
            const data = cropper.getData(); // pega x, y, width, height
            document.getElementById('cropX').value = data.x;
            document.getElementById('cropY').value = data.y;
            document.getElementById('cropWidth').value = data.width;
            document.getElementById('cropHeight').value = data.height;
            document.getElementById('imagemOriginalHidden').value = image.src;

            cropper.getCroppedCanvas().toBlob((blob) => {
                let reader = new FileReader();
                reader.onloadend = function() {
                    document.getElementById('cropped_image').value = reader.result;
                    e.target.submit(); // envia o form com a imagem cropada
                }
                reader.readAsDataURL(blob);
            });
        } else {
            e.target.submit();
        }
    });
}
const cepInput = document.getElementById("cep");

if (cepInput) {
    document.getElementById('cep').addEventListener('change', function(e) {
        const cep = this.value.replace(/\D/g, '');

        if (cep.length !== 8 && cep.length !== 6) {
            alert("CEP inválido!");
            return;
        }

        fetch(`https://viacep.com.br/ws/${cep}/json/`)
            .then(response => response.json())
            .then(data => {
                if (data.erro) {
                    alert("CEP não encontrado!");
                    return;
                }

                // Preenche os campos
                document.getElementById('rua').value = data.logradouro;
                document.getElementById('bairro').value = data.bairro;
                document.getElementById('cidade').value = data.localidade;
                document.getElementById('uf').value = data.uf;
            })
            .catch(err => console.error('Erro ao buscar CEP:', err));
    });
}

const check = document.getElementById('em_promocao');
const valorNovo = document.getElementById('valor_novo');

function toggleValorNovo() {
    if (!check || !valorNovo) return;

    if (check.checked) {
        valorNovo.removeAttribute('disabled');
    } else {
        valorNovo.setAttribute('disabled', true);
        valorNovo.value = '';
    }
}

if (check) {
    check.addEventListener('change', toggleValorNovo);

    toggleValorNovo();
}

const phoneInput = document.getElementById('phone');

if (phoneInput) {
    phoneInput.addEventListener('input', function(e) {

        let v = e.target.value.replace(/\D/g, '');

        // Limita no máximo 11 dígitos
        v = v.substring(0, 11);

        if (v.length <= 10) {
            // (00) 0000-0000
            v = v.replace(/^(\d{2})(\d)/g, '($1) $2');
            v = v.replace(/(\d{4})(\d)/, '$1-$2');
        } else {
            // (00) 00000-0000
            v = v.replace(/^(\d{2})(\d)/g, '($1) $2');
            v = v.replace(/(\d{5})(\d)/, '$1-$2');
        }

        e.target.value = v;
    });
}