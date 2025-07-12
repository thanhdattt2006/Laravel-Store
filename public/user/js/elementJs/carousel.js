document.addEventListener('DOMContentLoaded', function () {

    // currency-format
    // select all elements had class "currency-format"
    const moneyElements = document.querySelectorAll('.currency-format');

    moneyElements.forEach(function(element) {
        const rawValue = parseInt(element.textContent);
        if (!isNaN(rawValue)) {
            const formatted = rawValue.toLocaleString('vi-VN') + ' VND';
            element.textContent = formatted;
        }
    });

    // Registeration
    const menu = document.querySelector(".navbar-links")
    const menuCategories = document.querySelector(".sidebar")
    const closing = document.querySelector(".close")

    menuCategories.addEventListener('click', ()=>{
        menu.classList.toggle("navbar-open")
    });

    closing.addEventListener('click', ()=>{
        menu.classList.toggle("navbar-open")
    });

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

// update-cart
 const updateCartBtn = document.querySelector(".update-cart");
        const deleteButtons = document.querySelectorAll(".hidden");

        updateCartBtn.addEventListener("click", function () {
        deleteButtons.forEach(function (btn) {
        btn.classList.toggle("close"); // hoặc "flex" tùy CSS
      });
        });

// 

