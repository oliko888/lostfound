var trigger = document.getElementsByClassName('trigger');
var modal = document.getElementById('modal');
var smallModal = document.getElementById('small-modal');
var overlay = document.getElementById('overlay');
var closeBtn = document.getElementById('close-button');
var closeBtn2 = document.getElementById('close-button2');

overlay.addEventListener('click', modalClose);
closeBtn.addEventListener('click', modalClose);
closeBtn2.addEventListener('click', modalClose);

for (let i = 0; i < trigger.length; i++) {
    trigger[i].addEventListener('click', showPost);
}

function showPost(e) {
    modalOpen();
    var id = e.target.dataset.id;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("show-post").innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "/lostfound/ajax?lost=" + id, true);
    xmlhttp.send();
}

function modalOpen() {
    modal.classList.add('active');
    overlay.classList.add('active');
}

function modalClose() {
    modal.classList.remove('active');
    smallModal.classList.remove('active');
    overlay.classList.remove('active');
}

function smallModalOpen() {
    smallModal.classList.add('active');
    overlay.classList.add('active');
}
/* Edit post buttons */
function editLostPost(id) {
    modalOpen();
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("show-post").innerHTML = this.responseText;
            var img = document.getElementById('edit-img');
            var btn = document.getElementById('uploadFileBtn');
            var hidden = document.getElementById('hiddenInput');
            var inp = document.getElementById('fileUpload');
            var close = document.getElementById('imgCloseBtn');
            close.addEventListener('click', function () {
                btn.style.display = 'block';
                img.style.display = 'none';
                hidden.value = 2;
                close.style.display = 'none';
            })

            btn.addEventListener('click', function () {
                inp.click()
            });
            inp.onchange = function () {
                document.getElementById("uploadFileBtn").textContent = this.files[0].name;
                hidden.value = 3;
            }
        }
    };
    xmlhttp.open("GET", "/lostfound/ajax?editLost=" + id, true);
    xmlhttp.send();
}

function auctionFoundPost(id) {
    modalOpen();
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("show-post").innerHTML = this.responseText;
            var img = document.getElementById('edit-img');
            var btn = document.getElementById('uploadFileBtn');
            var hidden = document.getElementById('hiddenInput');
            var inp = document.getElementById('fileUpload');
            var close = document.getElementById('imgCloseBtn');
            close.addEventListener('click', function () {
                btn.style.display = 'block';
                img.style.display = 'none';
                hidden.value = 2;
                close.style.display = 'none';
            })

            btn.addEventListener('click', function () {
                inp.click()
            });
            inp.onchange = function () {
                document.getElementById("uploadFileBtn").textContent = this.files[0].name;
                hidden.value = 3;
            }
        }
    };
    xmlhttp.open("GET", "/lostfound/ajax?auctionFound=" + id, true);
    xmlhttp.send();
}

function deleteLostPost(id) {
    smallModalOpen();
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("show-post2").innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "/lostfound/ajax?deleteLost=" + id, true);
    xmlhttp.send();
}
