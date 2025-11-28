import './bootstrap';

async function executar() {
    try {
        const response = await fetch('/notificacoes'); 
        if (!response.ok) {
            throw new Error('Erro ao buscar notificações');
        }

        const dados = await response.json();
        const dropdown = document.getElementById('notification-dropdown');

        if (dados.data.length > 0) {
            document.getElementById('notification-badge').style.display = 'inline-block';
            document.getElementById('notification-badge').innerHTML = dados.data.length;

            dropdown.innerHTML = '';

            dados.data.forEach(notificacao => {
                const a = document.createElement('a');
                a.classList.add('dropdown-item');
                a.href = notificacao.url || '#';
                a.textContent = notificacao.titulo || 'Sem título';

                dropdown.appendChild(a);
            });
        } else {
            const a = document.createElement('a');
            a.classList.add('dropdown-item');
            a.href = '#';
            a.textContent = 'Nenhuma notificação';
            dropdown.appendChild(a);
            document.getElementById('notification-badge').style.display = 'none';
            document.getElementById('notification-badge').innerHTML = '';
        }

    } catch (erro) {
        //
    }
}

setTimeout(() => {
    executar();
    setInterval(executar, 20000);
}, 100);

async function lerNotificacoes() {
    const response = await fetch('/notificacoes/lido');
    if (!response.ok) {
        throw new Error('Erro ao buscar notificações');
    }

    const dropdown = document.getElementById('notification-dropdown');

    const a = document.createElement('a');
    a.classList.add('dropdown-item');
    a.href = '#';
    a.textContent = 'Nenhuma notificação';
    dropdown.appendChild(a);
    document.getElementById('notification-badge').style.display = 'none';
    document.getElementById('notification-badge').innerHTML = '';
}

const dropdown_link = document.getElementById('notification-dropdown-link')

if (dropdown_link) {
    dropdown_link.addEventListener('click', () => {
        lerNotificacoes()
    })
}

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

document.querySelector('form').addEventListener('submit', function(e) {
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

document.getElementById('cep').addEventListener('change', function(e) {
    const cep = this.value.replace(/\D/g, '');

    if (cep.length !== 8) {
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