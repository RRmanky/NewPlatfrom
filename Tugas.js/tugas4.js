var inputNama = document.querySelector('#name');
var inputPilihan = document.querySelector('#pilihan');
var container = document.querySelector('.contain')
const btn = document.querySelector('#btn');

var tamp = [];
var pilihan;

btn.addEventListener('click', tombolTekan);

function tombolTekan() {
    var nama = inputNama.value.trim();
    pilihan = inputPilihan.value;
    if (nama == '' || pilihan == '') {
        alert('jangan ada yang kosong');
    } else {
        inputPilih();
    }
}

function inputPilih() {
    btn.remove();
    const element = document.querySelectorAll('.form-group')
    element.forEach(function(e) {
        e.parentNode.removeChild(e);
    });

    var batas = parseInt(inputPilihan.value.trim());
    for (let index = 0; index < batas; index++) {
        const pilih = document.createElement('div');
        pilih.classList.add('form-group');

        const label = document.createElement('label');
        label.textContent = 'pilihan' + (index + 1) + ':';
        label.setAttribute('for', 'pilihan');

        const input = document.createElement('input');
        input.type = 'text';
        input.setAttribute('id', 'pilihan');


        pilih.appendChild(label);
        pilih.appendChild(input);
        container.appendChild(pilih);
    }
    const ok = document.createElement('button');
    ok.type = 'submit';
    ok.setAttribute('id', 'btnOK');
    ok.textContent = 'OK';
    container.appendChild(ok);

    const okb = document.querySelector('#btnOK');
    okb.addEventListener('click', function(e) {
        const inp = document.querySelectorAll('#pilihan')
        for (let index = 0; index < inp.length; index++) {
            tamp[index] = inp[index].value;

        }
        inputHobi();
        ok.disabled = true;
    });
}

function inputHobi() {
    const containDrop = document.createElement('div');
    containDrop.setAttribute('class', 'form-group');

    const hobiLabel = document.createElement('label');
    hobiLabel.textContent = 'Hobi';
    hobiLabel.setAttribute('for', 'hobi');

    const hobiSelect = document.createElement('select');
    hobiSelect.setAttribute('id', 'hobi');

    const hobi = ['Volly', 'sepakbola','Basket','Futsal','Mendaki gunung'];

    hobi.forEach(function(hobi) {
        const optionElement = document.createElement('option');
        optionElement.textContent = hobi;
        // optionElement.value = hobi;
        hobiSelect.appendChild(optionElement);
    });

    const defaultOption = document.createElement('option');
    defaultOption.textContent = 'Pilih Hobi';
    defaultOption.setAttribute('disabled', 'disabled');
    defaultOption.setAttribute('selected', 'selected');
    hobiSelect.insertBefore(defaultOption, hobiSelect.firstChild);

    containDrop.appendChild(hobiLabel);
    containDrop.appendChild(hobiSelect);
    container.appendChild(containDrop);

    const ok1 = document.createElement('button');
    ok1.type = 'submit';
    ok1.setAttribute('id', 'btn_ok');
    ok1.textContent = 'submit';
    container.appendChild(ok1);

    const tombol_OK = document.querySelector('#btn_ok');
    tombol_OK.addEventListener('click', function(e) {
        const nama = inputNama.value;
        const jmlpil = inputPilihan.value;
        var txtARy = '';

        for (let i = 0; i < tamp.length; i++) {
            txtARy += ' pilihan ' + (i + 1) + ' ' + tamp[i] + ', ';

        }

        const hb = document.getElementById('hobi');
        const Hobi = hb.value;
        const txt = "<p>" + 'saya ' + nama + ' memilih pilihan sejumlah ' + jmlpil + ' meliputi ' + txtARy + 'Memiliki hobi ' + Hobi + "</p>";
        container.innerHTML = txt;
    });
}
