const btns = document.querySelectorAll('#btn');
const prices = document.querySelectorAll('#prix');
const libelles = document.querySelectorAll('#libelle');
const imgs = document.querySelectorAll('#p_img');
const deleteBtn = document.querySelector('#delete');
const texx_total = document.querySelector('#total');
const produits = [];

for(let i = 0 ; i < btns.length; i++){
    let product = {};
   product.index = btns[i].value;
   product.price = prices[i].textContent;
   product.libelle = libelles[i].textContent;
   product.img = imgs[i].attributes.src.value;
   produits.push(product);
}

let quantity = 1;
let result = "";
let total = 0;






const tbody = document.querySelector('#tbody');
const tr = document.querySelector('tr');

let arr = [];
btns.forEach(btn => btn.addEventListener('click',(e)=>{
    
    let target = e.target.value;
    
    produits.forEach(item =>{
        if( item.index === target){
          arr.push(item.price)
            total += parseInt(item.price,10)
            result +=`
            <tr id="tr">
           <td><img style="max-width: 50px;" class="img-responsive img-fluid" src="${item.img}" alt=""></td>
            <td><small>${item.price} €</small></td>
            <td><small>${item.libelle}</small></td> 
            <td>${quantity}</td>   
            </tr> `    
        }
        texx_total.innerHTML = "Total prix :" + total + "€";  
    }) 
   
  console.log(arr);
    tbody.innerHTML = result;
    
       
}))

let pro_panier = [];
let newarr = [];
let last_price = 0;
let new_total = 0;


deleteBtn.addEventListener('click',(e)=>{
 if(result != ""){
 newarr = tbody.children  


 pro_panier = result.split('</tr>').slice(0,-1);
 tbody.removeChild(newarr[newarr.length -1]);
 result = pro_panier.join("</tr>");
 last_price += parseInt(arr.pop());

 new_total = total - new_total;

if (newarr.length === 0) {
    result = "";
    new_total = 0;
}
   }
      
      
 
   texx_total.innerHTML = "Total prix :" + new_total + "€";  
})

    tbody.innerHTML = result;  

    
    
    
    
    
    
