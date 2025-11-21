function addPoint(element, num) {
    let stars = element.parentElement.children;
    stars[5].textContent = "(" + num + ")";
    for (let i = 0; i < 5; i++) {
        stars[i].classList.remove('bi-star-fill');
        stars[i].classList.add('bi-star');
    }
    for (let i = 0; i < num; i++) {
        stars[i].classList.remove('bi-star');
        stars[i].classList.add('bi-star-fill');
    }
}
// let totalAmount=document.getElementById('totalAmount');
// let totalPrice=document.getElementById('totalPrice');
// let newLi=document.getElementById('list');
// // let order=document.getElementById('order');

// function Orders(parent){
//     let numberAmount=Number(totalAmount.textContent);
//     numberAmount++;
//     totalAmount.textContent=numberAmount;
//     let stringPrice=parent.previousElementSibling.children[0].textContent;
//     let price=Number(stringPrice);;
//     let numberPrice=Number(totalPrice.textContent);
//     totalPrice.textContent=numberPrice+price;
//     let productName=parent.parentElement.nextElementSibling.textContent;
//     let newLi2=document.createElement('li');
//     newLi2.textContent=productName;
//     // newLi2.classList.add('list-unstyled')
//     newLi.appendChild(newLi2);

// }

// function Order(){
//     for(let order of newLi.children)
//     console.log(order.textContent);
// }
// function Orders2(parent){
//     let numberAmount=Number(totalAmount.textContent);
//     numberAmount++;
//     totalAmount.textContent=numberAmount; //dogry
//     let price=Number(parent.previousElementSibling.children[2].children[1].children[0].textContent);
//     console.log(typeof price)
//     let numberPrice=Number(totalPrice.textContent);
//     totalPrice.textContent=numberPrice+price;
//     let productName=parent.parentElement.previousElementSibling.textContent;
//     let newLi2=document.createElement('li');
//     newLi2.textContent=productName;
//     // newLi2.classList.add('list-unstyled')
//     newLi.appendChild(newLi2);

// }

// function Order(){
//     for(let order of newLi.children)
//     console.log(order.textContent);
// }

