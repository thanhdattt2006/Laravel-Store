document.addEventListener('DOMContentLoaded', function () {


    const imgFeature = document.querySelector('.imgFeature');
    const listImg = document.querySelectorAll('.listImage img');
    const prevBtn = document.querySelector('.prev');
    const nextBtn = document.querySelector('.next');

    var currentIndex = 0;
    function updateImageByIndex(index) {

        document.querySelectorAll('.listImage div').forEach(item => {
            item.classList.remove('acTive')
        });

        currentIndex = index;
        imgFeature.src = listImg[index].getAttribute('src');
        listImg[index].parentElement.classList.add('acTive')
    }

    listImg.forEach((imgElement, index) => {
        imgElement.addEventListener('click', e => {
            imgFeature.style.opacity = '0';
            setTimeout(() => {
                updateImageByIndex(index);
                imgFeature.style.opacity= '1';
            }, 100)
            
        });
    });
    
    prevBtn.addEventListener('click', e => {
        if (currentIndex == 0) {
            currentIndex = listImg.length -1;
        } else {
            currentIndex--;
        }

         imgFeature.style.opacity = '0';
            setTimeout(() => {
                updateImageByIndex(currentIndex);
                imgFeature.style.opacity= '1';
            }, 100)
    })

    nextBtn.addEventListener('click', e => {
        if (currentIndex == listImg.length - 1) {
            currentIndex = 0;
        } else {
            currentIndex++;
        }

        imgFeature.style.opacity = '0';
            setTimeout(() => {
                updateImageByIndex(currentIndex);
                imgFeature.style.opacity= '1';
            }, 100)
    })


});
