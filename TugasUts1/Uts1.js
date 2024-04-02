function tampilMasukanJumlahPilihan() {
    var nama = document.getElementById('dataInputNama').value;
    var namaB = document.getElementById('dataInputNamaBelakang').value;
    var email = document.getElementById('dataEmail').value;
    //Eror traping Input nama
    if (nama.trim() === '') {
      alert('Masukkan nama Anda!');
      return;
    } else if (namaB.trim() === '') {
      alert('Masukan nama belakang Anda!');
    } else if (email.trim() === '') {
      alert('Masukan Email Anda!');
    }
    var jumlah = parseInt(document.getElementById('dataInputJumlah').value);
    var tag = '';
  
    // Eror Traping Input jumlah
    if (isNaN(jumlah) || jumlah < 1) {
      alert('Masukkan jumlah pilihan dengan angka positif dan tidak boleh 0!');
      return;
    }
  
    for (var i = 1; i <= jumlah; i++) {
      tag += 'Pilihan ' + i + ' : <input type="text" id="inputPilihan' + i + '"> <br>';
    }
    document.getElementById('isi').innerHTML = tag;
    document.getElementById('tombolOKPilihan').style.display = 'block';
  }
  
  document.getElementById('tombolOKPilihan').addEventListener('click', function () {
    var jumlah = parseInt(document.getElementById('dataInputJumlah').value);
    for (var i = 1; i <= jumlah; i++) {
      var inputPilihan = document.getElementById('inputPilihan' + i);
      var checkboxPilihan = document.createElement('input');
      checkboxPilihan.type = 'checkbox';
      checkboxPilihan.id = 'checkboxPilihan' + i;
      checkboxPilihan.name = 'pilihan';
      checkboxPilihan.value = inputPilihan.value;
  
      var label = document.createElement('label');
      label.for = 'checkboxPilihan' + i;
      label.textContent = 'Pilihan ' + i + ' : ' + inputPilihan.value;
      document.querySelector('form').appendChild(checkboxPilihan);
      document.querySelector('form').appendChild(label);
      document.querySelector('form').appendChild(document.createElement('br'));
    }
    document.getElementById('tampilkanData').style.display = 'block';
  });
  
  function tampilkanDataTerpilih() {
    var checkboxs = document.getElementsByName('pilihan');
    var dataTerpilih = '';
    for (var i = 0; i < checkboxs.length; i++) {
      if (checkboxs[i].checked) {
        dataTerpilih += checkboxs[i].value + ', ';
      }
    }
    var nama = document.getElementById('dataInputNama').value;
    var namaB = document.getElementById('dataInputNamaBelakang').value;
    var email = document.getElementById('dataEmail').value;
    var jumlah = document.getElementById('dataInputJumlah').value;
    var pilihan = '';
  
    if (dataTerpilih === '') {
      alert('Pilih salah satu dari pilihan yang tersedia!');
      return;
    }
  
    for (var i = 1; i <= jumlah; i++) {
      var inputPilihan = document.getElementById('inputPilihan' + i);
      pilihan += 'Pilihan ' + i + ' : ' + inputPilihan.value + ', ';
    }
  
    var output = 'Hallo, Nama saya ' + nama + ' ' + namaB + ', dengan email ' + email + ' , saya mempunyai sejumlah ' + jumlah + ' pilihan hobi, yaitu : ' + pilihan + 'dan saya menyukai ' + dataTerpilih;
  
    document.getElementById('hasilTampil').innerHTML = output;
  }