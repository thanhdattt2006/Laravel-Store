        // let fileInput = document.getElementById("file-input");
        // let imageContainer = document.getElementById("images");
        // let numOfFiles = document.getElementById("num-of-files");

        // function preview() {
        //     imageContainer.innerHTML = "";
        //     numOfFiles.textContent = `${fileInput.files.length} Images Selected`;
       
        //     for(i of fileInput.files){
        //         let reader = new FileReader();
        //         let figure = document.createElement('figure');
        //         let figCap = document.createElement('figcaption');

        //         figCap.innerText = i.name;
        //         figure.appendChild(figCap);
        //         reader.onload = () => {
        //             let img = document.createElement('img');
        //             img.setAttribute('src', reader.result);
        //             figure.insertBefore(img, figCap);
        //         }

        //         imageContainer.appendChild(figure);
        //         reader.readAsDataURL(i);
        //     }
        // }

// upload img products
function preview(i) {
    let fileInput = document.getElementById(`file-input${i}`);
    let imageContainer = document.getElementById(`images${i}`);
    let numOfFiles = document.getElementById(`num-of-files${i}`);

    imageContainer.innerHTML = "";
    numOfFiles.textContent = `${fileInput.files.length} Images Selected`;

    for (let file of fileInput.files) {
        let reader = new FileReader();
        let figure = document.createElement('figure');
        let figCap = document.createElement('figcaption');

        figCap.innerText = file.name;
        figure.appendChild(figCap);

        reader.onload = () => {
            let img = document.createElement('img');
            img.setAttribute('src', reader.result);
            figure.insertBefore(img, figCap);
        };

        imageContainer.appendChild(figure);
        reader.readAsDataURL(file);
    }
}

//Hidden session set-time(3s)
// Ẩn thông báo sau 3 giây
setTimeout(() => {
    const alert = document.getElementById('alert');
    if (alert) {
        alert.style.transition = 'opacity 0.5s';
        alert.style.opacity = 0;
        setTimeout(() => alert.remove(), 500); // xóa hẳn khỏi DOM sau khi mờ đi
    }
}, 3000); // 3000 ms = 3 giây


//Limit price and Stock
function limitInput(input) {
    if (input.value.length > 9) {
        input.value = input.value.slice(0, 9); // giới hạn 3 chữ số
    }
}

function limitInput2(input) {
    if (input.value.length > 3) {
        input.value = input.value.slice(0, 3); // giới hạn 3 chữ số
    }
}
